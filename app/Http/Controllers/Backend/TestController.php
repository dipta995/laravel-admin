<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{
    public $user;
    public $pageHeader;
    public $show_fields;
    public $insert_fields;
    public $update_fields;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
        $this->pageHeader = [
            'title' => "Dashboard",
            'sub_title' => "",
            'plural_name' => "dashboards",
            'index_button' => "admin.admins.index",
            'create_button' => "admin.admins.create"
        ];
        $this->show_fields =
            [
                [
                    'view_name' => "Name",
                    'column_name' => "name",
                    'length' => "",
                    'is_image'=>true
                ],
                [
                    'view_name' => "Name",
                    'column_name' => "name",
                    'length' => "",
                    'is_image'=>false
                ],

            ];
        $this->insert_fields =
            [
                [
                    'name' => "name",
                    'type' => "text",
                    'placeholder' => "Enter Name",
                    'id' => "",
                    'required' => "",
                ],
                [
                    'name' => "email",
                    'type' => "email",
                    'placeholder' => "Enter Email",
                    'id' => "",
                ],

                [
                    'name' => "name",
                    'type' => "text",
                    'placeholder' => "Enter Name",
                    'id' => "",
                    'required' => "",
                ],
                [
                    'name' => "email",
                    'type' => "email",
                    'placeholder' => "Enter Email",
                    'id' => "",
                ],
            ];
        $this->update_fields =
            [
                [
                    'name' => "name",
                    'type' => "text",
                    'placeholder' => "Enter Name",
                    'id' => "",
                ],
                [
                    'name' => "email",
                    'type' => "email",
                    'placeholder' => "Enter Email",
                    'id' => "",
                ],

            ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            abort(403,'Unauthorized Access');
        }

        $pageHeader = $this->pageHeader;
        $show_fields = $this->show_fields;
        $admins = Admin::all();
        return view('backend.pages._create',compact('admins','pageHeader','show_fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if (is_null($this->user) || !$this->user->can('admin.create')) {
//            abort(403,'Unauthorized Access');
//        }
        $pageHeader = $this->pageHeader;
        $insert_fields = $this->insert_fields;
        return view('backend.pages._create',compact('pageHeader','insert_fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403,'Unauthorized Access');
        }
        $insert_fields = $this->insert_fields;
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
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403,'Unauthorized Access');
        }
        $pageHeader = $this->pageHeader;
        $update_fields = $this->update_fields;
        return view('backend.pages.admins.edit',compact('pageHeader','update_fields'));
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
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403,'Unauthorized Access');
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
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            abort(403,'Unauthorized Access');
        }

    }
}

