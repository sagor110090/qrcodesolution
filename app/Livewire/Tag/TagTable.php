<?php

namespace App\Livewire\Tag;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tag;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TagTable extends DataTableComponent
{

    use LivewireAlert;

    protected $listeners = ['tagCreated' => '$refresh', 'tagUpdated' => '$refresh', 'tagDeleted' => '$refresh'];

    protected $model = Tag::class;

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
            Column::make("Updated at", "updated_at")
                ->format(function ($value, $row, Column $column) {
                    return \Carbon\Carbon::parse($value)->format('d M y || h:i:a');
                }),
                Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $delete = '<button class="rounded-lg bg-red-500 px-4 py-2 text-white-500 mr-2" wire:click="delete(' . $row->id . ')">Trash</button>';
                        $edit = '<button class="rounded-lg bg-indigo-500 px-4 py-2   text-white-500 mr-2" wire:click="edit(' . $row->id . ')">Edit</button>';

                        return $edit . $delete ;
                    }
                )->html(),


        ];
    }

    public function delete($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        $this->dispatch('tagDeleted');
    }

    public function edit($id)
    {
        $this->dispatch('openModal', component:'tag.edit-tag', arguments: ['id' => $id]);
    }
}
