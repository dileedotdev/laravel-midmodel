<?php

namespace Dinhdjj\Midmodel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActionFactory extends Factory
{
    public function modelName()
    {
        return config('midmodel.action.model');
    }

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->sentence(),
            'job' => 'Dinhdjj\Midmodel\Resolvers\ExampleResolver',
            'safe' => false,
            'required_info_names' => [
                'username',
                'password',
            ],
            'result_info_names' => [
                'new password',
            ],
        ];
    }
}
