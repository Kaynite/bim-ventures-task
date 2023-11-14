<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $transactions = Transaction::query()
            ->with('user', 'category', 'subCategory')
            ->latest('id')
            ->paginate();

        return JsonResource::collection($transactions);
    }

    public function store(TransactionRequest $request): JsonResource
    {
        return JsonResource::make(
            Transaction::create($request->validated())
        );
    }

    public function show(Transaction $transaction): JsonResource
    {
        return JsonResource::make(
            $transaction->load('user', 'category', 'subCategory')
        );
    }

    public function update(TransactionRequest $request, Transaction $transaction): JsonResource
    {
        $transaction->update($request->validated());

        return JsonResource::make($transaction);
    }

    public function destroy(Transaction $transaction): Response
    {
        $transaction->delete();

        return response()->noContent();
    }
}
