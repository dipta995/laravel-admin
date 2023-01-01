<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public $user;
    public $pageHeader;
    public $show_fields;
    public $insert_fields;
    public $update_fields;
    public $except_column;
    public $index_route = "admin.admins.index";
    public $create_route = "admin.admins.create";
    public $store_route = "admin.admins.store";

    public function __construct()
    {
        $this->checkGuard();
        $this->pageHeader = [
            'title' => "Admin",
            'sub_title' => "",
            'plural_name' => "admins",
            'singular_name' => "admin",
            'index_route' => route($this->index_route),
            'create_route' => route($this->create_route),
            'store_route' => route($this->store_route),
            'base_url' => url('admin/admins'),

        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkOwnPermission('admin.view');

        $pageHeader = $this->pageHeader;

        $admins = Admin::all();
        return view('backend.pages.admins.index',compact('admins','pageHeader'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkOwnPermission('admin.create');
        $pageHeader = $this->pageHeader;
        $roles = Role::all();
        return view('backend.pages.admins.create',compact('roles','pageHeader'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkOwnPermission('admin.create');

        $request->validate([
            'name'=> 'required|max:50',
            'email'=> 'required|unique:admins',
            'password'=> 'required|min:8|confirmed',
        ],[
            'name.required' => 'Please Insert New Admin Name'
        ]);
        $user = new Admin();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }
        session()->flash('success','Admin has Been created');
        return redirect()->route('admin.admins.index');


        // $user = Admin::create(['name' => $request->name]);
        // $permissions = $request->permissions;
        // if ($user) {
        //     if (!empty($permissions)) {
        //         $user->syncPermissions($permissions);
        //     }
        //     return back()->with('success','New Admin Created');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->checkOwnPermission('admin.edit');
        $pageHeader = $this->pageHeader;
        $admin = Admin::find($id);
        $roles = Role::all();
        return view('backend.pages.admins.edit',compact('admin','roles','pageHeader'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->checkOwnPermission('admin.edit');

        $user = Admin::find($id);
        $request->validate([
            'name'=> 'required|max:50',
            'email'=> 'required|email|unique:admins,email,'.$id,
            'password'=> 'nullable|min:8|confirmed',
        ],[
            'name.required' => 'Please Insert New Admin Name'
        ]);
        // $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password !=null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }
        session()->flash('success','Admin has Been Updated');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checkOwnPermission('admin.delete');
         $user = Admin::findById($id);
         if (!is_null($user)) {
             $user->delete();
         }
         session()->flash('success','user has been deleted');
         return back();

    }
}

