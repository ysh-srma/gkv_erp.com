<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Mail;
use Str;

class AuthController extends Controller
{
    public function login()
    {
    // dd(Hash::make(123456));
        if(!empty(Auth::check()))
            {
                if(Auth::user()->user_type == 1)
                {
                    return redirect('admin/dashboard');
                }
                else if(Auth::user()->user_type == 2)
                {
                    return redirect('teacher/dashboard');
                }
                else if(Auth::user()->user_type == 3)
                {
                    return redirect('student/dashboard');
                }
                else if(Auth::user()->user_type == 4)
                {
                    return redirect('parents/dashboard');
                }
            }
            
            return view('auth.login');
    }
    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember  ))
       {
            if(Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2)
            {
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type == 4)
            {
                return redirect('parents/dashboard');
            }
       }
        
        else
        {
            return redirect()->back()->with('error', 'Please enter the correct Email or Password');
        }
    }


    public function forgotpassword()
    {
       
        return view('Auth.forgot');
    }

    public function relogin()
    {
       
        return view('Auth.login');
    }

    public function PostForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
       if(!empty($user))
       {
        $user->remember_token = Str::random(30);
        $user->save();

        Mail::to($user->email)->send(new ForgotPasswordMail($user));
        return redirect()->back()->with('success', "Password reset link has been sent to your email.");
       }
       else{
        return redirect()->back()->with('error', "Email not found in the system.");
       }
        
    }

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('Auth.reset', $data);
        }
        else
        {
            ABORT(404, 'Token not found');
        }
    }

        public function PostReset($token, Request $request)
        {
            
            if($request->password == $request->cpassword)
            {
                $user = User::getTokenSingle($token);
                $user->password = Hash::make($request->password);
                $user->remember_token = Str::random(30);
                $user->save();
                return redirect(url('log-in'))->with('success', "Password has been reset successfully.");
            }
            else
            {
                return redirect()->back()->with('error', "Password and Confirm Password do not match.");
            }
        }
        















    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }


}
