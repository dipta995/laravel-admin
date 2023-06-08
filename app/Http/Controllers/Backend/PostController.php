<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;

class PostController extends Controller
{
    public $pageHeader;
    public $index_route = "admin.posts.index";
    public $create_route = "admin.posts.create";
    public $store_route = "admin.posts.store";
    public $edit_route = "admin.posts.edit";
    public $update_route = "admin.posts.update";

    public function __construct()
    {
        $this->checkGuard();
        Paginator::useBootstrapFive();
        $this->pageHeader = [
            'title' => "Posts",
            'sub_title' => "",
            'plural_name' => "posts",
            'singular_name' => "Post",
            'index_route' => route($this->index_route),
            'create_route' => route($this->create_route),
            'store_route' => $this->store_route,
            'edit_route' => $this->edit_route,
            'update_route' => $this->update_route,
            'base_url' => url('admin/posts'),

        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->checkOwnPermission('post.view');
        $data['pageHeader'] = $this->pageHeader;
        $data['datas'] = Post::orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->checkOwnPermission('post.create');
        $data['pageHeader'] = $this->pageHeader;
        return view('backend.pages.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkOwnPermission('post.create');
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required'
        ]);
        $row = new Post;
        $row->title = $request->title;
        $row->body = $request->body;
        if (!empty($request->image)) {
            $row->image = imageUpload($request->image, 'Post');
        }
        if ($row->save()) {
            return redirectRouteHelper($this->index_route);
        } else {
            return redirectRouteHelper();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->checkOwnPermission('post.edit');
        $data['pageHeader'] = $this->pageHeader;
        $data['singleData'] = Post::find($id);
        return view('backend.pages.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->checkOwnPermission('post.edit');
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $row = Post::find($id);
        $row->title = $request->title;
        $row->body = $request->body;

        if ($request->hasFile('image')) {
            #Get Image Path from Folder
            $path = 'images/' . $row->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        if (!empty($request->image)) {
            $row->image = imageUpload($request->image, 'Post');
        }

        if ($row->save()) {
            return redirectUpdateRoute($this->index_route);
        } else {
            return redirectRouteHelper();
        }
    }

    public function isActive($id)
    {
        $this->checkOwnPermission('post.edit');

        $data = Post::where('id', $id)->first();
        if ($data->status == 'active') {
            $status = "inactive";
        } else {
            $status = "active";
        }
        Post::where('id', $id)->update([

            'status' =>  $status
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->checkOwnPermission('post.delete');
        $deleteData = Post::find($id);

        $path = 'images/' . $deleteData->image;
        if (File::exists($path)) {
            File::delete($path);
        }

        if (!is_null($deleteData)) {
            if ($deleteData->delete()) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 422]);
            }
        }
    }
}
