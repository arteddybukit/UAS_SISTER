<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'transactions_total' => 'required',
        ]);

        $request['user_id'] = auth()->user()->id;

        $transaction = Transaction::create($request->all());

        return response()->json($transaction());
    }
}
