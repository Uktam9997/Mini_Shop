<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function registr(Request $request)
    {
        $registrData = Validator::make($request->all(), 
        [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if($registrData->fails()){
            return back()->withErrors($registrData);
        }
        User::create(
            [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            ]);
        return redirect()->route('home');
    }

    public function authUser(Request $request){
        $loginUser = Validator::make($request->all(),
        [
            'name' => 'required',
            'password' => 'required|min:8'
        ]);

        if($loginUser->fails()){
            return back()->withErrors($loginUser);
        }

        if(!Auth::attempt(['name' => $request->name, 'password' => $request->password])){
            return back()->withErrors('нет такого ползователя');
        }
        return redirect()->route('home');
    }


}

