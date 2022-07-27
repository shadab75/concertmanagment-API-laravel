<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'full_name'=>'fake artist',
            'category_id'=>Category::factory()->create(),
            'avatar'=>'not avatar',
            'background'=>'no background'
        ];
    }
}
