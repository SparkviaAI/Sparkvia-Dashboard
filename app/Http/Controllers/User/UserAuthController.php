<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Setting;
use App\Models\Wallet;
use App\Models\Theme;
use App\Models\Currency;
use App\Utils\Settings;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;  
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;


class UserAuthController extends Controller
{
    
    // DISCORD LOGIN ROUTES START
    public function discordLogin()
    {
        $redirectUrl = 'https://discord.com/api/oauth2/authorize';
        $queryParams = [
            'client_id' => '1163774725965754498',
            'response_type' => 'code',
            'redirect_uri' => 'https://test.cardanogpt.ai/oauth2/login/redirect',
            // 'redirect_uri' => 'https://cardanostaging.trickywebsolutions.com/oauth2/login/redirect',
            // 'redirect_uri' => 'http://127.0.0.1:8000/oauth2/login/redirect',
            // 'redirect_uri' => 'https://aicardanogpt.trickywebsolutions.com/oauth2/login/redirect',
            'scope' => 'identify',
        ];

        return redirect()->to($redirectUrl . '?' . http_build_query($queryParams));
    }


    private function exchangeCode($code)
    {
        //////////////////////////////// USE THIS CODE FOR LIVE //////////////////////////////////////
        $response = Http::asForm()->post('https://discord.com/api/oauth2/token', [
            'client_id' =>'1163774725965754498',
            'client_secret' => 'akDMmdaQsMB2XRYBTvMOFGhXXz3EQK30',
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => 'https://test.cardanogpt.ai/oauth2/login/redirect',
            // 'redirect_uri' => 'https://cardanostaging.trickywebsolutions.com/oauth2/login/redirect',
            // 'redirect_uri' => 'https://aicardanogpt.trickywebsolutions.com/oauth2/login/redirect',
            'scope' => 'identify',
        ]);
        //////////////////////////////// USE THIS CODE FOR LIVE //////////////////////////////////////


        // $response = Http::asForm()->withOptions(['verify' => false])->post('https://discord.com/api/oauth2/token', [
        //     'client_id' => '1163774725965754498',
        //     'client_secret' => 'akDMmdaQsMB2XRYBTvMOFGhXXz3EQK30',
        //     'grant_type' => 'authorization_code',
        //     'code' => $code,
        //     'redirect_uri' => 'http://127.0.0.1:8000/oauth2/login/redirect',
        //     'scope' => 'identify',
        // ]);        

        $credentials = $response->json();
        $accessToken = $credentials['access_token'];
        
        //////////////////////////////// USE THIS CODE FOR LIVE //////////////////////////////////////
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get('https://discord.com/api/v6/users/@me');
        //////////////////////////////// USE THIS CODE FOR LIVE //////////////////////////////////////

        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . $accessToken,
        // ])->withOptions(['verify' => false])->get('https://discord.com/api/v6/users/@me');
        
        return $response->json();
    }


    public function handleDiscordCallback(Request $request)
    {

        // Check if there is an error in the request
        if ($request->has('error')) {
            Session::flash('error', "Oops! Something went wrong. Please try again");
            return redirect(route('getHomePage'));
        }

        $code = $request->input('code');
        $user = $this->exchangeCode($code);
        
        // Check for member 
        $guildId = "1116722706319155262";

        $userIdToCheck = $user['id'];
        
        $guildMembersUrl = "https://discord.com/api/v9/guilds/{$guildId}/members/{$userIdToCheck}";

        // Headers for the request
        $headers = [
            'Authorization' => 'Bot MTE2Mzc3NDcyNTk2NTc1NDQ5OA.Gs-Vg9.D4ZQcWvRaEHP-yvZLPSyY4UUTj4VNETPTEWjOk'
        ];

        $params = [
            'limit' => 50,
        ];


        try {
            ////////////////////////////// USE THIS CODE FOR LIVE ////////////////////////////////////
            $response = Http::withHeaders($headers)->get($guildMembersUrl, $params);
            ////////////////////////////// USE THIS CODE FOR LIVE ////////////////////////////////////

            // $response = Http::withHeaders($headers)->withOptions(['verify' => false])->get($guildMembersUrl, $params);
        
            if ($response->status() == 200) {
                $guildMembers = $response->json();
                // dd($guildMembers);
                $userFound = false;
        
                $cyborgId = '1167057548248092732';
                $writerId = '1189813721351077989';

                $getGlobalname = $guildMembers['user']['global_name'] ?? NULL;
                $getUsername = $guildMembers['user']['username'] ?? NULL; 
                
                foreach ($guildMembers['roles'] as $member) {
                    if (isset($member) && (($cyborgId == $member) || ($writerId == $member))) {

                        $userFound = true;
        
                        $checkUser = User::where('discord_id', $userIdToCheck)->first();
        
                        if (empty($checkUser)) {   
                            
                            // CREATE NEW USER
                            $user = User::create([
                                'name' => $getGlobalname,
                                'username' => $getUsername,
                                'discord_id' =>  $userIdToCheck,
                                'email_verified_at' => now(),
                            ]);
        
                            // GIVE NEW USER THE ROLE
                            $user->assignRole('user');   
        
                            // GIVE NEW USER COINS
                            $giveCoins = Wallet::create([
                                'user_id' => $user->id,
                                'currency_id' => Currency::CARDANO,
                                'balance_in_wallet' => 0,
                            ]);

                            // LOGIN THE NEW USER
                            Auth::guard('user')->login($user);
                            // Auth::login($user);

                            if (Auth::guard('user')->check()) {
                            // if (!empty(auth()->user())) {
                                Session::flash('success', "User Login Successful");
                                return redirect(route('userDashboard'));
                            } else {
                                Session::flash('error', "Account not associated with Admin's Discord");
                                return redirect(route('getHomePage'));
                            }
                        } else {
                            Auth::guard('user')->login($checkUser);
                            // Auth::login($checkUser);
        
                            if (Auth::guard('user')->check()) {
                            // if (!empty(auth()->user())) {
                                Session::flash('success', "User Login Successful");
                                return redirect(route('userDashboard'));
                            } else {
                                Session::flash('error', "Account not associated with Admin's Discord");
                                return redirect(route('getHomePage'));
                            }
                        }
                    }
                }
        
                if (!$userFound) {
                    Session::flash('error', "Account not associated with Admin's Discord");
                    return redirect(route('getHomePage'));
                }
            } else {
                Session::flash('error', "Account not associated with Admin's Discord");
                return redirect(route('getHomePage'));
            }
        } catch (\Exception $e) {
            Session::flash('error', "Oops! Something went wrong. Please try again");
            return redirect(route('getHomePage'));
            // return "Error: " . $e->getMessage();
        }

    }

    // DISCORD LOGIN ROUTES END


    public function userLogout(Request $request)
    {
        Auth::guard('user')->logout();
        Session::flash('success', 'You are logout sucessfully');
        return redirect(route('getHomePage'));
    }


    public function getThemeData(Request $request)
    {
        $getUserTheme = Theme::where('panel','User Panel')->first();
        return response()->json(['status' => 'success', 'message' => $getUserTheme->theme], 200);
    }



    public function handleLoggin()
    {
        $logoSetting = Setting::where([
            'key' => Settings::BRAND_LOGO,
            'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        ])->first();
        return view('users.login',compact('logoSetting'));
    }

    public function handleRegisterr()
    {
        $logoSetting = Setting::where([
            'key' => Settings::BRAND_LOGO,
            'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        ])->first();
        return view('users.register',compact('logoSetting'));
    }

    

    public function userRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8|max:30',
            'password_confirmation' => 'required|same:password',
        ]);
        try {
            $checkUser = User::where('email', $request->email)->first();
            if (empty($checkUser)) {  
                $getUsername = explode('@', $request->email)[0];                       
                // CREATE NEW USER
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $getUsername,
                    'email_verified_at' => now(),
                    'password' => Hash::make($request->password),
                ]);

                // GIVE NEW USER THE ROLE
                $user->assignRole('user');   

                // GIVE NEW USER COINS
                $giveCoins = Wallet::create([
                    'user_id' => $user->id,
                    'currency_id' => Currency::CARDANO,
                    'balance_in_wallet' => 100,
                ]);

                // LOGIN THE NEW USER
                Auth::guard('user')->login($user);
                // Auth::login($user);

                if (Auth::guard('user')->check()) {
                    Session::flash('success', "User Registeration Successful");
                    return redirect(route('userDashboard'));
                } else {
                    Session::flash('error', "Error while Registering new Account");
                    // return redirect(route('handleRegisterr'));
                    return back();
                }
            }else {
                Session::flash('error', "Email already associated with another account");
                // return redirect(route('handleRegisterr'));
                return back();
            }
        } catch (\Exception $e) {
            // Session::flash('error', "Oops! Something went wrong. Please try again");
            Session::flash('error', "Oops!".$e->getMessage().".");
            // return redirect(route('handleRegisterr'));
            return back();
        }

    }


    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:8|max:20',
        ]);
        try {
            if (Auth::guard('user')->attempt([
                'email' => $request->email,
                'password' => $request->password,
                'status' => '1'
            ])) {
                $user = Auth::guard('user')->user();

                if ($user->hasRole('user')) {
                    Session::flash('success', 'User login successful');
                    return redirect()->route('userDashboard');
                } else {
                    Auth::guard('user')->logout();
                    Session::flash('error', 'You do not have access');
                    return back();
                }
            } else {
                Session::flash('error', 'Incorrect Email or Password');
                return back();
            }
        } catch (\Exception $e) {
            Session::flash('error', "Oops!".$e->getMessage().".");
            // return redirect(route('handleRegisterr'));
            return back();
        }

    }


    public function userForgotPassword()
    {
        $logoSetting = Setting::where([
            'key' => Settings::BRAND_LOGO,
            'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        ])->first();
        return view('users.forgot-password',compact('logoSetting'));
    }


    public function userForgotPasswordPost(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:rfc,dns',
        ]);
        $checkEmail = User::where('email', $request->email)->first();
        if(!empty($checkEmail)){
            $toaddress = $checkEmail->email;
            try {    

                $checkEmail->notify(new \App\Notifications\UserResetPasswordNotification(
                    app('auth.password.broker')->createToken($checkEmail),
                    $checkEmail->email
                ));


                // Password::sendResetLink(["email" => $toaddress]);
                // Session::flash('success', 'Email sent Successfully');
                // return redirect(route('handleLoggin'));

                // Use the 'users' broker specifically for regular users
                // Password::broker('users')->sendResetLink(
                //     ["email" => $toaddress]
                // );
                Session::flash('success', 'Email sent Successfully');
                return redirect(route('handleLoggin'));
                // return $status === Password::RESET_LINK_SENT
                //     ? back()->with(['status' => __($status)])
                //     : back()->withErrors(['email' => __($status)]);
                    
            } catch (\Throwable $e) {
                dd($e->getMessage());
            }
        }else{
            Session::flash('error', 'Email not found');
            return back();
        }
    }


    public function resetUserPassword()
    {
        $logoSetting = Setting::where([
            'key' => Settings::BRAND_LOGO,
            'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        ])->first();
        return view('users.reset-password',compact('logoSetting'));
    }


    public function updateUserPasswordPost(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ]);
        try{
            $getData = User::where('email',trim($request->email))->first();
            if(!empty($getData)){
                $getData->password = Hash::make($request->password);
                $getData->save();
                Session::flash('success', 'Password Updated Successfully');
                return redirect(route('handleLoggin'));
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
            Session::flash('error', 'Error while updating password');
            return back();
        }
    }


}
