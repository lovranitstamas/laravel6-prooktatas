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

    public function create()
    {
        $customer = new Customer();

        return view('admin.customers.create')->with('customer', $customer);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'description' => 'required',
            'password' => 'required|confirmed'
        ]);

        $customer = new Customer();
        $customer->setAttributes($request->all());

        try {

            $customer->save();
            session()->flash('success', 'Ügyfél elmentve');

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function edit($customerId)
    {
        $customer = Customer::findOrFail($customerId);

        return view('admin.customers.edit')->with('customer', $customer);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $request->id,
            'description' => 'required',
            'password' => 'confirmed'
        ]);

        try {

            $customer = Customer::findOrFail($id);
            $customer->setAttributes($request->all());

            $customer->save();
            session()->flash('success', 'Ügyfél módosítva');

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        //return redirect()->back();
        return redirect('/admin/customer/' . $id . '/modify');
    }


}
