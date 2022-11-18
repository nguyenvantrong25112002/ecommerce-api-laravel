<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        // $countCustomer = count(Customer::all());
        // $countAdmin = count(Admin::all());
        // $countProduct = count(Product::all());
        // $countBill = count(Bill::all());
        $countCustomer = 45;
        $countAdmin = 23;
        $countProduct = 45;
        $countBill = 67;
        return view('pages.dashboard', compact(
            'countCustomer',
            'countAdmin',
            'countProduct',
            'countBill',
        ));
    }
}