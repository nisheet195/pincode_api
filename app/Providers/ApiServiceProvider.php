<?php
/**
 * Created by PhpStorm.
 * User: nisheetkumar
 * Date: 29/06/18
 * Time: 5:05 PM
 */

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Model\Pincode;

class ApiServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }
    public function register()
    {
        //$model = new Pincode;
        //$this->app->bind('App\Model\Pincode',$model->populateDatabase());
    }
}