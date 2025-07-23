<?php

use App\Models\Locale;
use App\Models\Permission;
use App\Models\Plan;
use App\Models\Role;
use App\Models\Setting;
// use App\Models\Tenant;
use Illuminate\Contracts\Filesystem\Filesystem;
use Qirolab\Theme\Theme as UserTheme;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Prompt;
use App\Models\Category;


if (!function_exists('getPrompts')) {
    function getPrompts()
    {
        return Prompt::with('category')->orderBy('title','ASC')->get();
    }
}

if (!function_exists('getCategories')) {
    function getCategories()
    {
        return Category::with('categoryPrompts')->get();
        // return Category::with('categoryPrompts')->orderBy('title','ASC')->get();
    }
}

if (!function_exists('getLocales')) {
    function getLocales()
    {
        return Locale::where('status', 1)->get();
    }
}

if (!function_exists('getDefaultLocale')) {
    function getDefaultLocale()
    {
        $setting = Setting::where('key', Setting::LOCALE)->firstOrFail();

        return Locale::findOrFail($setting->value)->slug;
    }
}

if (!function_exists('getSettingByKey')) {
    function getSettingByKey($key)
    {
        return Setting::where('key', $key)
            ->where('created_by', User::STATIC_ADMIN_DATABASE_ID)
            ->first()->value ?? '';
    }
}

if (!function_exists('getLocale')) {
    function getLocale()
    {
        return Locale::where('slug', app()->getLocale())->first();
    }
}

if (!function_exists('reassignPermissions')) {
    function reassignPermissions(): void
    {
        // Give all permissions to Admin
        $adminPermissions = Permission::all();
        Role::where('title', User::ADMIN)->first()->permissions()->sync($adminPermissions->pluck('id'));

        // User permissions
        $userPermissions = $adminPermissions->filter(function ($permission) {
            $first5 = substr($permission->title, 0, 5);
            return $first5 != 'user_' && $first5 != 'role_' &&
                !str_starts_with($permission->title, 'permission_');
        });

        Role::where('title', User::USER)->first()->permissions()->sync($userPermissions);
        Role::where('title', User::TESTER)->first()->permissions()->sync($userPermissions);
    }
}

if (!function_exists('dateTimeFormat')) {
    function dateTimeFormat(): string
    {
        return config('panel.date_format') . ' '
            . config('panel.time_format');
    }
}

if (!function_exists('host')) {
    function host(): string
    {
        $url = explode('.', request()->getHost());
        return count($url) >= 3 ? str_replace($url[0] . '.', '', request()->getHost()) : request()->getHost();
    }
}

if (!function_exists('subdomain')) {
    function subdomain(): string
    {
        return request()->input('subdomain', config('app.subdomain'));
    }
}

// if (!function_exists('subdomainSegment')) {
//     function subdomainSegment(): string
//     {
//         $tenant = Tenant::whereHas('customDomains', function ($query) {
//             return $query->where('name', request()->getHost());
//         })->first()->name ?? null;

//         return $tenant ?? str_replace('.' . config('app.base_domain'), '', request()->getHost());
//     }
// }

if (!function_exists('setAppUrl')) {
    function setAppUrl(): void
    {
        $url = parse_url(config('app.url'));
        config(['app.url' => $url['scheme'] . '://' . subdomain() . '.' . $url['host']]);
    }
}

if (!function_exists('random_string')) {
    function random_string($type = 'alnum', $len = 8)
    {
        switch ($type) {
            case 'basic':
                return mt_rand();
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
                switch ($type) {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                }
                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'unique': // todo: remove in 3.1+
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'encrypt': // todo: remove in 3.1+
            case 'sha1':
                return sha1(uniqid(mt_rand(), true));
        }
    }
}

if (!function_exists('base64Image')) {
    function base64Image($path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return 'data:application/' . $type . ';base64,' . base64_encode($data);
    }
}

if (!function_exists('generateTeamName')) {
    function generateTeamName(User $user): string
    {
        return $user->name . ' team';
    }
}

if (!function_exists('ownerOfCurrentTeam')) {
    function ownerOfCurrentTeam(): bool
    {
        return auth()->user()->currentTeam?->owner?->is(auth()->user()) ?? false;
    }
}

if (!function_exists('countryCodeToLocale')) {
    function countryCodeToLocale($countryCode, $languageCode = ''): bool|string|null
    {
        // list-of-all-locales-and-their-short-codes
        $locales = \ResourceBundle::getLocales('');

        foreach ($locales as $locale) {
            $localeRegion = locale_get_region($locale);
            $localeLanguage = locale_get_primary_language($locale);
            $localeArray = array('language' => $localeLanguage,
                'region' => $localeRegion
            );

            if (
                strtoupper($countryCode) == $localeRegion &&
                $languageCode == ''
            ) {
                return locale_compose($localeArray);
            } elseif (
                strtoupper($countryCode) == $localeRegion &&
                strtolower($languageCode) == $localeLanguage
            ) {
                return locale_compose($localeArray);
            }
        }

        return null;
    }
}

// if (!function_exists('hasLifetimePayment')) {
//     function hasLifetimePayment(): bool
//     {
//         return Plan::paid()
//             ->where('tenant_id', config('app.tenant_id'))
//             ->oneTimePlans()->exists();
//     }
// }

if (!function_exists('getThemeCSS')) {
    function getThemeCSS(): string
    {
        $theme = UserTheme::active();
        $subdomain = subdomain();
        $file = public_path("storage/css/{$theme}/{$subdomain}/theme.min.css");

        if ($file && file_exists($file)) {
            return asset("storage/css/{$theme}/{$subdomain}/theme.min.css");
        }

        return asset("css/{$theme}/theme.min.css");
    }
}

if (!function_exists('route_relative')) {
    function route_relative($name, $parameters = [], $absolute = false): string
    {
        return route($name, $parameters, $absolute);
    }
}

if (!function_exists('originalHost')) {
    function originalHost(): string
    {
        $req = request();
        $port = $req->getPort();
        $base = $req->getScheme() . '://' . $req->header('original-host', $req->header('host'));
        return (!in_array($port, [80, 443, 8000])) ? $base . ':' . $port : $base;
    }
}

if (!function_exists('route_original')) {
    function route_original($name, $parameters = [], $absolute = false): string
    {
        return originalHost() . route($name, $parameters, $absolute);
    }
}

if (!function_exists('callAPI')) {
    function callAPI($post_url, $post_header, $post_fields, $post_type = 'GET')
    {
        // setup cURL request
        $ch = curl_init();

        // do not return header information
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // submit data in header if specified
        if (is_array($post_header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
        }

        // do not return status info
        curl_setopt($ch, CURLOPT_VERBOSE, 0);

        // return data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // cancel ssl checks
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // if using GET, POST or PUT
        if ($post_type == 'POST') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_fields));
        } elseif ($post_type == 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
        } elseif ($post_type == 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            if ($post_fields) {
                $post_url .= '?' . http_build_query($post_fields);
            }
        } else {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            if ($post_fields) {
                $post_url .= '?' . http_build_query($post_fields);
            }
        }
        // specified endpoint
        curl_setopt($ch, CURLOPT_URL, $post_url);
        // execute cURL request
        $response = curl_exec($ch);

        // return errors if any
        if ($response === false) {
            $output = curl_error($ch);
        } else {
            $output = $response;
        }
        // close cURL handle
        curl_close($ch);

        // output
        return json_decode($output);
    }
}

if (!function_exists('getThemeSrcPath')) {
    function getThemeSrcPath(): string
    {
        $theme = UserTheme::active();
        $subdomain = subdomain();
        $path = storage_path("css/{$theme}/{$subdomain}/");
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }
}

if (!function_exists('getThemeBuildPath')) {
    function getThemeBuildPath(): string
    {
        $theme = UserTheme::active();
        $subdomain = subdomain();
        $path = storage_path("app/public/css/{$theme}/{$subdomain}/");
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }
}

if (!function_exists('getFile')) {
    function getFile(): bool|string
    {
        $user = auth()->user()->id;
        $file = request('file');
        $extension = $file->extension() ?? $file->clientExtension();
        $filename = $user . '_' . time() . '.' . $extension;

        return uploadsStorage()->putFileAs('uploads', $file, "{$filename}", 'private');
    }
}

if (!function_exists('uploadsStorage')) {
    function uploadsStorage(): Filesystem
    {
        return Storage::disk(config('filesystems.default'));
    }
}

if (!function_exists('')) {
    function normalizeSentence(string $sentence): string
    {
        return ucfirst(
            strtolower(
                str_replace(
                    ['{', '}', '[', ']'],
                    [''],
                    trim($sentence)
                )
            )
        );
    }
}

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin(): bool
    {
        return auth()->check() && auth()->user()->email == config('app.super_admin_email');
    }
}


// if (!function_exists('getUserWalletDetails')) {
    function getUserWalletDetails()
    {
        if(!empty(auth()->user())){
            $getWallet = \App\Models\Wallet::where('user_id', auth()->user()->id)->first();
            return $getWallet;
        }
    }
// }
