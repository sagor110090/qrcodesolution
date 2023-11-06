<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class FileUploader extends Component
{
    use WithFileUploads;


    public $name;
    public $text;
    public $accept;
    public $file;
    public $rules;

    public $loadFileName = '';

    // mount
    public function mount($name = 'file', $text = 'Upload', $accept = '*',$loadFileName = '')
    {
        $this->name = $name;
        $this->text = $text;
        $this->accept = $accept;
        //before / remove
        $this->loadFileName = str_replace('/', '-', $loadFileName);
    }


    public function render()
    {
        sleep(1);
        return view('livewire.file-uploader');
    }

    public function updatedFile()
    {
        $this->resetErrorBag();
        $this->dispatch('fileUpload');
        $this->loadFileName = '';
        $this->validate([
            'file' => $this->rules,
        ]);

        $this->loadFileName = $this->file->getClientOriginalName();

        $path = $this->file->getRealPath();
        $this->dispatch('fileUpload', $path, $this->file->getClientOriginalName(),$this->name);
    }







}
