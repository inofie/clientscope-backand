<?php

namespace App\Providers;

use App\Models\AppContent;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $record = AppContent::getContentByID(1);
            $termCondition = AppContent::getContentByID(2);
            $data = [
                'privacyPolicy'   => $record,
                'termsConditions' => $termCondition
            ];
            $view->with('appContent',$data);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
