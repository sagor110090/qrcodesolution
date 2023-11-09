<?php

namespace App\Models;

use Laravel\Cashier\Subscription as CashierSubscription;
 
class Subscription extends CashierSubscription
{
    //make relation with plan by plan_id and stripe_price
    public function plan(){
       //join plan table with plan_id and stripe_price
         return $this->hasOne(Plan::class, 'plan_id', 'stripe_price');
    }
}
