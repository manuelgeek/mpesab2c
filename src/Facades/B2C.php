<?php
/**
 * Created by PhpStorm.
 * User: manuelgeek
 * Date: 4/29/19
 * Time: 6:55 PM
 */

namespace Manuelgeek\MpesaB2C\Facades;


use Illuminate\Support\Facades\Facade;

class B2C extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mpesa_b2c';
    }
}
