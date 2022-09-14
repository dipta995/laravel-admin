<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public $user;
    public $pageHeader;

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
            'index_button' => "admin.dashboards.index",
            'create_button' => "admin.dashboards.index"
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

        $users = User::all();
        return view('backend.pages.users.index',compact('users','pageHeader'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403,'Unauthorized Access');
        }
        $pageHeader = $this->pageHeader;

        $roles = Role::all();
        return view('backend.pages.users.create',compact('roles','pageHeader'));
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
        $request->validate([
            'name'=> 'required|max:50',
            'email'=> 'required|unique:users',
            'password'=> 'required|min:8|confirmed',
        ],[
            'name.required' => 'Please Insert New User Name'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }
        session()->flash('success','User has Been created');
        return redirect()->route('admin.users.index');


        // $user = User::create(['name' => $request->name]);
        // $permissions = $request->permissions;
        // if ($user) {
        //     if (!empty($permissions)) {
        //         $user->syncPermissions($permissions);
        //     }
        //     return back()->with('success','New User Created');
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

        $user = User::find($id);
        $roles = Role::all();
        return view('backend.pages.users.edit',compact('user','roles','pageHeader'));
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

        $user = User::find($id);
        $request->validate([
            'name'=> 'required|max:50',
            'email'=> 'required|email|unique:users,email,'.$id,
            'password'=> 'nullable|min:8|confirmed',
        ],[
            'name.required' => 'Please Insert New User Name'
        ]);
        // $user = new User();
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
        session()->flash('success','User has Been Updated');
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
         $user = User::findById($id);
         if (!is_null($user)) {
             $user->delete();
         }
         session()->flash('success','user has been deleted');
         return back();

    }
}

