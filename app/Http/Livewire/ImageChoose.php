<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;

use Livewire\Component;

class ImageChoose extends Component
{
    use WithFileUploads;
    public $photo;
    public function render()
    {
        return view('livewire.image-choose');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:5000',
        ]);
    }
}
