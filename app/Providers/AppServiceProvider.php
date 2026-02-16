<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        // أو إذا كنت تستخدم مسار Dashboard
        // Livewire::component('dashboard.exam-creator', \App\Http\Livewire\Dashboard\ExamCreator::class);
    }
}