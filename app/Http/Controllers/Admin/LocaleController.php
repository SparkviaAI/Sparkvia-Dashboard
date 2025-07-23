<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\MassDestroyLocaleRequest;
use App\Http\Requests\StoreLocaleRequest;
use App\Http\Requests\UpdateLocaleRequest;
use App\Models\Locale;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;


class LocaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locales = Locale::all();
        $setting = Setting::all();
        return view('admin.locales.index', compact('locales', 'setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocaleRequest $request)
    {
        Locale::create($request->validated() + ['created_by' => auth()->user()->id]);
        Session::flash('success', trans('translation.locale_added_successfully'));
        return redirect(route('locales.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Locale $locale)
    {
        return redirect(route('locales.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locale $locale)
    {
        return view('admin.locales.edit', compact('locale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocaleRequest $request, Locale $locale)
    {
        $locale->update($request->all());
        Session::flash('success', trans('translation.locale_updated_successfully'));
        return redirect(route('locales.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locale $locale)
    {
        $locale->delete();
        Session::flash('success', trans('translation.locale_deleted_successfully'));
        return back();
    }

    public function massDestroy(MassDestroyLocaleRequest $request)
    {
        $locales = Locale::find(request('ids'));
        foreach ($locales as $locale) {
            $locale->delete();
        }
        Session::flash('success', trans('translation.multiple_deletion_successful'));
        return response(null, Response::HTTP_NO_CONTENT);
    }

    // public function switchLang(): RedirectResponse
    // {
    //     return back()->with('message', 'Locale switched successfully.');
    // }

    // public function switchLang(Request $request): RedirectResponse
    // {
    //     // dd($request);
    //     $this->setLocale($request);

    //     return back()->with('message', 'Locale switched successfully.');
    // }

    // private function setLocale(Request $request)
    // {
    //     if ($request->has('change_language')) {
    //         session()->put('language', $request->input('change_language'));
    //         $language = $request->input('change_language');
    //     } elseif (session('language')) {
    //         $language = session('language');
    //     }

    //     $language = $language ?? $this->getDefaultLocale();
    //     app()->setLocale($language);

    //     URL::defaults(['locale' => $language]);
    // }

    // private function getDefaultLocale()
    // {
    //     // Your logic to get the default locale
    //     return 'en'; // Example default locale
    // }

    public function switchLang(Request $request): RedirectResponse
    {
        $this->setLocale($request);
        Session::flash('success', trans('translation.locale_switched_successfully'));
        return back();
    }

    // public function setLocale(Request $request)
    // {
    //     if ($request->has('change_language')) {
    //         session()->put('language', $request->input('change_language'));
    //         $language = $request->input('change_language');
    //     } elseif (session('language')) {
    //         $language = session('language');
    //     }

    //     $language = $language ?? $this->getDefaultLocale();
        
    //     // Debugging: Log the language being set
    //     // \Log::info('Setting locale to: ' . $language);
        
    //     app()->setLocale($language);
    //     dd(app()->setLocale($language));
    //     URL::defaults(['locale' => $language]);
    // }

    
    public function setLocale(Request $request)
    {
        if ($request->has('change_language')) {
            $language = $request->input('change_language');
            session()->put('language', $language);
            \Log::info('Language set from request: ' . $language);
        } elseif (session()->has('language')) {
            $language = session('language');
            \Log::info('Language set from session: ' . $language);
        } else {
            $language = $this->getDefaultLocale();
            \Log::info('Using default language: ' . $language);
        }

        app()->setLocale($language);
        \Log::info('Locale set to: ' . app()->getLocale());

        URL::defaults(['locale' => $language]);
    }


    public function getDefaultLocale()
    {
        return 'en';
    }



}
