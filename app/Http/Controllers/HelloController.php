<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function greeting($message = 'SpaceTaxi') {
        return view('greeting', ['message' => $message]);
    }
}
