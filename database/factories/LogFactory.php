<?php

namespace tyasa81\EzLoggable\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use tyasa81\EzLoggable\Models\Log;

class LogFactory extends Factory
{
    protected $model = Log::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'loggable_type' => $this->faker->word,
            'loggable_id' => $this->faker->numberBetween(1, 100),
            'acted_by_type' => $this->faker->word,
            'acted_by_id' => $this->faker->numberBetween(1, 100),
            'action' => $this->faker->word,
            'column' => $this->faker->word,
            'before' => $this->faker->word,
            'after' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}

