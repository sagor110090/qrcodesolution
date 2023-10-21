<?php

namespace App\Livewire\Category;

use App\Models\Category;
use LivewireUI\Modal\ModalComponent;

class EditCategory extends ModalComponent
{
    public $name;
    public $slug;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $is_active;
    public $parent_id;
    public $category_id;

    public function mount($id)
    {
        $category = Category::find($id);
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->meta_title = $category->meta_title;
        $this->meta_description = $category->meta_description;
        $this->meta_keywords = $category->meta_keywords;
        $this->is_active = $category->is_active;
        $this->parent_id = $category->parent_id;
        $this->category_id = $category->id;
    }

    public function render()
    {
        $categories = Category::whereNotIn('id', [$this->category_id])->get();
        return view('livewire.category.edit-category', ['categories' => $categories])->layout('components.layouts.admin');
    }


    //updatedName
    public function updatedName($value)
    {
        $this->slug = \Illuminate\Support\Str::slug($value);
    }


    //update
    public function update()
    {

        // dd($this->parent_id);
        $this->validate([
            'name' => 'required|unique:categories,name,' . $this->category_id,
            'slug' => 'required|unique:categories,slug,' . $this->category_id,
            'is_active' => 'required|boolean',
            'parent_id' => 'nullable|exists:categories,id|integer',
        ]);

        $category = Category::find($this->category_id);
        $category->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'is_active' => $this->is_active,
            'parent_id' =>  $this->parent_id == "" ? null : $this->parent_id,
        ]);

        $this->closeModalWithEvents(['categoryUpdated']);
    }
}
