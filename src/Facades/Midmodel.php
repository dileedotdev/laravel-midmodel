<?php

namespace Dinhdjj\Midmodel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dinhdjj\Midmodel\Midmodel
 */
class Midmodel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'midmodel';
    }
}
