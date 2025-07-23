<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Locale;
use App\Models\User;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    // public function register(): void
    // {
    //     //
    // }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerViewComposers();
    }

    protected function registerViewComposers()
    {
        if (app()->runningInConsole()) {
            return;
        }

        $locales = Locale::where('status', 1)->get()->map(function ($locale) {
            return [$locale->slug => $locale->title];
        })->collapse()->all();

        View::composer([
            'layouts.admin.header',
            // 'partials.landingFooter',
            // 'layouts.auth',
            // 'layouts.landing',
            // 'layouts.dashboard',
            // 'frontend.landing.index'
        ], function ($view) use ($locales) {
            $view->with('locales', $locales);
            // if (auth()->check()) {
            //     $view->with('teams', auth()->user()->teams()->get());
            //     $view->with('subscription', auth()->user()->userSubscription);
            // }
        });
    }
}

