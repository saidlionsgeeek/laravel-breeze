<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id()){
            $usertype = Auth()->user()->usertype;
            if ($usertype == "admin") {
                return view("home");
            }elseif ($usertype == "unvirified") {
                return view("newUserPassword");
            }elseif ($usertype == "user") {
                return view("dashboard");
            }else {
                return redirect()->back();
            }
        }
    }
    
}

