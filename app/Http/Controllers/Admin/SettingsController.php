<?php
// asset(($model->image) ? 'f_ads/'.$model->image : 'images/user_default.png')

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ChatBot;
use App\Models\Engine;
use App\Models\Menu;
use App\Models\User;
use App\Models\Setting;
use App\Models\AdminWalletKey;
use App\Traits\MediaUploadingTrait;
use App\Traits\ImageUpload;
use App\Utils\Settings;
use Illuminate\Http\RedirectResponse;
use App\Models\Theme;
use App\Models\Files;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;


class SettingsController extends Controller
{
    use MediaUploadingTrait, ImageUpload;

    public function payment()
    {
        $this->authorize('setting_edit');
        $setting = Setting::all();
        return view(
            'admin.settings.payment',
            compact('setting')
        );
    }

    public function aiSolutions()
    {
        $setting = Setting::all();
        $engines = Engine::pluck('title', 'id')->prepend(('PLease Select'), '');
        $chatEngines = Engine::where('type', 'chat')->pluck('title', 'id')->prepend(('PLease Select'), '');
        $chatBots = ChatBot::pluck('title', 'id')->prepend(('PLease Select'), '');
        return view(
            'admin.settings.ai-solutions',
            compact('setting', 'engines', 'chatBots', 'chatEngines')
        );
    }

    public function rewardful(): View
    {
        $this->authorize('setting_edit');

        $rewardful = Setting::all();

        return view('admin.settings.rewardful', compact('rewardful'));
    }

    public function google()
    {
        $this->authorize('setting_edit');
        $setting = Setting::all();
        return view(
            'admin.settings.google',
            compact('setting')
        );
    }

    public function customHeader()
    {
        $this->authorize('setting_edit');
        $setting = Setting::all();
        return view(
            'admin.settings.custom-header',
            compact('setting')
        );
    }

    public function theme()
    {
        $themes = Theme::pluck('title', 'id');
        return view('admin.settings.theme', compact('themes'));
    }

    public function brand(Request $request)
    {
        // $setting = Setting::all();
        // $logoSetting = Setting::firstOrCreate([
        //     'key' => Settings::BRAND_LOGO,
        //     'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        // ]);
        // $faviconSetting = Setting::firstOrCreate([
        //     'key' => Settings::BRAND_FAVICON,
        //     'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        // ]);
        // $authSetting = Setting::firstOrCreate([
        //     'key' => Settings::AUTH_LOGO,
        //     'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        // ]);
        // return view(
        //     'admin.settings.brand',
        //     compact('setting', 'logoSetting', 'faviconSetting', 'authSetting')
        // );

        $setting = Setting::all();
        $logoSetting = Setting::where([
            'key' => Settings::BRAND_LOGO,
            'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        ])->first();
        $faviconSetting = Setting::where([
            'key' => Settings::BRAND_FAVICON,
            'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        ])->first();
        $authSetting = Setting::where([
            'key' => Settings::AUTH_LOGO,
            'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        ])->first();
        return view(
            'admin.settings.brand',
            compact('setting', 'logoSetting', 'faviconSetting', 'authSetting')
        );
    }

    public function menu()
    {
        $this->authorize('setting_edit');

        $menus = Menu::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.settings.menu', compact('menus'));
    }

    // public function updateBrand(Request $request, Setting $setting)
    public function updateBrand(Request $request)
    {
        // dd($request->all());

        foreach ($request->setting as $key => $value) {
            Setting::saveByKey($key, $value);
        }

        $this->uploadBrandLogo($request);
        $this->uploadBrandIcon($request);
        $this->uploadAuthLogo($request);

        Session::flash('success', trans('translation.settings_updated_successfully'));
        return back();
    }

    public function uploadBrandLogo(Request $request)
    {
        // if ($request->input('brand_logo', false)) {
        //     if (!$setting->brandLogo || $request->input('brand_logo') !== $setting->brandLogo->file_name) {
        //         if ($setting->brandLogo) {
        //             $setting->brandLogo->delete();
        //         }
        //         $setting->addMedia(storage_path('tmp/uploads/' . basename($request->input('brand_logo'))))
        //             ->toMediaCollection('brand-logo');
        //     }
        // } elseif ($setting->brandLogo) {
        //     $setting->brandLogo->delete();
        // }

        if (!empty($request->brand_logo)) {
            $checkForImage = Setting::where('key',Settings::BRAND_LOGO)->first();
            if(!empty($checkForImage)){
                $file = $this->UploadImage($request->brand_logo, Files::FOLDER_ADMIN,$checkForImage->value);
                $checkForImage->value = $file;
                $checkForImage->save();
            }else{
                $file = $this->UploadImage($request->brand_logo, Files::FOLDER_ADMIN);
                $newImage = Setting::create([
                    'key' => Settings::BRAND_LOGO,
                    'value' => $file,
                    'created_by' => User::STATIC_ADMIN_DATABASE_ID,
                ]);
            } 
        }
    }

    public function uploadBrandIcon(Request $request)
    {
        // $faviconSetting = Setting::firstOrCreate([
        //     'key' => Settings::BRAND_FAVICON,
        //     'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        // ]);

        // if ($request->input('brand_favicon', false)) {
        //     if (
        //         !$faviconSetting->brandIcon
        //         || $request->input('brand_favicon') !== $faviconSetting->brandIcon->file_name
        //     ) {
        //         if ($faviconSetting->brandIcon) {
        //             $faviconSetting->brandIcon->delete();
        //         }
        //         $faviconSetting->addMedia(storage_path('tmp/uploads/' . basename($request->input('brand_favicon'))))
        //             ->toMediaCollection('brand-favicon');
        //     }
        // } elseif ($faviconSetting->brandIcon) {
        //     $faviconSetting->brandIcon->delete();
        // }

        if (!empty($request->brand_favicon)) {
            $checkForImage = Setting::where('key',Settings::BRAND_FAVICON)->first();
            if(!empty($checkForImage)){
                $file = $this->UploadImage($request->brand_favicon, Files::FOLDER_ADMIN,$checkForImage->value);
                $checkForImage->value = $file;
                $checkForImage->save();
            }else{
                $file = $this->UploadImage($request->brand_favicon, Files::FOLDER_ADMIN);
                $newImage = Setting::create([
                    'key' => Settings::BRAND_FAVICON,
                    'value' => $file,
                    'created_by' => User::STATIC_ADMIN_DATABASE_ID,
                ]);
            } 
            
        }
    }

    public function uploadAuthLogo(Request $request)
    {
        // $authSetting = Setting::firstOrCreate([
        //     'key' => Settings::AUTH_LOGO,
        //     'created_by' => User::STATIC_ADMIN_DATABASE_ID,
        // ]);
        // if ($request->input('auth_logo', false)) {
        //     if (!$authSetting->authLogo || $request->input('auth_logo') !== $authSetting->authLogo->file_name) {
        //         if ($authSetting->authLogo) {
        //             $authSetting->authLogo->delete();
        //         }
        //         $authSetting->addMedia(storage_path('tmp/uploads/' . basename($request->input('auth_logo'))))
        //             ->toMediaCollection('auth-logo');
        //     }
        // } elseif ($authSetting->authLogo) {
        //     $authSetting->authLogo->delete();
        // }

        if (!empty($request->auth_logo)) {
            $checkForImage = Setting::where('key',Settings::AUTH_LOGO)->first();
            if(!empty($checkForImage)){
                $file = $this->UploadImage($request->auth_logo, Files::FOLDER_ADMIN,$checkForImage->value);
                $checkForImage->value = $file;
                $checkForImage->save();
            }else{
                $file = $this->UploadImage($request->auth_logo, Files::FOLDER_ADMIN);
                $newImage = Setting::create([
                    'key' => Settings::AUTH_LOGO,
                    'value' => $file,
                    'created_by' => User::STATIC_ADMIN_DATABASE_ID,
                ]);
            } 
        }
    }

    public function update(Request $request)
    {

        foreach ($request->setting as $key => $value) {
            Setting::saveByKey($key, $value);
        }

        if (isset($request->setting['google_client_id'])) {
            $login_by_google = isset($request->setting['login_by_google']) ?
                (bool)$request->setting['login_by_google'] : 0;
            Setting::saveByKey('login_by_google', $login_by_google);
        }
        if (isset($request->setting['pp_client'])) {
            $enable_pp_payment = isset($request->setting['enable_pp_payment']) ?
                (bool)$request->setting['enable_pp_payment'] : 0;
            Setting::saveByKey('enable_pp_payment', $enable_pp_payment);
        }

        if (isset($request->setting['stripe_key'])) {
            $enable_stripe_payment = isset($request->setting['enable_stripe_payment']) ?
                (bool)$request->setting['enable_stripe_payment'] : 0;
            Setting::saveByKey('enable_stripe_payment', $enable_stripe_payment);
        }
        Session::flash('success', trans('translation.settings_updated_successfully.'));
        return back();
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            foreach ($request->input('setting', []) as $key => $value) {
                Setting::saveByKey($key, $value);
            }

            $variables = '$primary:     ' . getSettingByKey(Settings::PRIMARY_COLOR) . ';' . PHP_EOL;
            $variables .= '$secondary:     ' . getSettingByKey(Settings::SECONDARY_COLOR) . ';' . PHP_EOL;
            $variables .= '$success:     ' . getSettingByKey(Settings::SUCCESS_COLOR) . ';' . PHP_EOL;
            $variables .= '$info:     ' . getSettingByKey(Settings::INFO_COLOR) . ';' . PHP_EOL;
            $variables .= '$warning:     ' . getSettingByKey(Settings::WARNING_COLOR) . ';' . PHP_EOL;
            $variables .= '$danger:     ' . getSettingByKey(Settings::DANGER_COLOR) . ';' . PHP_EOL;
            $variables .= '$dark:     ' . getSettingByKey(Settings::DARK_COLOR) . ';' . PHP_EOL;

            file_put_contents(getThemeSrcPath() . '_user-variables.scss', $variables);

            $res = Http::nodejs()
                ->post(
                    '/api/build-theme',
                    [
                        'src' => getThemeSrcPath(),
                        'dest' => getThemeBuildPath(),
                        'theme' => \Qirolab\Theme\Theme::active()
                    ]
                );

            if ($res->successful()) {
                \Log::debug($res->json());
                return back()->with('success', trans('global.settings_update_successfully'));
            }

            return back()->with('error', $res->json()['message']);
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function adminWalletKey(Request $request)
    {
        if (isset($request->wallet_id)) {
            $getAdminWallet = AdminWalletKey::where('id',$request->wallet_id)->first();
            
            if (!empty($getAdminWallet)) {
                $getAdminWallet->address = $request->address;
                $getAdminWallet->pv = $request->private_key;
                $getAdminWallet->save();
                Session::flash('success','Admin Wallet Updated Successfully.');
                return back();
            }else{
                Session::flash('error','No Admin Wallet Found.');
                return back();
            }
        }
        Session::flash('error','Error while Updating. Please try again later.');
        return back();
    }

}
