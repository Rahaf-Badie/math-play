<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MathPlayController extends Controller
{
    public function index()
    {
        return view('mathplay.index');
    }

    //public function games() {
    //    return view('mathplay.games');
    //}

    //public function profile() {
    //    return view('mathplay.profile');
    //}
}
