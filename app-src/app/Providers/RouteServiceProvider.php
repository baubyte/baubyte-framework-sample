<?php

namespace App\Providers;

use Baubyte\App;
use Baubyte\Providers\ServiceProvider;
use Baubyte\Routing\Route;

class RouteServiceProvider implements ServiceProvider{
    public function registerServices(){
       Route::load(App::$root.DIRECTORY_SEPARATOR."routes");
    }
}
