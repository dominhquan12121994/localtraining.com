<?php

/**
 * Class AppServiceProvider
 * @package App\Modules\Operators\Providers
 * @author Electric <huydien.it@gmail.com>
 */

namespace App\Modules\Operators\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    protected $services = [
        'App\Modules\Operators\Models\Repositories\Contracts\ProvincesInterface' => 'App\Modules\Operators\Models\Repositories\Eloquent\ProvincesRepository',
        'App\Modules\Operators\Models\Repositories\Contracts\DistrictsInterface' => 'App\Modules\Operators\Models\Repositories\Eloquent\DistrictsRepository',
        'App\Modules\Operators\Models\Repositories\Contracts\WardsInterface' => 'App\Modules\Operators\Models\Repositories\Eloquent\WardsRepository',
    ];

    public function register()
    {
        // Register services
        foreach ($this->services as $interface => $repository) {
            $this->app->singleton($interface, $repository);
        }
    }

}
