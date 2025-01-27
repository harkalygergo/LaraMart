<?php

namespace App\Http\Controllers\Backend;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private Request $request;

    public function __construct(
        Request $request
    ) {
        $this->request = $request;
    }

    public function index()
    {
        return view('layouts.backend.blog.index', [
            'data' => Blog::all(),
        ]);
    }

    public function add()
    {
        if ($this->request->method()==='PUT' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $blog = new Blog();
            $blog->title = $_POST['title'];
            $blog->slug = $_POST['slug'];
            $blog->excerpt = $_POST['excerpt'];
            $blog->content = $_POST['content'];
            $blog->save();

            return redirect()->route('admin.blog.index');
        }

        return view('layouts.backend.blog.add');
    }

    public function action(int $id)
    {
        $entity = Blog::find($id);

        if ($this->request->method()==='PUT' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $entity->title = $_POST['title'];
            $entity->slug = $_POST['slug'];
            $entity->excerpt = $_POST['excerpt'];
            $entity->content = $_POST['content'];
            $entity->save();
        }

        if ($this->request->method()==='DELETE' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $entity->delete();

            return redirect()->route('admin.blog.index');
        }

        return view('layouts.backend.blog.edit', [
            'blog' => $entity,
        ]);
    }


}
