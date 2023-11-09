<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SubscriptionCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (env('ACTIVE_STRIPE')) {
            $users = User::where('created_at', '<=', now()->subDays(14)) //trial expired
                ->get();
            foreach ($users as $user) {
                if ($user->isNotOnSubscription($user)) {
                    $user->qrCodes()->whereIsDynamic(true)->update(['status' => false]);
                }
            }

            //but own log file
            Log::build(['driver' => 'single', 'path' => storage_path('logs/subscription.log')])
                ->info('Subscription check command run successfully!', ['time' => now()]);
        }
    }
}
