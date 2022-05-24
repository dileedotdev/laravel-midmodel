<?php

namespace Dinhdjj\Midmodel\Tests;

use Illuminate\Database\Eloquent\SoftDeletes;

class SoftDeletesAccount extends Account
{
    use SoftDeletes;
}
