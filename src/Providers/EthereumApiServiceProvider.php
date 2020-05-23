<?php

namespace Aoeng\EthereumApi\Providers;


use Aoeng\EthereumApi\EthereumApi;
use Illuminate\Support\ServiceProvider;

class EthereumApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/ethereum.php' => config_path('ethereum.php'),
        ],'ethereum');

    }

    public function register()
    {
        $this->app->singleton('ethereum.api', function () {
            return new EthereumApi();
        });
    }

}
