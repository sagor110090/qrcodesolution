<?php

namespace App\Livewire\Plan;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Plan;

class PlanTable extends DataTableComponent
{
    protected $listeners = ['planAdded' => '$refresh', 'planUpdated' => '$refresh', 'tagDeleted' => '$refresh'];
    protected $model = Plan::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Price", "price")
                ->sortable(),
            Column::make("Interval", "interval")
                ->sortable(),
            Column::make("Plan id", "plan_id")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("Currency", "currency")
                ->sortable(),
                Column::make("Qr code Limit", "qrcode_limit")
                ->sortable(),
                Column::make("Created at", "created_at")
                ->format(function ($value, $row, Column $column) {
                    return \Carbon\Carbon::parse($value)->format('d M y || h:i:a');
                }),
                Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $delete = '<button class="rounded-lg bg-red-500 px-4 py-2 text-white-500 mr-2" wire:click="delete(' . $row->id . ')">Trash</button>';
                        $edit = '<button class="rounded-lg bg-indigo-500 px-4 py-2   text-white-500 mr-2" wire:click="edit(' . $row . ')">Edit</button>';

                        return  $edit . $delete;
                    }
                )->html(),
        ];
    }

    //edit
    public function edit($plan)
    {
        $this->dispatch('openModal', component:'plan.edit-plan', arguments: ['plan' => $plan]);
    }

    public function delete($id)
    {
        $tag = Plan::find($id);
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $stripe->plans->delete(
            $tag->plan_id,
            []
          );
        $tag->delete();
        $this->dispatch('tagDeleted');
    }
}
