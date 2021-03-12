<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DropdownController extends Controller
{

    public function dropdown1()
    {
        return view('admin.dashboard.dropdown1');
    }

    public function dropdown2()
    {
        return view('admin.dashboard.dropdown2');
    }
}
