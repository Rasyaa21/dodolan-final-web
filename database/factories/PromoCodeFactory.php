<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PromoCode;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PromoCode>
 */
class PromoCodeFactory extends Factory
{
    protected $model = PromoCode::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->bothify('PROMO###')),
            'discount_type' => $this->faker->randomElement(['percentage', 'fixed']),
            'discount_amount' => $this->faker->numberBetween(10, 50),
            'valid_until' => $this->faker->dateTimeBetween('now', '+1 month'),
            'amount' => $this->faker->numberBetween(1, 100),
            'store_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
