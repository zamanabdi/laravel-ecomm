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


    // Fetch all customers for admin
    public function fetchAllCustomers(Request $req){
       
        $customers = Customer::all();

        return view('admin.manage-customers',['data'=>$customers]);
    }


    // confirm before delete
    public function confirmDelete(Request $req){
      $currId = $req->query('delete_customer_id');

      return view('admin.confirm-delete-customer',['delete_id'=>$currId]);
    }


    //handle delete action
    public function handleDeleteAction(Request $req){
      $delete_id = $req->delete_customer_id;

      Customer::destroy($delete_id);

      return redirect('admin/manage_customers')->with('success','User deleted successfully');
    }



    // Create new customer by admin
public function addNewCustomer(Request $req){

  Customer::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
            'address'=>$req->address,
            'phone'=>$req->phone,
            'role'=>$req->role,
        ]);

        return redirect('admin/manage_customers')->with('Success','New User Added Successfully.');

}



// edit customer - by admin


// display edit form
public function displayEditForm(Request $req){
  $currId = $req->query('edit_customer_id');

  $customer = Customer::findOrFail($currId);

  return view('admin.edit-customer',['customer'=>$customer]);
}




public function editCustomer(Request $req){
  $currId = $req->customer_id;

  $customer = Customer::findOrFail($currId);

  $customer->name = $req->name;
  $customer->email = $req->email;
  $customer->address = $req->address;
  $customer->phone = $req->phone;

  $customer->save();

  return redirect('admin/manage_customers')->with('success','Customer updated successfully');
}



// User Dashboard
public function displayEditProfile(Request $req){
   $edit_id = session('customer.id');

   $customer = Customer::findOrFail($edit_id);

   return view('customer.edit-my-profile',['customer'=>$customer]);
}


// currently not in use
// public function displayOrderHistory(){
     
//   return view('customer.order-history');
// }


public function handleProfileUpdate(Request $req){
 $currId = $req->user_id;

 $customer = Customer::findOrFail($currId);

 $customer->name = $req->name;
 $customer->email = $req->email;
 if($req->filled('password')){
    $customer->password = Hash::make($req->password);
 }
 $customer->address = $req->address;
 $customer->phone = $req->phone;

 $customer->save();

 return redirect('login-form')->with('success','Profile updated successfully.');
 

}

}
