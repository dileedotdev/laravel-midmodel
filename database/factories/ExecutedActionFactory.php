<?php

namespace Dinhdjj\Midmodel\Database\Factories;

use Dinhdjj\Midmodel\Enums\ActionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExecutedActionFactory extends Factory
{
    public function modelName()
    {
        return config('midmodel.executed_action.model');
    }

    public function definition()
    {
        return [
            'safe' => false,
            'required_infos' => [
                'username' => 'haha',
                'password' => 'huhu',
            ],
            'result_infos' => [
                'username' => 'haha',
                'password' => 'huhu',
            ],
            'status' => ActionStatus::SUCCESS,
        ];
    }
}
