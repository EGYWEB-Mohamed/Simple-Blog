<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'image'      => 'uploads/placeholder.png',
            'title'      => $this->faker->sentence(),
            'body'       => $this->faker->randomHtml(),
            'active'     => $this->faker->boolean(),
            'user_id'     => User::factory()->create()->assignRole('client'),
            'category_id' => Category::factory(),
            'created_at' => $this->faker->dateTime(Carbon::today()),
            'updated_at' => $this->faker->dateTime(Carbon::today()),
        ];
    }
}
