<?php

namespace App\Http\Requests;

use App\Enums\TransactionStatus;
use App\Models\Category;
use App\Models\Customer;
use App\Models\SubCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', Rule::exists(Category::class, 'id')],
            'sub_category_id' => ['sometimes', 'nullable', Rule::exists(SubCategory::class, 'id')],
            'customer_id' => ['required', Rule::exists(Customer::class, 'id')],
            'amount' => ['required', 'numeric', 'min:0'],
            'due_date' => ['required', 'date'],
            'vat' => ['required', 'between:0,100'],
            'is_vat_inclusive' => ['required', 'boolean'],
            // 'status' => ['required', Rule::enum(TransactionStatus::class)],
        ];
    }
}
