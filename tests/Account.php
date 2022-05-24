<?php

namespace Dinhdjj\Midmodel\Tests;

use Dinhdjj\Midmodel\Traits\HasMidmodel;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasMidmodel;

    protected $table = 'accounts';
}
