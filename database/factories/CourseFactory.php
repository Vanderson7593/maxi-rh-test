<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => 'description',
            'value' => $this->faker->numberBetween(1000, 9000),
            'sub_start_date' => $this->faker->date(),
            'sub_end_date' => $this->faker->date(),
            'max_sub' => $this->faker->randomDigit()
        ];
    }
}
