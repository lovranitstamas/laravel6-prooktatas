<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {

        $i = rand(1, 5);
        $b = rand(1, 3);

        return view('index')
            ->with('i', $i)
            ->with('b', $b);
    }

    public function show(Request $request, $page)
    {

        return view('frontend.tests.show')
            ->with('page', $page);
    }

    public function register(Request $request)
    {

        $rules = [
            'name' => 'required',
            'password' => 'required | confirmed'
        ];

        $this->validate($request, $rules);
        $name = $request->input('name');

        //return view postnál nem!!!!!!!!!!!!!!! frissitéssel elküldödik ugyanaz a post
        return redirect()->route('index');
    }
}
