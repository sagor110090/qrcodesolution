<?php

namespace App\Livewire\Plan;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;


class CreatePlan extends ModalComponent
{

    public $name;
    public $price;
    public $description;
    public $interval;
    public $currency;
    public $qrcode_limit;


    public function render()
    {
        return view('livewire.plan.create-plan');
    }

    // store
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'interval' => 'required',
            'currency' => 'required',
            'qrcode_limit' => 'required',
        ]);


        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $plan = \Stripe\Plan::create([
            'amount' => $this->price * 100,
            'interval' => $this->interval,
            'product' => [
                'name' => $this->name,
            ],

            'currency' => $this->currency,
        ]);



        \App\Models\Plan::create([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'interval' => $this->interval,
            'currency' => $this->currency,
            'plan_id' => $plan->id,
            'qrcode_limit' => $this->qrcode_limit,
        ]);

        $this->closeModalWithEvents(['planAdded']);
    }
}
