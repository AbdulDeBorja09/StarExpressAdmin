<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Contracts\Debug\ExceptionHandler;
use App\Exceptions\CustomHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('conversations-list', \App\Http\Livewire\ConversationsList::class);
        Livewire::component('conversations-list', \App\Http\Livewire\ChatWindow::class);
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
        // $this->app->singleton(ExceptionHandler::class, CustomHandler::class);
    }
}
