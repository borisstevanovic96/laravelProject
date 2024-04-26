<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\User;

class AuthManager extends Controller
{
    function login(){
        //ako je korisnik ulogovan ne moze pristupiti login stranici
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('login');
    }

    function registration(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('registration');
    }

    function userInfo(){
        if(!Auth::check()){
            return redirect(route('home'));
        }
        return view('userInfo');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('userInfo'));
        }

        return redirect(route('login'))->with("error", "Login details are not valid");

    }

    function registrationPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if(!$user){
            return redirect(route('registration'))->with("error", "Registration details are not valid");
        }

        return redirect(route('login'))->with("success", "Registration success");
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    function addPersonalInfo(Request $request){
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'dateOfBirth' => 'required',
            'carBrand' => 'required'
        ]);

        $data['first_name'] = $request->firstName;
        $data['last_name'] = $request->lastName;
        $data['date_of_birth'] = $request->dateOfBirth;
        $data['car_brand'] = $request->carBrand;

        $user = Auth::user();
        $user->update($data);

        return redirect(route('home'));
    }
}
