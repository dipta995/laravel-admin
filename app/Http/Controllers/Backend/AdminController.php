<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Pagination\Paginator;

class AdminController extends Controller
{
    public $pageHeader;
    public $index_route = "admin.admins.index";
    public $create_route = "admin.admins.create";
    public $store_route = "admin.admins.store";
    public $edit_route = "admin.admins.edit";
    public $update_route = "admin.admins.update";

    public function __construct()
    {
        $this->checkGuard();
        Paginator::useBootstrapFive();
        $this->pageHeader = [
            'title' => "Admins",
            'sub_title' => "",
            'plural_name' => "admins",
            'singular_name' => "Admin",
            'index_route' => route($this->index_route),
            'create_route' => route($this->create_route),
            'store_route' => $this->store_route,
            'edit_route' => $this->edit_route,
            'update_route' => $this->update_route,
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
        $data['pageHeader'] = $this->pageHeader;
        $data['datas'] = Admin::orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.admins.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkOwnPermission('admin.create');
        $data['pageHeader'] = $this->pageHeader;
        $data['roles'] = Role::all();
        return view('backend.pages.admins.create', $data);
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
            'name' => 'required|max:50',
            'email' => 'required|unique:admins',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Please Insert New Admin Name'
        ]);
        $user = new Admin();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        if ($user->save()) {
            return redirectRouteHelper($this->index_route);
        } else {
            return redirectRouteHelper();
        }
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
        $data['pageHeader'] = $this->pageHeader;
        $data['singleData'] = Admin::find($id);
        $data['roles'] = Role::all();
        return view('backend.pages.admins.edit', $data);
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
            'name' => 'required|max:50',
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
        ], [
            'name.required' => 'Please Insert New Admin Name'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        if ($user->save()) {
            return redirectUpdateRoute($this->index_route);
        } else {
            return redirectRouteHelper();
        }
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
        $deleteData = Admin::find($id);

        if (!is_null($deleteData)) {
            if ($deleteData->delete()) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 422]);
            }
        }
    }
}
