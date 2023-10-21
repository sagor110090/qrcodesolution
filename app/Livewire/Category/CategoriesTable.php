<?php

namespace App\Livewire\Category;

use Carbon\Carbon;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class CategoriesTable extends DataTableComponent
{

    use LivewireAlert;

    protected $listeners = [
        'categoryCreated' => '$refresh',
        'categoryUpdated' => '$refresh',
        'categoryDeleted' => '$refresh',
    ];

    protected $model = Category::class;

    public function configure(): void
    {
        $this->setSearchLazy();
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
            ->searchable()
                ->sortable(),
            BooleanColumn::make("active", "is_active")
                ->sortable(),
            Column::make("Parent", "parent_id")
                ->format(function ($value, $row, Column $column) {
                    return $row->parentCategory->name ?? '';
                })
                ->searchable()
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->format(function ($value, $row, Column $column) {
                    return Carbon::parse($value)->format('d M y || h:i:a');
                })
                ->sortable(),

            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $delete = '<button class="rounded-lg bg-red-500 px-4 py-2 text-white-500 mr-2" wire:click="delete(' . $row->id . ')">Trash</button>';
                        $edit = '<button class="rounded-lg bg-indigo-500 px-4 py-2   text-white-500 mr-2" wire:click="edit(' . $row->id . ')">Edit</button>';
                        if (!$row->is_active) {
                            $is_active = '<button class="rounded-lg bg-green-500 px-4 py-2   text-white-500 mr-2" wire:click="approve(' . $row->id . ')">Active</button>';
                        } else {
                            $is_active = '<button class="rounded-lg bg-gray-500 px-4 py-2   text-white-500 mr-2" wire:click="approve(' . $row->id . ')"> Not active</button>';
                        }
                        // return  $delete;
                        return $edit . $delete . $is_active;
                    }
                )->html(),

        ];
    }



    // edit
    public function edit($id)
    {
        // dispatch('showModal', ['honesty-bar-modal-order-management',{{ $item->id }}])
        // button click from here
        $this->dispatch('openModal',  component:  'category.edit-category', arguments:  ['id' => $id] );

    }

    // delete
    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        $this->dispatch('categoryDeleted');
    }

    // approve
    public function approve($id)
    {
        $category = Category::find($id);
        $category->update([
            'is_active' => !$category->is_active,
        ]);
        $this->dispatch('categoryUpdated');
    }

}
