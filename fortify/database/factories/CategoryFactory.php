<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // make array of categories of school supplies and pick a random one
        $categories = ['pens', 'pencils', 'notebooks', 'folders'];
        $category = $categories[array_rand($categories)];

        return [
            //
            'name' => $category,
        ];
    }
}
