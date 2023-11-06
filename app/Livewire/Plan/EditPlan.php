<?php

namespace App\Livewire\Plan;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditPlan extends ModalComponent
{

    public $plan_id;

    public $name;
    public $price;
    public $description;
    public $interval;
    public $currency;
    public $qrcode_limit;

    // mount
    public function mount($plan)
    {
        $plan = (object) $plan;
        $this->plan_id = $plan->plan_id;
        $this->name = $plan->name;
        $this->description = $plan->description;
        $this->qrcode_limit = $plan->qrcode_limit;
    }

    public function render()
    {
        return view('livewire.plan.edit-plan');
    }

    // store
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'qrcode_limit' => 'required',
        ]);



        \App\Models\Plan::where('plan_id', $this->plan_id)->update([
            'name' => $this->name,
            'description' => $this->description,
            'qrcode_limit' => $this->qrcode_limit,

        ]);

        $this->closeModalWithEvents(['planUpdated']);

    }
}
