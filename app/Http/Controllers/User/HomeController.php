<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\Prompt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    
    public function userDashboard()
    {
        // Get the logged-in user using the 'user' guard
        $getUserDetails = Auth::guard('user')->user();
        // $getUserDetails = auth()->user();

        $getUserWallet = Wallet::where('user_id',$getUserDetails)->first();
        $getThreeRandomPrompts = Prompt::with('category')->inRandomOrder()->take(3)->get();

        return view('users.dashboard', compact('getUserDetails','getUserWallet','getThreeRandomPrompts'));
    }


    public function getUserWalletData(Request $request){
        // CUT PAYMENT AFTER THE RESPONSE IS GENERATED
        $getUserWallet = Wallet::where('user_id',$request->userId)->first();
        if(!empty($getUserWallet)){
            $getUserWallet->balance_in_wallet = ($getUserWallet->balance_in_wallet) - 1;
            $getUserWallet->save();
        }
        $data = Wallet::where('user_id', $request->userId)->first();
        return response()->json($data);
    }


}
