<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionController extends Controller
{
    public function __invoke()
    {
        $transactions = auth('customer')->user()->transactions()->latest('id')->paginate();

        return JsonResource::collection($transactions);
    }
}
