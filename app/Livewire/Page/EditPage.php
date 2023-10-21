<?php

namespace App\Livewire\Page;

use Livewire\Component;

class EditPage extends Component
{

    public $page;

    public $name;
    public $slug;
    public $content;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $is_active;

    public function mount($id)
    {
        $this->page = \App\Models\Page::findOrFail($id);
        $this->name = $this->page->name;
        $this->slug = $this->page->slug;
        $this->content = $this->page->content;
        $this->meta_title = $this->page->meta_title;
        $this->meta_description = $this->page->meta_description;
        $this->meta_keywords = $this->page->meta_keywords;
        $this->is_active = $this->page->is_active;
    }

    public function render()
    {
        return view('livewire.page.edit-page')->layout('components.layouts.admin');
    }

    //updatedName
    public function updatedName($value)
    {
        $this->slug = \Illuminate\Support\Str::slug($value);
    }

    //update
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:pages,slug,' . $this->page->id,
            'content' => 'required',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'is_active' => 'required',
        ]);

        $this->page->name = $this->name;
        $this->page->slug = $this->slug;
        $this->page->content = $this->content;
        $this->page->meta_title = $this->meta_title;
        $this->page->meta_description = $this->meta_description;
        $this->page->meta_keywords = $this->meta_keywords;
        $this->page->is_active = $this->is_active;
        $this->page->save();

        session()->flash('message', 'Page successfully updated.');

        return redirect()->route('pages.index');
    }
}
