<?php

namespace Database\Factories;

use App\Models\RepositoryFavorite;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepositoryFavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RepositoryFavorite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'repo_id'           => $this->faker->unique()->randomNumber(),
            'description'       => $this->faker->text(256),
            'owner_login'       => $this->faker->unique()->word(),
            'html_url'          => $this->faker->unique()->url,
            'stargazers_count'  => $this->faker->randomNumber,
            'name'              => $this->faker->word,
        ];
    }
}
