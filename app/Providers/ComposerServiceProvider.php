<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('product.layouts.main', function($view) {
            $roles = config('products.roles');
            $user = auth()->user();
            foreach ($roles as $role_params) {
                if ($user->role == $role_params['code']) {
                    $user->role = $role_params['title'];
                }
            }
            $view->with([
                'user' => $user,
            ]);
        }); 
    }
}
