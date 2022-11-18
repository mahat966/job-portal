<?php

namespace App\Http\Controllers;
use\Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
use\Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

class AdminController extends Controller
{
    function login(){
        // dd("hello");
        return view('auth.login');
    }
    public function registerAdmin(){
        return view('auth.register');
    }

    function save(request $request){
        // dd($request->all());
        //validate rquests
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12'

        ]);
        //insert data into database
        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $save = $users->save();

        if($save){
            // return view('auth.register') ->with('success','New user has been created succesfully');
            return back()->with('success','New user has been created successfully added to database');
        }else{
            return back()->with('fail','something went wrong, try again later');
        }
        



    }
    function check(request $request){
        
        //validate requests
        $validate = $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'

        ]);

        $userinfo = Admin::where('email','=',$request->email)->first();
        if(!$userinfo){
                return redirect()->route('login')->with('fail','We do not recognize your email address');

            }else{
                //check password
                if(Auth::attempt($validate)){
                    $request->session()->regenerate();
                    return redirect()->intended('blogs');
                }else{                
                return redirect()->route('login')->with('fail','Invalid Credentials');
            }
        }

    }
}
