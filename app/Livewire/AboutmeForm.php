<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class AboutmeForm extends Component
{
    use WithPagination;

    public $text = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Est non natus iste, eaque minima ipsum, officia praesentium culpa dolore minus cupiditate temporibus id quisquam officiis quibusdam, pariatur distinctio mollitia quae.';
    public $isOpen = false;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function edit()
    {
        $this->isOpen = true;
    }

    public function render()
    {
        return view('livewire.aboutme-form');
    }
}
