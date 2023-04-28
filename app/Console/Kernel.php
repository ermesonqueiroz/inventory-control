<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\AmountUpdate;
use App\Models\Product;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $amounts_updates = AmountUpdate::where('done', FALSE)->get();

            foreach ($amounts_updates as $amount_update) {
                $code = $amount_update->code;
                $product = Product::where('code', $code)->first();
                $product->amount = $amount_update->amount;
                $product->save();
                $amount_update->done = TRUE;
                $amount_update->save();
            }
        })->daily();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
