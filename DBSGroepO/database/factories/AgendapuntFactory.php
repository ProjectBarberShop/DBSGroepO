<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Generator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agendapunt>
 */
class AgendapuntFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('next Monday', 'next Monday +7 days');
        $end = $this->faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s').' +2 days');

        return [
            'title' => $this->faker->realTextBetween(5, 20),
            'description' => $this->faker->text(600),
            'start' => $start,
            'end' => $end,
            'location' => $this->faker->address(),
        ];
    }
}
