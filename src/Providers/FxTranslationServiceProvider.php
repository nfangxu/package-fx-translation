<?php

namespace Fx\Translation\Providers;

use Illuminate\Support\ServiceProvider;
use Fx\Translation\Contacts\Translate;
use Fx\Translation\Services\GoogleTranslate;
use Fx\Translation\Services\BingTranslate;

class FxTranslationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('fx-translation.php'),
        ]);
    }

    public function register()
    {
        switch (config('fx-translation.providers.default')) {
            case 'google':
                $service = GoogleTranslate::class;
                break;
            case 'bing':
                $service = BingTranslate::class;
                break;
            default:
                $service = BingTranslate::class;
                break;
        }

        $this->app->bind(Translate::class, $service);
    }
}
