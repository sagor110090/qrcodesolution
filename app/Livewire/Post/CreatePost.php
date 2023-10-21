<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{

    use WithFileUploads,LivewireAlert;

    private $post = Post::class;

    public $title;
    public $slug;
    public $content;
    public $categories;
    public $tags;
    public $thumbnail;
    public $is_featured = false;
    public $is_active = true;
    public $published_at;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;


    public function render()
    {
        return view('livewire.post.create-post')->layout('components.layouts.admin');
    }

    //updatedTitle
    public function updatedTitle($value)
    {
        $this->slug = \Illuminate\Support\Str::slug($value);
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'title' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:posts',
            'content' => 'required|min:3',
            'categories' => 'required|array|exists:categories,id',
            'tags' => 'required|array|exists:tags,id',
            'thumbnail' => 'required|image|max:1024',
            'is_featured' => 'required',
            'is_active' => 'required',
            'published_at' => 'nullable|date|after_or_equal:today',
            'meta_title' => 'nullable|min:3',
            'meta_description' => 'nullable|min:3',
            'meta_keywords' => 'nullable|min:3',
        ]);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:posts',
            'content' => 'required|min:3',
            'categories' => 'required|array|exists:categories,id',
            'tags' => 'required|array|exists:tags,id',
            'thumbnail' => 'required|image|max:1024',
            'is_featured' => 'required',
            'is_active' => 'required',
            'published_at' => 'nullable|date|after_or_equal:today',
            'meta_title' => 'nullable|min:3',
            'meta_description' => 'nullable|min:3',
            'meta_keywords' => 'nullable|min:3',
        ]);

        $this->thumbnail = $this->thumbnail->store('thumbnails', 'public');

        $post = $this->post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'categories' => $this->categories,
            'tags' => $this->tags,
            'thumbnail' => $this->thumbnail,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
            'published_at' => $this->published_at,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
        ]);

        $post->categories()->attach($this->categories);
        $post->tags()->attach($this->tags);

        $this->alert('success', 'Post Created Successfully');
        return redirect()->route('posts.index');
    }
}
