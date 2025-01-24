<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-article', function (User $user, $data, $product) {
            $roles = config('products.roles');
            if ($user->role != $roles['admin']['code']){
                // если артикул остался без изменений
                if ($data['article'] == $product->article) {
                    return Response::allow();
                } else {
                    return Response::deny();
                }
            }
            return Response::allow();
        });
    }
}
