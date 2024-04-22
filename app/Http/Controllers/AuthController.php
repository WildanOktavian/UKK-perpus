<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function authenticating(Request $request)
    {
       $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
       ]);

        // Check whether the login is valid or correct
       if (Auth::attempt($credentials))
       {
         // Check whether the user status = active
         if(Auth::user()->status != 'active'){
            $request->session()->regenerate();
            

            Alert::success('Success', 'Your account is not active yet. Please contact admin!');
            // Session::flash('status', 'Failed');
            // Session::flash('message', 'Your account is not active yet. Please contact admin!');
            return redirect('login');
         }

        $request->session()->regenerate();
         if(Auth::user()->role != 'user'){
            return redirect('dashboard');
         }
         return redirect('/');

       }

       Alert::error('Error', 'Login Invalid!');
      //  Session::flash('status', 'Failed');
      //   Session::flash('message', 'Login Invalid');
       return redirect('login');
    }

    public function storeRegis(Request $request)
    {
         $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'phone'=> 'max:255',
            'address'=> 'required',
         ]);
         
         $input = $request->all();
         $input['password'] = bcrypt($input['password']);
         $user = User::create($input);

         Alert::success('Success', 'Register success. Wait admin for approval!');
         // Session::flash('status', 'success');
         // Session::flash('message', 'Register success. wait admin for approval');
         return redirect('login');
    }

    public function logout(Request $request)
    {
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();
         return redirect('login');
    }
}
