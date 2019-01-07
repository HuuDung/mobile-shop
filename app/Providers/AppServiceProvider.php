<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Cpu;
use App\Models\Ram;
use App\Models\Storage;
use App\Models\System;
use App\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer('*', function ($view) {
            $cart = 0;
            if (session()->has('product')) {
                $data = session()->get('product');
                foreach ($data as $key => $value) {
                    $cart += $value['quantity'];
                }
            }
            $view->with([
                'cart' => $cart,
            ]);
        });
        View::composer(['home','admin.product-administration.*'], function ($view) {
            $rams = Ram::all();
            $cpus = Cpu::all();
            $systems = System::all();
            $storage = Storage::all();
            $categories = Category::all();
            $view->with([
                'cpus' => $cpus,
                'rams' => $rams,
                'systems' => $systems,
                'storages' => $storage,
                'categories' => $categories,
            ]);
        });
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
