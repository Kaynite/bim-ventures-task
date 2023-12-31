<?php

use App\Models\Category;
use App\Models\Customer;
use App\Models\SubCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SubCategory::class)->nullable()->constrained()->cascadeOnDelete();
            $table->decimal('amount');
            $table->foreignIdFor(Customer::class)->constrained();
            $table->date('due_date');
            $table->decimal('vat', 5, 2);
            $table->boolean('is_vat_inclusive');
            $table->string('status', 50)->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
