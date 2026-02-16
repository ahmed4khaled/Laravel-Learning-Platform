<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sell;
use Carbon\Carbon;

class UpdateExpiredSales extends Command
{
    protected $signature = 'app:update-expired-sales';
    protected $description = 'تغيير حالة المبيعات اللي انتهت مدتها إلى صفر';

    public function handle()
    {
        $now = Carbon::now();

        // هات كل المبيعات اللي لسه حالتها مش صفر
        $sales = Sell::where('state', '!=', 0)->get();

        foreach ($sales as $sale) {
            // نحسب تاريخ الانتهاء: تاريخ الإنشاء + مدة الحصة (بالأيام)
            $expiryDate = Carbon::parse($sale->updated_at)->addDays($sale->date_exp);

            if ($now->greaterThanOrEqualTo($expiryDate)) {
                $sale->status = 0;
                $sale->save();
            }
        }

        // $this->info("تم تحديث $affected مبيعة منتهية.");
    }
}
