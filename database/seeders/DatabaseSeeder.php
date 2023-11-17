<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\SubCategory;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $bar = $this->command->getOutput()->createProgressBar(7);

        $bar->start();

        Admin::factory()->create();
        $bar->advance();

        $customers = Customer::factory(25)->create();
        $bar->advance();

        $categories = Category::factory(5)->create();
        $bar->advance();

        $subCategories = collect([]);
        foreach (range(1, 5) as $step) {
            $subCategories->push(
                SubCategory::factory()->create(['category_id' => $categories->random()])
            );
        }
        $bar->advance();

        $transactions = collect([]);

        foreach (range(1, 100) as $step) {
            $transactions->push(
                Transaction::factory()->create([
                    'category_id' => $categories->random(),
                    'sub_category_id' => fake()->boolean() ? $subCategories->random() : null,
                    'customer_id' => $customers->random(),
                ])
            );
        }
        $bar->advance();

        foreach (range(1, 200) as $step) {
            Payment::factory()->create([
                'transaction_id' => $transactions->random(),
            ]);
        }

        $transactions->each->updateStatus();

        $bar->advance();

        $bar->finish();

        $this->command->newLine();
    }
}
