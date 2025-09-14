@extends('layout')

@section('title','Manage Customers')

@section('content')

<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: linear-gradient(135deg, #11998e, #38ef7d);
        margin: 0;
        padding: 0;
        color: #fff;
    }

    .manage-customers-wrapper {
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        margin-top: 35px;
        flex-direction: column;
        padding: 0 40px;
    }

    h1 {
        text-align: center;
        width: 100%;
        margin-bottom: 20px;
        font-weight: 700;
        color: #fff;
    }

    .form-container, .table-container {
        width: 100%;
        max-width: 1200px;
        background: #fff;
        color: #333;
        border-radius: 12px;
        padding: 20px 30px;
        margin: 20px auto;
        box-shadow: 0 4px 14px rgba(0,0,0,0.2);
    }

    .form-container label {
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
    }

    .form-container input {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 15px;
        border-radius: 6px;
        border: 1px solid #ccc;
        outline: none;
        transition: border 0.3s;
    }

    .form-container input:focus {
        border-color: #38ef7d;
    }

    .btn-primary {
        background: #11998e;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.3s;
    }

    .btn-primary:hover {
        background: #0d776e;
    }

    .btn-action {
        border: none;
        border-radius: 6px;
        padding: 8px 14px;
        font-weight: 600;
        cursor: pointer;
        margin: 2px 0;
    }

    .btn-warning {
        background: #f39c12;
        color: #fff;
    }

    .btn-warning:hover {
        background: #d68910;
    }

    .btn-danger {
        background: #e74c3c;
        color: #fff;
    }

    .btn-danger:hover {
        background: #c0392b;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        text-align: left;
    }

    th {
        background: #f9f9f9;
        color: #333;
    }

    td a {
        color: inherit;
        text-decoration: none;
    }
</style>

<div class="manage-customers-wrapper">
    <h1>Manage Customers</h1>

    @if(request()->has('create-new-customer'))

    <!-- Add New Customer Form -->
    <div class="form-container">
        <form method="POST" action="addnewcustomer">
            @csrf

            <label for="name">Customer Name</label>
            <input type="text" name="name" id="name" placeholder="Enter customer's name..." required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter customer's email..." required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter the password.">


            <label for="address">Address</label>
            <input type="text" name="address" id="address" placeholder="Enter customer's address..." required>


            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" placeholder="Enter customer's phone number..." required>

            <input type="hidden" name="role" value="user">
            

            <button type="submit" class="btn-primary">Submit</button>
        </form>
    </div>

    @elseif(Request::is('admin/manage_customers'))

    <!-- Customers Table -->
    <div class="table-container">
        <button class="btn-warning" style="padding: 10px 12px; border:none; border-radius:8px;">
            <a style="color:inherit; text-decoration:none;" href="?create-new-customer">Add New Customer</a>
        </button>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>
                        <button class="btn-action btn-warning">
                            <a href="editcustomer?edit_customer_id={{ $customer->id }}">Edit</a>
                        </button>
                        <button class="btn-action btn-danger">
                            <a href="deletecustomer?delete_customer_id={{ $customer->id }}">Delete</a>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @endif
</div>

@endsection
