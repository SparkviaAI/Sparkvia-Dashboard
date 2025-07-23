<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;


class AdminAuthController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:8|max:20',
        ]);
        // dd("in");
        if (Auth::attempt(['email' => $request->email,  'password' => $request->password, 'status' => '1'])) {
            // dd(Auth::user());
            $checkRole = Auth::user()->hasRole('admin');
            if ($checkRole) {
                Session::flash('success', trans('translation.you_are_logged_in_sucessfully'));
                return redirect()->route('adminDashboard');
            } else {
                Auth::logout();
                Session::flash('error', trans('translation.invalid_email_and_password'));
                // Session::flush();
                return back();
            }
        } else {
            Auth::logout();
            Session::flash('error', trans('translation.invalid_email_and_password'));
            // Session::flush();
            return back();
        }
    }

    public function adminLogout(Request $request)
    {
        Auth::logout();
        Session::put('success', trans('translation.you_are_logout_sucessfully'));
        // Session::flush();
        return redirect(route('login'));
    }


    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }


    public function forgotPasswordPost(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:rfc,dns',
        ]);
        $checkEmail = User::where('email', $request->email)->first();
        if(!empty($checkEmail)){
            $toaddress = $checkEmail->email;
            try {    
                Password::sendResetLink(["email" => $toaddress]);
                Session::flash('success', trans('translation.email_sent_successfully'));
                return redirect(route('login'));
            } catch (\Throwable $e) {
                dd($e->getMessage());
            }
        }else{
            Session::flash('error', trans('translation.email_not_found'));
            return back();
        }
    }


    public function resetPassword()
    {
        return view('admin.auth.reset-password');
    }


    public function updatePasswordPost(Request $request){
        $this->validate($request, [
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ]);

        $getData = User::where('email',$request->email)->first();
        if(!empty($getData)){
            $getData->password = Hash::make($request->password);
            $getData->save();
            Session::flash('success', trans('translation.password_updated_successfully'));
            return redirect(route('login'));
        }
        Session::flash('error', trans('translation.error_while_updating_password'));
        return back();
    }
}
