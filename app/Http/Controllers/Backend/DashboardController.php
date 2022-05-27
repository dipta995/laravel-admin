<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pageHeader=[
            'title' => "Booking",
            'sub_title' => ""
        ];
        return view('backend.pages.dashboard.index',compact('pageHeader'));
    }
}
