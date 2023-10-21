<?php

namespace App\Livewire\Category;

use LivewireUI\Modal\ModalComponent;


class CreateCategory extends ModalComponent
{

    use \Jantinnerezo\LivewireAlert\LivewireAlert;

    public $name;
    public $slug;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $is_active = true;
    public $parent_id;


    public function render()
    {
        $categories = \App\Models\Category::all();
        return view('livewire.category.create-category',['categories' => $categories])->layout('components.layouts.admin');
    }

    //updatedName
    public function updatedName($value)
    {
        $this->slug = \Illuminate\Support\Str::slug($value);
    }


    //store
    public function store()
    {
        $this->validate([
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
            'is_active' => 'required|boolean',
            'parent_id' => 'nullable|exists:categories,id|integer',
        ]);

        \App\Models\Category::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'is_active' => $this->is_active,
            'parent_id' => $this->parent_id == "" ? null : $this->parent_id,
        ]);
        $this->alert('success', 'Category Created Successfully');
        $this->closeModalWithEvents(['categoryCreated']);
    }
}
