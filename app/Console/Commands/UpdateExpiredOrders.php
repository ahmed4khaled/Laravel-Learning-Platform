<?php

namespace App\Console\Commands;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateExpiredOrders extends Command
{
    protected $signature = 'app:update-expired-sales';

    protected $description = 'Deactivate expired lecture sales based on their expiration window.';

    public function handle(): int
    {
        $now = Carbon::now();

        $sales = Sale::where('state', '!=', 0)->get();

        foreach ($sales as $sale) {
            if (empty($sale->date_exp)) {
                continue;
            }

            $expiryDate = Carbon::parse($sale->updated_at)->addDays((int) $sale->date_exp);

            if ($now->greaterThanOrEqualTo($expiryDate)) {
                $sale->state = 0;
                $sale->save();
            }
        }

        return self::SUCCESS;
    }
}
