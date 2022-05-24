<?php

namespace Dinhdjj\Midmodel\Database\Factories;

use Dinhdjj\Midmodel\Enums\MidmodelStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class MidmodelFactory extends Factory
{
    public function modelName()
    {
        return config('midmodel.midmodel.model');
    }

    public function definition()
    {
        return [
            'status' => MidmodelStatus::SUCCESS,
        ];
    }
}
