<?php

namespace App\Providers;

use App\cat_types;
use App\Contact;
use App\Service;
use App\Tour;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        localization()->setLocale(app()->getLocale());
        $supportedLocales = localization()->getSupportedLocales();
        $supportedLocalekeys = localization()->getSupportedLocalesKeys();
        $locale = localization()->getCurrentLocale();
        $contact = Contact::find(1);
        $services = Service::orderBy('created_at', 'desc')->limit(6)->get();
        Schema::defaultStringLength(191);
        view()->share('supportedLocales', $supportedLocales);
        view()->share('Locale', $locale);
        view()->share('Langs', $supportedLocalekeys);
        view()->share('Contact', $contact);
        view()->share('ServicesF', $services);
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });

    }

}
