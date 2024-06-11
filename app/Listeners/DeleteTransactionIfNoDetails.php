<?php

namespace App\Listeners;

use App\Events\TransactionDetailDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteTransactionIfNoDetails
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\TransactionDetailDeleted  $event
     * @return void
     */
    public function handle(TransactionDetailDeleted $event)
    {
        $transactionDetail = $event->transactionDetail;
        $transaction = $transactionDetail->transaction;

        if ($transaction->notes()->count() === 0) {
            $transaction->delete();
        }
    }
}
