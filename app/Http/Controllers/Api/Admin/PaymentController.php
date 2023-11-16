<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return JsonResource::collection(
            Payment::latest('id')->paginate()
        );
    }

    public function store(PaymentRequest $request): JsonResource
    {
        $payment = Payment::create($request->validated());

        return JsonResource::make($payment);
    }

    public function show(Payment $payment): JsonResource
    {
        return JsonResource::make($payment);
    }

    public function update(PaymentRequest $request, Payment $payment): JsonResource
    {
        $payment->update($request->validated());

        return JsonResource::make($payment);
    }

    public function destroy(Payment $payment): Response
    {
        $payment->delete();

        return response()->noContent();
    }
}
