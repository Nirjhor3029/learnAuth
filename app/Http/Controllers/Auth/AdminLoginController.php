<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminLoginController extends Controller
{
    //

    public function __construct(){
        $this->middleware('guest:admin'); //admin is the guard level
    }

    public function showLoginForm(){
        return view('auth.admin-login');
    }

    public function login(Request $request){
        //return true;

        /*if not validate the laravel going to handle this probably return back */
        //validate the form data
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'

        ]);


        //attempt to log the user in
        //Auth::attempt($credentials,$remember); //default login attempt will try to login with default auth/user table

        if(Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password],$request->remember) ){ // attempt to login with admin table //
            //if successful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }
        else{
            //if unsuccessful, then redirect back to the login with the form data
            return redirect()->back()->withInput($request->only('email','remember'));
        }






    }
}
