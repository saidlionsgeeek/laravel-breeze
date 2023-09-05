<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function store(Request $request){
        request()->validate([
            "name"=>"required",
            "email"=>"email|required",
        ]);

        $exist = User::where("email", $request->email)->first();
        if (!$exist) {
            $password = Str::random(12);
            User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password" => bcrypt($password),
            "usertype"=>"unvirified",
        ]);
            $mailData=[
                "title" => "7na l9owa li bratna",
                "password" => $password,
            ];
            FacadesMail::to($request->email)->send(new DemoMail($mailData));
            return redirect()->back();
        }else{
            return redirect()->back();
        }
        
        
    }
}
