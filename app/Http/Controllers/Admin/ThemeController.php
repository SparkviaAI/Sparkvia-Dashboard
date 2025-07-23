<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\Theme;
use Illuminate\Support\Facades\Session;



class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        return view('admin.themes.index', compact('themes'));
    }

    
    public function activate(Theme $theme)
    {
        Setting::saveByKey('theme_id', $theme->id);
        return redirect(route('themes.index'));
    }


    public function themes_activate_new(Request $request){
        // dd($request->all());
        $getTheme = Theme::where('id',$request->themeId)->first();
        $getTheme->theme = $request->selectedTheme;
        $getTheme->save();
        return response()->json(['status' => 'success', 'message' => 'Theme Updated Successfully.'], 200);
    }
}
