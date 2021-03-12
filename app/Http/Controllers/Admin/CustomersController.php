<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{

    public function index(Request $request)
    {

        $search = $request->input('search');
        $search['orderBy'] = $request->input('orderBy');
        $search['orderDir'] = $request->input('orderDir');

        //$customers = Customer::all();
        $customers = Customer::search($search)->get();

        return view('admin.customers.index')
            ->with('customers', $customers);

    }


}
