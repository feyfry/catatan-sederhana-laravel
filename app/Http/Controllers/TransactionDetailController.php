<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use App\Events\TransactionDetailDeleted;

class TransactionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactionDetails = TransactionDetail::with('transaction', 'note')->paginate(10);
        return view('transaction_details.index', compact('transactionDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'note_id' => 'required|exists:notes,id',
        ]);

        TransactionDetail::create($validatedData);

        return redirect()->route('transaction_details.index')->with('success', 'Transaction detail created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($transactionId, $noteId)
    {
        $transactionDetail = TransactionDetail::where('transaction_id', $transactionId)
            ->where('note_id', $noteId)
            ->firstOrFail();

        return view('transaction_details.show', compact('transactionDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($transactionId, $noteId)
    {
        $transactionDetail = TransactionDetail::where('transaction_id', $transactionId)
            ->where('note_id', $noteId)
            ->firstOrFail();

        $transactionDetail->delete();

        event(new TransactionDetailDeleted($transactionDetail));

        return redirect()->route('transactions.index')->with('success', 'Transaction detail removed successfully.');
    }
}
