<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Setting;
use App\Models\Theme;
use App\Utils\Settings;


class LandingPageController extends Controller
{
    public function getHomePage()
    {
        $logoSetting = Setting::where([
            'key' => Settings::BRAND_LOGO,
            'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        ])->first();

        $faviconSetting = Setting::where([
            'key' => Settings::BRAND_FAVICON,
            'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        ])->first();

        $emailSetting = Setting::where([
            'key' => Settings::BRAND_EMAIL,
            'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        ])->first();

        return view('landing_page',compact('logoSetting','faviconSetting','emailSetting'));
    }


    public function getThemeDataLanding(Request $request)
    {
        $getLandingTheme = Theme::where('panel','Home Page')->first();
        return response()->json(['status' => 'success', 'message' => $getLandingTheme->theme], 200);
    }
    
}
