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
//                [
//                    'title' => "file",
//                    'name' => "file",
//                    'type' => "file",
//                    'field'=>"input",
//                    'placeholder' => "Enter Email",
//                ],
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

        $pageHeader = $this->pageHeader;
        $show_fields = $this->show_fields;
        $insert_fields = $this->insert_fields;
        $update_fields = $this->update_fields;

       $view_data = Demo::with('admin:id,name')->get();
        $route = 'admin.demos.edit';
        $route_create = route('admin.demos.store');
        return view('backend.pages._create',compact('view_data','pageHeader','show_fields','insert_fields','update_fields','route','route_create'));
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
        $route = route('admin.demos.store');
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

        $validator = Validator::make($request->all(), [
            'number' => 'required|min:22',
            'select_admin_id' => 'required',
            'email' => 'required|email|unique:demos',
            'date' => 'date',
            'color' => 'required',
            'password' => 'required|min:8',
            'select_admin_id' => 'required',
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
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $send->{$value['name']}= $file_name;
                $file->move(public_path('images/'), $file_name);

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
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403,'Unauthorized Access');
        }
        $pageHeader = $this->pageHeader;
        $update_fields = $this->update_fields;
        $insert_fields = $this->insert_fields;
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
        return view('backend.pages._create',compact('pageHeader','update_fields','data','route'));
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

