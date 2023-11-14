<?php

namespace Database\Factories;

use App\Enums\TransactionStatus;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'sub_category_id' => SubCategory::factory(),
            'user_id' => User::factory(),
            'amount' => fake()->numberBetween(100, 1000),
            'due_date' => fake()->dateTimeThisMonth(),
            'vat' => 14,
            'is_vat_inclusive' => fake()->boolean(),
            'status' => Arr::random(TransactionStatus::cases()),
        ];
    }
}
