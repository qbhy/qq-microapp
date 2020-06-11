<?php

namespace Qbhy\QqMicroApp;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * Class LaravelServiceProvider
 *
 * @author  qbhy <96qbhy@gmail.com>
 *
 * @package Qbhy\BaiduAIP
 */
class LaravelServiceProvider extends BaseServiceProvider
{
    public function boot()
    {

    }

    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = dirname(__DIR__).'/config/qq-app.php';
        if ($this->app->runningInConsole()) {
            $this->publishes([$source => base_path('config/qq-app.php')], 'qq-app');
        }

        if ($this->app instanceof LumenApplication) {
            $this->app->configure('qq-app');
        }

        $this->mergeConfigFrom($source, 'qq-app');
    }

    public function register()
    {
        $this->setupConfig();

        $this->app->singleton(QqMicroApp::class, function ($app) {
            return $app->make(Factory::class)->make();
        });

        $this->app->singleton(Factory::class, function ($app) {
            return new Factory(config('qq-app'));
        });

        $this->app->alias(QqMicroApp::class, 'qq.app');
    }
}