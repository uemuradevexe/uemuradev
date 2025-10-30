<?php

namespace App\Livewire;

use Livewire\Component;

class SocialLinks extends Component
{

    public $links = [
        [
            'name' => 'LinkedIn',
            'url' => 'https://www.linkedin.com/in/uemuraricardo/',
            'icon' => 'LinkedIn',
        ],
        [
            'name' => 'GitHub',
            'url' => 'https://github.com/uemuradevexe',
            'icon' => 'GitHub',
        ],
    ];

    public function mount()
    {
        //
    }

    public function render()
    {
        return view('livewire.social-links');
    }
}
