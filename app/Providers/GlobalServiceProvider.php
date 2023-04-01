<?php

namespace App\Providers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use View;

class GlobalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


}
