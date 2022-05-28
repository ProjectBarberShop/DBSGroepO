<?php

namespace Database\Factories;

use App\Models\image;
use App\Models\LearnToSingCat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LearnToSing>
 */
class LearnToSingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = LearnToSingCat::all();
        $randomcat = mt_rand(1, $categories->count());
        $date = $this->faker->dateTimeBetween('next Monday', 'next Monday +7 days');
        return [
            'category_id' => $randomcat,
            'title' => $this->faker->realTextBetween(10,20),
            'image_id' => 1,
            'description' => $this->faker->text(50),
            'date' => $date,
            'location' => $this->faker->address(),
            'mentor' => $this->faker->name(),
            'price' => mt_rand(0, 100),
        ];
    }
}
