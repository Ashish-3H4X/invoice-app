<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalCustomers' => Customer::count(),
            'totalServices'  => Service::count(),
            'totalInvoices'  => Invoice::count(),
            'paidInvoices'   => Invoice::where('status', 'paid')->count(),
        ]);
    }
}
