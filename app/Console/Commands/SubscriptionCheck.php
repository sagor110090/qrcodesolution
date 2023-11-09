<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

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
        $users = User::where('created_at', '<=', now()->subDays(14)) //trial expired
            ->get();
        foreach ($users as $user) {
            if($user->isNotOnSubscription($user)){
                $user->qrCodes()->whereIsDynamic(true)->update(['status' => false]);
            }
        }
    }
}
