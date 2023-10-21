<?php

namespace App\Livewire\Page;

use Livewire\Component;

class CreatePage extends Component
{

    public $name;
    public $slug;
    public $content;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $is_active;

    public function render()
    {
        return view('livewire.page.create-page')->layout('components.layouts.admin');
    }


        //updatedName
        public function updatedName($value)
        {
            $this->slug = \Illuminate\Support\Str::slug($value);
        }



    public function store()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:pages',
            'content' => 'required',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_active' => 'required',
        ]);

        $page = new \App\Models\Page();
        $page->name = $this->name;
        $page->slug = $this->slug;
        $page->content = $this->content;
        $page->meta_title = $this->meta_title;
        $page->meta_description = $this->meta_description;
        $page->meta_keywords = $this->meta_keywords;
        $page->is_active = $this->is_active;
        $page->save();

        session()->flash('message', 'Page successfully created.');

        return redirect()->route('pages.index');
    }
}
