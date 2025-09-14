<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function displayAdmin(){

        $customer = session('customer');

      return view('admin.dashboard',['customer'=>$customer]);
    }


    public function displayUserDashboard(){

        $customer = session('customer');

        return view('customer.dashboard',['customer'=>$customer]);
    }
}
