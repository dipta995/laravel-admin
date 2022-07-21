<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->check()!='true'){
            return redirect('admin/login');
        }
        $pageHeader=[
            'title' => "Booking",
            'sub_title' => ""
        ];
        return view('backend.pages.dashboard.index',compact('pageHeader'));
    }
}
