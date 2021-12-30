<?php

namespace Database\Factories;

use App\Models\Ads;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph(1),
            'advertiser' => $this->faker->name,
            'start_date' => $this->faker->date("Y-m-d"),
            'type' => $this->faker->randomElement(Ads::getAvailableTypes()),
            'category_id' => Category::all()->random()->id
        ];
    }
}
