<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function homePage()
    {
        return view('backend.layout');
    }
}