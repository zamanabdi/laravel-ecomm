<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    //

    public function createCustomer(Request $req){

         


         Customer::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
            'address'=>$req->address,
            'phone'=>$req->phone,
            'role'=>$req->role,
        ]);


        return redirect('login-form');

    }
}
