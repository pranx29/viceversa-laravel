<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::whereType('customer')->paginate(10);
        return view('admin.customers.index', [
            'customers' => $customers
        ]);
    }
}
