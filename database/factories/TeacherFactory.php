<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return  [
            'user_id' => User::factory()->create(['role'=> 2])->id,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'dob' => $this->faker->dateTimeBetween('-30years','-20years'),
            'job_type' => $this->faker->numberBetween(1, 2),
            'country_id' => Country::all()->random()->id,
            'address' => $this->faker->address(),
            'education' => $this->faker->sentence(4),
            'salary_rate' => 10000,
            'strong_points' => $this->faker->paragraph(4),
            'responsibility' => $this->faker->paragraph(10),
            'skype_link'=> 'https://meet.jit.si/c-school',
            'zoom_link' => 'https://meet.jit.si/c-school',
        ];
    }
}
