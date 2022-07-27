<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConcertFactory extends Factory
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
            'artist_id'=>Artist::factory()->create(),
            'title'=>'this is fake concert',
            'description'=>'you will enjoy this concert',
            'start_at'=>now()->format('Y-m-d'),
            'ends_at'=>now()->addWeek()->format('Y-m-d'),
            'is_published'=>true
        ];
    }
}
