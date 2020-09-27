<?php

namespace Bungker\Ui;

use Illuminate\Support\ServiceProvider;

class UiServiceProvider extends ServiceProvider {

    public function boot(){
        include __DIR__.'/routes.php';
    }

    public function register(){
        
    }
}