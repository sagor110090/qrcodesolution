<?php

namespace App\Livewire\Page;

use App\Models\Page;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class PageTable extends DataTableComponent
{

    use LivewireAlert;
    protected $model = Page::class;

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
            Column::make("Slug", "slug")
                ->sortable(),
            BooleanColumn::make("active", "is_active")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->format(function ($value, $row, Column $column) {
                    return \Carbon\Carbon::parse($value)->format('d M y || h:i:a');
                })
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->format(function ($value, $row, Column $column) {
                    return \Carbon\Carbon::parse($value)->format('d M y || h:i:a');
                })
                ->sortable(),

            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $delete = '<button class="rounded-lg bg-red-500 px-4 py-2 text-white-500 mr-2" wire:click="delete(' . $row->id . ')">Trash</button>';
                        $edit = '<button class="rounded-lg bg-indigo-500 px-4 py-2   text-white-500 mr-2" wire:click="edit(' . $row->id . ')">Edit</button>';
                        if (!$row->is_active) {
                            $is_active = '<button class="rounded-lg bg-green-500 px-4 py-2   text-white-500 mr-2" wire:click="active(' . $row->id . ')">Active</button>';
                        } else {
                            $is_active = '<button class="rounded-lg bg-gray-500 px-4 py-2   text-white-500 mr-2" wire:click="active(' . $row->id . ')"> Not active</button>';
                        }
                        return $edit . $delete . $is_active;
                    }
                )->html(),
        ];
    }

    //delete
    public function delete($id)
    {
        $page = Page::find($id);
        $page->delete();
        $this->alert('success', 'Page successfully deleted.');
    }

    //active
    public function active($id)
    {
        $page = Page::find($id);
        $page->is_active = !$page->is_active;
        $page->save();
        $this->alert('success', 'Page successfully updated.');
    }

    //edit
    public function edit($id)
    {
        return redirect()->route('pages.edit', $id);
    }

}
