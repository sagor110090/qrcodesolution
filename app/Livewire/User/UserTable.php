<?php

namespace App\Livewire\User;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->format(function ($value, $row, Column $column) {
                    return \Carbon\Carbon::parse($value)->format('d M y || h:i:a');
                }),
            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $delete = '<button class="rounded-lg bg-red-500 px-4 py-2 text-white-500 mr-2" wire:click="delete(' . $row->id . ')">Trash</button>';
                        return  $delete;
                    }
                )->html(),
        ];
    }

    public function delete($id)
    {
        $tag = User::find($id);
        $tag->delete();
        $this->dispatch('userAdded');
    }
}
