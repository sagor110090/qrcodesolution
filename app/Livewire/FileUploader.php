<?php

namespace App\Livewire;

use Livewire\Component;
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
    public function mount($name = 'file', $text = 'Upload', $accept = '*', $loadFileName = '')
    {
        $this->name = $name;
        $this->text = $text;
        $this->accept = $accept;
        //before / remove
        $this->loadFileName = str_replace('/', '-', $loadFileName);
    }

    public function render()
    {
        return <<<'HTML'
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress" x-cloak>
                <div class="flex flex-col items-center justify-center h-24" x-show.transition="!isUploading">
                    <label for="{{$name}}" class="relative items-center block w-full py-2 pl-3 pr-4 overflow-hidden leading-tight transition duration-500 ease-in-out bg-white border-2 border-dashed rounded-lg cursor-pointer hover:bg-gray-100 group" wire:loading.class="pointer-events-none">

                        <input type="file" id="{{$name}}" class="absolute inset-0 text-transparent opacity-0 cursor-pointer sr-only"
                            accept="{{ $accept }}" wire:model.live="file" />
                        <div
                            class="flex items-center justify-center flex-1 px-4 py-2 text-sm font-medium leading-normal text-indigo-500 group-hover:text-indigo-500">
                            @if ($name == 'image')

                            <svg class="w-8 h-8 text-indigo-500 group-hover:text-indigo-500" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none"></rect>
                                <path
                                    d="M168.001,100.00017v.00341a12.00175,12.00175,0,1,1,0-.00341ZM232,56V200a16.01835,16.01835,0,0,1-16,16H40a16.01835,16.01835,0,0,1-16-16V56A16.01835,16.01835,0,0,1,40,40H216A16.01835,16.01835,0,0,1,232,56Zm-15.9917,108.6936L216,56H40v92.68575L76.68652,112.0002a16.01892,16.01892,0,0,1,22.62793,0L144.001,156.68685l20.68554-20.68658a16.01891,16.01891,0,0,1,22.62793,0Z">
                                </path>
                            </svg>

                            @elseif($name == 'pdf')

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                class="w-8 h-8 text-indigo-500 group-hover:text-indigo-500" fill="currentColor"
                                class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                            </svg>

                            @elseif($name == 'audio')

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                class="w-8 h-8 text-indigo-500 group-hover:text-indigo-500" fill="currentColor"
                                class="bi bi-file-music-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-.5 4.11v1.8l-2.5.5v5.09c0 .495-.301.883-.662 1.123C7.974 12.866 7.499 13 7 13c-.5 0-.974-.134-1.338-.377-.36-.24-.662-.628-.662-1.123s.301-.883.662-1.123C6.026 10.134 6.501 10 7 10c.356 0 .7.068 1 .196V4.41a1 1 0 0 1 .804-.98l1.5-.3a1 1 0 0 1 1.196.98z" />
                            </svg>

                            @elseif ($name == 'video')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-indigo-500 group-hover:text-indigo-500" width="16" height="16" fill="currentColor" class="bi bi-film" viewBox="0 0 16 16">
                                <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm4 0v6h8V1H4zm8 8H4v6h8V9zM1 1v2h2V1H1zm2 3H1v2h2V4zM1 7v2h2V7H1zm2 3H1v2h2v-2zm-2 3v2h2v-2H1zM15 1h-2v2h2V1zm-2 3v2h2V4h-2zm2 3h-2v2h2V7zm-2 3v2h2v-2h-2zm2 3h-2v2h2v-2z"/>
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                            @endif


                            {{ $text }}

                        </div>
                    </label>
                    @error('file')
                    <div class="mt-1 text-sm text-red-500">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700" x-show.transition="isUploading">
                    <div class="bg-blue-600 h-2.5 rounded-full" :style="'width:'+progress+'%'"></div>
                </div>

                @if ($loadFileName)
                <div class="flex flex-col items-center justify-center h-24">
                    <div
                        class="flex items-center justify-center flex-1 px-4 py-2 text-sm font-medium leading-normal text-indigo-500">
                        @if ($name == 'image')

                            <svg class="w-8 h-8 text-indigo-500 group-hover:text-indigo-500" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none"></rect>
                                <path
                                    d="M168.001,100.00017v.00341a12.00175,12.00175,0,1,1,0-.00341ZM232,56V200a16.01835,16.01835,0,0,1-16,16H40a16.01835,16.01835,0,0,1-16-16V56A16.01835,16.01835,0,0,1,40,40H216A16.01835,16.01835,0,0,1,232,56Zm-15.9917,108.6936L216,56H40v92.68575L76.68652,112.0002a16.01892,16.01892,0,0,1,22.62793,0L144.001,156.68685l20.68554-20.68658a16.01891,16.01891,0,0,1,22.62793,0Z">
                                </path>
                            </svg>

                            @elseif($name == 'pdf')

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                class="w-8 h-8 text-indigo-500 group-hover:text-indigo-500" fill="currentColor"
                                class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                            </svg>

                            @elseif($name == 'audio')

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                class="w-8 h-8 text-indigo-500 group-hover:text-indigo-500" fill="currentColor"
                                class="bi bi-file-music-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-.5 4.11v1.8l-2.5.5v5.09c0 .495-.301.883-.662 1.123C7.974 12.866 7.499 13 7 13c-.5 0-.974-.134-1.338-.377-.36-.24-.662-.628-.662-1.123s.301-.883.662-1.123C6.026 10.134 6.501 10 7 10c.356 0 .7.068 1 .196V4.41a1 1 0 0 1 .804-.98l1.5-.3a1 1 0 0 1 1.196.98z" />
                            </svg>

                            @elseif ($name == 'video')
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2 text-indigo-500 group-hover:text-indigo-500" width="16" height="16" fill="currentColor" class="bi bi-film" viewBox="0 0 16 16">
                                <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm4 0v6h8V1H4zm8 8H4v6h8V9zM1 1v2h2V1H1zm2 3H1v2h2V4zM1 7v2h2V7H1zm2 3H1v2h2v-2zm-2 3v2h2v-2H1zM15 1h-2v2h2V1zm-2 3v2h2V4h-2zm2 3h-2v2h2V7zm-2 3v2h2v-2h-2zm2 3h-2v2h2v-2z"/>
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                            @endif
                        {{ $loadFileName }}
                    </div>
                </div>
                @endif

            </div>
         HTML;
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
        $this->dispatch('fileUpload', $path, $this->file->getClientOriginalName(), $this->name);
    }
}
