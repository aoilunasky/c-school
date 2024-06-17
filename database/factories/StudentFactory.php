<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(['role'=> 3])->id,
            'gender' => $this->faker->randomElement(['male', 'female']), 
            'age' => $this->faker->numberBetween(19,30), 
            'lesson_type' => $this->faker->randomElement([1,2]), 
            'purpose' => $this->faker->paragraph(3),
            'ticket_amt' => 4
        ];
    }
}
