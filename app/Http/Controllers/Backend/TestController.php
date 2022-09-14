<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Test;
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
    public $except_column;

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
        $this->except_column= ['_token'];


        $this->show_fields =
            [
                [
                    'view_name' => "Name",
                    'name' => "name",
                    'length' => "",
                    'is_image'=>true
                ],
                [
                    'view_name' => "Email",
                    'name' => "email",
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
                    'name' => "phone",
                    'type' => "number",
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
                    'required' => "",
                    'update'=>""
                ],
                [
                    'name' => "email",
                    'type' => "email",
                    'placeholder' => "Enter Email",
                    'id' => "",
                    'update'=>""
                ],
                [
                    'name' => "phone",
                    'type' => "number",
                    'placeholder' => "Enter Email",
                    'id' => "",
                    'update'=>""
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
        $view_data = Test::select('name','email')->get();
        $route = 'admin.tests.edit';
        return view('backend.pages._create',compact('view_data','pageHeader','show_fields','route'));
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
        $route = route('admin.tests.store');
        return view('backend.pages._create',compact('pageHeader','insert_fields','route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (is_null($this->user) || !$this->user->can('admin.create')) {
        //     abort(403,'Unauthorized Access');
        // }
        $request->validate([
            'email' => 'required',
            'phone' => 'required',
        ]);
         Test::insert($request->except($this->except_column));
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
        $insert_fields = $this->update_fields;
        $data = Test::find($id);
        $route = route("admin.tests.update",$data->id);
        return view('backend.pages._create',compact('pageHeader','insert_fields','data','route'));
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
        // if (is_null($this->user) || !$this->user->can('admin.edit')) {
        //     abort(403,'Unauthorized Access');
        // }
        $update = Test::findOrFail($id);
        $update->update($request->all());

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

