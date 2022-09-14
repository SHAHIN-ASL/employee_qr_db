<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Name'=>$this->faker->name,
            'Date'=>"t",
            'On_duty'=>"t",
            'Off_duty'=>"t",
            'Clock_In'=>"t",
            'Clock_Out'=>"t",
            'Work_Time'=>"t",
            'ATT_Time'=>"t",
            'Time'=>"t",
            

        ];
    }
}
