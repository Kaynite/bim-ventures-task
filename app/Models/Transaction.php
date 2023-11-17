<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'customer_id',
        'amount',
        'due_date',
        'vat',
        'is_vat_inclusive',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_vat_inclusive' => 'boolean',
        'status' => TransactionStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function updateStatus(): void
    {
        $status = ($this->payments()->sum('amount') >= $this->amount)
            ? TransactionStatus::Paid
            : (now()->gt($this->due_date) ? TransactionStatus::Overdue : TransactionStatus::Outstanding);

        $this->update(['status' => $status]);
    }
}
