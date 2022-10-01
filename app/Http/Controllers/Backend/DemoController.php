<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Demo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class DemoController extends Controller
{
    public $user;
    public $pageHeader;
    public $show_fields;
    public $insert_fields;
    public $update_fields;
    public $except_column;
    public $index_route = "admin.demos.index";
    public $create_route = "admin.demos.create";
    public $store_route = "admin.demos.store";
    public $edit_route = "admin.demos.edit";
    public $update_route = "admin.demos.update";
    public $delete_route = "admin.demos.destroy";
    public $show_route = "admin.demos.show";
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
            'index_route' => route($this->index_route),
            'create_route' => route($this->create_route),
            'store_route' => route($this->store_route),
            'base_url' => url('admin/demos'),

        ];
        $this->except_column= ['_token'];
        $this->show_fields =
            [
                [
                    'view_name' => "select_admin_id",
                    'base_array' => 'admin',
                    'name' => "name",
                    'length' => "",
                    'type'=>''
                ],
                [
                    'view_name' => "Email",
                    'name' => "email",
                    'length' => "",
                    'type'=>''
                ],
                [
                    'view_name' => "Password",
                    'name' => "password",
                    'length' => "",
                    'type'=>''
                ],
                [
                    'view_name' => "File",
                    'name' => "file",
                    'length' => "",
                    'type'=>'image'
                ],
                [
                    'view_name' => "Radio",
                    'name' => "radio",
                    'length' => "",
                    'active_status'=>'on',
                    'type'=>'switch'
                ],

            ];
        $this->insert_fields =
            [
                [
                    'title' => "select_admin_id",
                    'name' => "select_admin_id",
                    'type' => "text",
                    'field'=>"select",
                    'modelData'=>'\Admin',
                    'view_index'=>"name",
//                    'required' => "",
                ],
                [
                    'title' => "multiple_admin_id",
                    'name' => "multiple_admin_id",
                    'type' => "text",
                    'field'=>"select",
                    'modelData'=>'\Admin',
                    'view_index'=>"name",
//                    'required' => "",
                    'multiple' => "multiple",
                ],
                [
                    'title' => "color",
                    'name' => "color",
                    'type' => "color",
                    'field'=>"input",
                    'placeholder' => "Enter Email",
                ],
                [
                    'title' => "date",
                    'name' => "date",
                    'type' => "date",
                    'field'=>"input",
                    'placeholder' => "Enter Email",
                ],
                [
                    'title' => "datetime-local",
                    'name' => "datetime-local",
                    'type' => "datetime-local",
                    'field'=>"input",
                    'placeholder' => "Enter Email",
                ],

                [
                    'title' => "email",
                    'name' => "email",
                    'type' => "email",
                    'field'=>"input",
                    'placeholder' => "Enter Email",
                ],


                [
                    'title' => "number",
                    'name' => "number",
                    'type' => "number",
                    'field'=>"input",
                    'placeholder' => "Enter Email",
                ],
                [
                    'title' => "file",
                    'name' => "file",
                    'type' => "file",
                    'field'=>"input",
                    'placeholder' => "Enter Email",
                ],
//                [
//                    'title' => "file_multiple",
//                    'name' => "file_multiple[]",
//                    'type' => "multiple",
//                    'field'=>"input",
//                    'placeholder' => "Enter Email",
//                ],
            [
                'title' => "password",
                'name' => "password",
                'type' => "password",
                'field'=>"input",
                'placeholder' => "Enter Email",
            ],


        ];
        $this->update_fields =
            [

                [
                    'title' => "id",
                    'name' => "id",
                    'type' => "hidden",
                    'field'=>"input",
                    'placeholder' => "",
//                    'required' => "",
                    'update'=>""
                ],

                [
                    'title' => "select_admin_id",
                    'name' => "select_admin_id",
                    'type' => "text",
                    'field'=>"select",
                    'modelData'=>'\Admin',
                    'view_index'=>"name",
                    'update' => "",
                ],
                [
                    'title' => "multiple_admin_id",
                    'name' => "multiple_admin_id",
                    'type' => "text",
                    'field'=>"select",
                    'modelData'=>'\Admin',
                    'view_index'=>"name",
//                'required' => "",
                    'multiple' => "multiple",
                ],
                [
                    'title' => "color",
                    'name' => "color",
                    'type' => "color",
                    'field'=>"input",
                    'update' => "",
                ],
                [
                    'title' => "date",
                    'name' => "date",
                    'type' => "date",
                    'field'=>"input",
                    'update' => "",
                ],
                [
                    'title' => "datetime-local",
                    'name' => "datetime-local",
                    'type' => "datetime-local",
                    'field'=>"input",
                    'update' => "",
                ],

                [
                    'title' => "email",
                    'name' => "email",
                    'type' => "email",
                    'field'=>"input",
                    'update' => "",
                ],


                [
                    'title' => "number",
                    'name' => "number",
                    'type' => "number",
                    'field'=>"input",
                    'update' => "",
                ],
                [
                    'title' => "file",
                    'name' => "file",
                    'type' => "file",
                    'field'=>"input",
                    'update' => "",
                ],
//                [
//                    'title' => "file_multiple",
//                    'name' => "file_multiple[]",
//                    'type' => "multiple",
//                    'field'=>"input",
//                    'placeholder' => "Enter Email",
//                ],
            [
                'title' => "password",
                'name' => "password",
                'type' => "password",
                'field'=>"input",
                'update' => "",
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

        $data['pageHeader'] = $this->pageHeader;
        $data['show_fields'] = $this->show_fields;
        $data['insert_fields'] = $this->insert_fields;
        $data['update_fields'] = $this->update_fields;
        $data['view_data'] = Demo::with('admin:id,name')->get();
        $data['route_create'] = route('admin.demos.store');
        return view('backend.pages._ajax_index',$data);
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
        $validator = Validator::make($request->all(), [
//            'number' => 'required|min:2',
//            'select_admin_id' => 'required',
//            'email' => 'required|email|unique:demos',
//            'date' => 'date',
//            'color' => 'required',
//            'password' => 'required|min:8',
        ]);
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {

            return response()->json(
                ['status'=> 422,
                    'errors'=>$validator->errors()
                ]);

        }
        //  $send = Demo::insert($request->except($this->except_column));
        $send = new Demo();
        foreach ($this->insert_fields as $key => $value) {
            if ($value['type']=='file') {
                $file = $request->file($value['name']);
                $send->{$value['name']}= imageUpload($file);

            }elseif(isset($value['multiple'])) {

                $send->{$value['name']} = json_encode($request->{$value['name']});
            }
            else{

                $send->{$value['name']} = $request->{$value['name']};
            }
        }

        $send->save();
        $send->id;
//         return back();
        if ($send){
            return response()->json($send);
        }else{
            return response()->json([
                'status'=>400,
                'errors'=>"error"
            ]);
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
//        if (is_null($this->user) || !$this->user->can('admin.edit')) {
//            abort(403,'Unauthorized Access');
//        }

         $data = Demo::find($id);
        $route = route("admin.demos.update",$data->id);
        if ($data){
            return response()->json([
                'status'=>200,
                'student'=>$data
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"error"
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // if (is_null($this->user) || !$this->user->can('admin.edit')) {
        //     abort(403,'Unauthorized Access');
        // }

        $send = Demo::findOrFail($id);
        foreach ($this->insert_fields as $key => $value) {

            if ($value['type']=='file') {
                if($request->hasFile($value['name']))
                {
                    $file = $request->file($value['name']);
                    $file_name = time() . '.' . $file->getClientOriginalExtension();
                    $send->{$value['name']}= $file_name;
                    $file->move(public_path('images/'), $file_name);
                }

            }elseif(isset($value['multiple'])) {

                $send->{$value['name']} = json_encode($request->{$value['name']});
            }
            else{

                $send->{$value['name']} = $request->{$value['name']};
            }
        }
        $send->save();
        if ($send){
            return response()->json($send);
        }else{
            return response()->json([
                'status'=>400,
                'errors'=>"error"
            ]);
        }


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
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            abort(403,'Unauthorized Access');
        }
        $data = Demo::find($id);
        $data->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Successfull.'
        ]);
    }
}

