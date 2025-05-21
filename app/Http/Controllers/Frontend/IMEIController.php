<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Imei;
use App\Models\Menu;
use Illuminate\Http\Request;

class IMEIController extends Controller
{
    public function index()
    {
        // https://sickw.com/sample.txt
        /*
         * DEMO IMEI
         * IPHONE 11 BLACK 64GB-LAE: 356656420245275
         * array:7 [▼ // app/Http/Controllers/IMEIController.php:47
              "result" => array:16 [▼
                "Model Description" => "IPHONE 11 BLACK 64GB-LAE"
                "Model" => "iPhone 11 64GB Black Cellular [A2221] [iPhone12,1]"
                "IMEI" => "356656420245275"
                "IMEI2" => "356656420034778"
                "MEID" => "35665642024527"
                "Serial Number" => "FFWJQYD9N735"
                "Estimated Purchase Date" => "2022-12-21"
                "Warranty Status" => "Out Of Warranty"
                "iCloud Lock" => "OFF"
                "Demo Unit" => "No"
                "Loaner Device" => "No"
                "Replaced Device" => "No"
                "Replacement Device" => "No"
                "Refurbished Device" => "No"
                "Purchase Country" => "Mexico"
                "Sim-Lock Status" => "Locked"
              ]
              "imei" => "356656420245275"
              "balance" => "7.385"
              "price" => "0.06"
              "service" => "30"
              "id" => "104066237"
              "status" => "success"
            ]

             {
                "result": {
                    "Model Description": "IPHONE 11 BLACK 64GB-LAE",
                    "Model": "iPhone 11 64GB Black Cellular [A2221] [iPhone12,1]",
                    "IMEI": "356656420245275",
                    "IMEI2": "356656420034778",
                    "MEID": "35665642024527",
                    "Serial Number": "FFWJQYD9N735",
                    "Estimated Purchase Date": "2022-12-21",
                    "Warranty Status": "Out Of Warranty",
                    "iCloud Lock": "OFF",
                    "Demo Unit": "No",
                    "Loaner Device": "No",
                    "Replaced Device": "No",
                    "Replacement Device": "No",
                    "Refurbished Device": "No",
                    "Purchase Country": "Mexico",
                    "Sim-Lock Status": "Locked"
                },
                "imei": "356656420245275",
                "balance": "7.145",
                "price": "0.06",
                "service": "30",
                "id": "104068767",
                "status": "success"
            }
         */
        $imeiQuery = request('imei');
        $service = request('service') ?? '30';

        if ($imeiQuery == null) {
            return view(env('LAYOUT').'.telefon-adat-lekerdezes', [
                'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
            ]);
        }

        // if $imeiQuery is not null and exists in database in imei table in imei column, than get data from database
        $imeiData = Imei::where('imei', $imeiQuery)->where('service', $service)->first();
        if ($imeiData != null) {
            return view(env('LAYOUT').'.telefon-adat-lekerdezes', [
                'imei' => $imeiQuery,
                'result' => $imeiData->data,
                'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
            ]);
        } else {
            // check if user has enough points
            if (auth()->check()) {
                $user = auth()->user();
                if ($user->points < 100) {
                    return view(env('LAYOUT').'.telefon-adat-lekerdezes', [
                        'imei' => $imeiQuery,
                        'error' => 'Nincs elég pontod a lekérdezéshez!',
                        'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
                    ]);
                }
            }


            $imeiData = $this->getImeiData($service, $imeiQuery);
            $data = json_decode($imeiData, true);

            // if $data is null or status is error
            if ($data == null) {
                return view(env('LAYOUT').'.telefon-adat-lekerdezes', [
                    'imei' => $imeiQuery,
                    'error' => $imeiData,
                    'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
                ]);
            }

            if ($data['status'] == 'error') {
                return view(env('LAYOUT').'.telefon-adat-lekerdezes', [
                    'imei' => $imeiQuery,
                    'error' => $data['message'],
                    'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
                ]);
            }

            // save imei data to database
            $imei = new Imei();
            $imei->imei = $data['imei'];
            //$imei->brand = $data['brand'];
            //$imei->model = $data['model'];
            //$imei->os = $data['os'];
            //$imei->storage = $data['storage'];
            $imei->data_source = 'sickw';
            $imei->data = $imeiData;
            $imei->service = $service;
            $imei->save();

            // if user is logged in, decrease user points with 100
            if (auth()->check()) {
                $user = auth()->user();
                $user->points -= 100;
                $user->save();
            }

            return view(env('LAYOUT').'.telefon-adat-lekerdezes', [
                'imei' => $imeiQuery,
                'result' => $imeiData,
                'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
            ]);
        }
    }


    private function getImeiData($service, $imei_number): string
    {
        $SICKW_API_URL = 'https://sickw.com/api.php?format=beta';
        $SICKW_API_USER = 'kovacs.szilvia@pophone.eu';
        $SICKW_API_KEY = 'GSP-9MU-HGJ-6RV-2SV-QEC-7ZW-F0N';

        $url = $SICKW_API_URL . '&key=' . $SICKW_API_KEY . '&imei=' . $imei_number . '&service=' . $service;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public function store(Request $request)
    {
        $request->validate([
            'imei' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'color' => 'required|string',
            'storage' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        $imei = new IMEI();
        $imei->imei = $request->imei;
        $imei->brand = $request->brand;
        $imei->model = $request->model;
        $imei->color = $request->color;
        $imei->storage = $request->storage;
        $imei->price = $request->price;
        $imei->description = $request->description;
        $imei->image = $imageName;
        $imei->save();

        return redirect()->route('imei.index');
    }

    public function show(IMEI $imei)
    {
        return view(env('LAYOUT').'.imei-show', [
            'imei' => $imei,
            'menus' => Menu::where('is_active', true)->orderBy('position', 'asc')->get(),
        ]);
    }

    public function edit(IMEI $imei)
    {
        return view(env('LAYOUT').'.imei-edit', [
            'imei' => $imei
        ]);
    }

    public function update(Request $request, IMEI $imei)
    {
        $request->validate([
            'imei' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'color' => 'required|string',
            'storage' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
}
