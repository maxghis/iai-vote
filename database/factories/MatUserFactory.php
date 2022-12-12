<?php

namespace Database\Factories;

use App\Models\MatUser;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MatUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = MatUser::class;
    public function definition()
    {
        return [
            'matricule' => fake()->unique()->name(),
            'classe' => fake()->createRandomStringsUsingSequence(['l1b', 'l2b', 'gl3a', 'l1a', 'l2a', 'gl3b']),
        ];
    }
}
