<?php

/**
 * Class AppServiceProvider
 * @package App\Modules\Orders\Providers
 * @author Electric <huydien.it@gmail.com>
 */

namespace App\Modules\Orders\Providers;

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
        'App\Modules\Orders\Models\Repositories\Contracts\ShopsInterface' => 'App\Modules\Orders\Models\Repositories\Eloquent\ShopsRepository',
        'App\Modules\Orders\Models\Repositories\Contracts\ShopBankInterface' => 'App\Modules\Orders\Models\Repositories\Eloquent\ShopBankRepository',
        'App\Modules\Orders\Models\Repositories\Contracts\ShopAddressInterface' => 'App\Modules\Orders\Models\Repositories\Eloquent\ShopAddressRepository',
        'App\Modules\Orders\Models\Repositories\Contracts\OrdersInterface' => 'App\Modules\Orders\Models\Repositories\Eloquent\OrdersRepository',
        'App\Modules\Orders\Models\Repositories\Contracts\OrderProductInterface' => 'App\Modules\Orders\Models\Repositories\Eloquent\OrderProductRepository',
        'App\Modules\Orders\Models\Repositories\Contracts\OrderReceiverInterface' => 'App\Modules\Orders\Models\Repositories\Eloquent\OrderReceiverRepository',
    ];

    public function register()
    {
        // Register services
        foreach ($this->services as $interface => $repository) {
            $this->app->singleton($interface, $repository);
        }
    }

}
