<?php

namespace App\Console\Commands;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeactivateExpiredOffers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offers:deactivate-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate offers that have expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // تحديث العروض التي انتهى تاريخ صلاحيتها وجعلها غير فعالة
        $expiredOffersCount = Offer::where('active', true)
            ->where('valid_until', '<', $now)
            ->update(['active' => false]);

        $this->info("Expired offers deactivated: {$expiredOffersCount}");

        return 0; // نجاح التنفيذ
    }
}
