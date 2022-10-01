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
                    'title' => "name",
                    'name' => "name",
                    'type' => "text",
                    'field'=>"select",
                    'modelData'=>'\Admin',
                    'view_index'=>"name",
                    'required' => "",
                    'multiple' => "multiple",
                ],
                [
                    'title' => "email",
                    'name' => "email",
                    'type' => "email",
                    'field'=>"input",
                    'placeholder' => "Enter Email",
                ],
                [
                    'title' => "phone",
                    'name' => "phone",
                    'type' => "number",
                    'field'=>"input",
                    'placeholder' => "Enter Email",
                ],
                [
                    'title' => "image",
                    'name' => "image",
                    'type' => "file",
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
                    'required' => "",
                    'update'=>""
                ],
                [
                    'title' => "name",
                    'name' => "name",
                    'type' => "text",
                    'field'=>"select",
                    'modelData'=>'\Admin',
                    'view_index'=>"name",
                    'update'=>""
                ],


                [
                    'title' => "email",
                    'name' => "email",
                    'type' => "email",
                    'field'=>"input",
                    'placeholder' => "Enter Name",
                    'update'=>""
                ],

                [
                    'title' => "phone",
                    'name' => "phone",
                    'type' => "text",
                    'field'=>"input",
                    'placeholder' => "Enter Name",
                    'required' => "",
                    'update'=>""
                ],
                [
                    'title' => "image",
                    'name' => "image",
                    'type' => "file",
                    'field'=>"input",
                    'placeholder' => "Enter Name",
                    'required' => "",
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
        $insert_fields = $this->insert_fields;
        $update_fields = $this->update_fields;

        $view_data = Test::select('id','name','email')->get();
        $route = 'admin.tests.edit';
        $route_create = route('admin.tests.store');
        return view('backend.pages._ajax_index',compact('view_data','pageHeader','show_fields','insert_fields','update_fields','route','route_create'));
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
        return view('backend.pages._ajax_index',compact('pageHeader','insert_fields','route'));
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
            'name' => 'required',
            'phone' => 'required',
        ]);
        //  $send = Test::insert($request->except($this->except_column));
        $send = new Test();
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
        return $send;
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
        $data = Test::find($id);
        $route = route("admin.tests.update",$data->id);
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
        return view('backend.pages._ajax_index',compact('pageHeader','update_fields','data','route'));
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

        $send = Test::findOrFail($id);
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
        $data = Test::find($id);
        $data->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Successfull.'
        ]);
    }
}

