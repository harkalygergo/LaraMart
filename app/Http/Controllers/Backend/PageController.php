<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    private Request $request;

    public function __construct(
        Request $request
    ) {
        $this->request = $request;
    }

    public function showPages()
    {
        return view('layouts.backend.pages', [
            'data' => Page::all(),
        ]);
    }

    public function addPage()
    {
        if ($this->request->method()==='PUT' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $page = new Page();
            $page->title = $_POST['title'];
            $page->slug = $_POST['slug'];
            $page->excerpt = $_POST['excerpt'];
            $page->content = $_POST['content'];
            $page->position = $_POST['position'];
            $page->save();

            // redirect to the page list
            return $this->showPages();
        }

        return view('layouts.backend.addPage');
    }

    public function action(int $page)
    {
        $page = Page::find($page);

        if ($this->request->method()==='PUT' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $page->title = $_POST['title'];
            $page->slug = $_POST['slug'];
            $page->excerpt = $_POST['excerpt'];
            $page->content = $_POST['content'];
            $page->position = $_POST['position'];
            $page->save();
        }

        if ($this->request->method()==='DELETE' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $page->delete();
            return $this->showPages();
        }

        return view('layouts.backend.editPage', [
            'page' => $page,
        ]);
    }
}
