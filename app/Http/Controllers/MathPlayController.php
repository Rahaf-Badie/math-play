<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as RoutingController;

class MathPlayController extends RoutingController
{
    public function index()
    {
        // منطق الدالة هنا
        return view('index');
    }
    
}
