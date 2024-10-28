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
        // Define realistic salary rates based on job type
        $jobType = $this->faker->randomElement([1, 2]); // 1 = Hourly, 2 = Monthly

        // Adjust salary_rate depending on job type
        $salaryRate = $jobType == 1
        ? $this->faker->numberBetween(20, 50) // Hourly rate in USD
        : $this->faker->numberBetween(2000, 5000); // Monthly salary in USD
        return [
            'user_id' => User::factory()->create(['role' => 2])->id,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'dob' => $this->faker->dateTimeBetween('-30years', '-20years'),
            'job_type' => $jobType,
            'country_id' => Country::all()->random()->id,
            'salary_rate' => $salaryRate,
            'address' => $this->faker->address(),
            'education' => $this->faker->sentence(4),
            'strong_points' => $this->faker->paragraph(4),
            'responsibility' => $this->faker->paragraph(10),
            'skype_link' => 'https://meet.jit.si/c-school',
            'zoom_link' => 'https://meet.jit.si/c-school',
        ];
    }
}
