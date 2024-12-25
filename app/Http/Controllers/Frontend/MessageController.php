<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ad;
use App\Models\Message;

class MessageController extends Controller
{
    public function handleNew()
    {
        $loggedInUser = auth()->user();
        $adId = request('ad');
        $ad = Ad::find($adId);
        $recipientId = is_null($ad->user_id) ? $ad->merchant_id : $ad->user_id;

        $message = new Message();
        $message->user_id = $loggedInUser->id;
        $message->recipient_id = $recipientId;
        $message->ad_id = $adId;
        $message->message = request('message');
        $message->save();

        return redirect()->back()->with('success', 'Message sent.');
    }
}
