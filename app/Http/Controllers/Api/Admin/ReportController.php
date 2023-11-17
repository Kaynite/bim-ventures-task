<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function transactions(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        $transactions = Transaction::query()
            ->select([
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(IF(status = "paid", amount, 0)) as paid'),
                DB::raw('SUM(IF(status = "outstanding", amount, 0)) as outstanding'),
                DB::raw('SUM(IF(status = "overdue", amount, 0)) as overdue'),
            ])
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->groupBy('year', 'month')
            ->get();

        return JsonResource::collection($transactions);
    }
}
