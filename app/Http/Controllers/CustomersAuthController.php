<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersAuthController extends Controller
{
    //4.óra
    public function create()
    {
        return view('frontend.auth.create');
    }

    //4.óra
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //$customer = Customer::where('email', 'LIKE', $request->input('email'))->first();

        $credentials = $request->only('email', 'password');

        //\Auth::loginUsingId(1) true ha session második paraméternek;
        \Auth::guard('customer')->attempt($credentials);

        if (\Auth::guard('customer')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->route("customers.index");
        }

        return redirect()->back();

    }

    //4.óra
    public function destroy()
    {
        \Auth::guard('customer')->logout();
        return redirect()->route("index");
    }
}
