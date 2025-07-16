<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AboutMe;
use App\Services\CustomMarkdownService;

class AboutmeForm extends Component
{
    use WithPagination;

    public $text = '';
    public $description = '';
    public $isOpen = false;
    public $previewMode = false;

    protected $markdownService;

    public function boot(CustomMarkdownService $markdownService)
    {
        $this->markdownService = $markdownService;
    }

    public function mount()
    {
        // Load existing about me text from database
        $aboutMe = AboutMe::first();
        $this->text = $aboutMe ? $aboutMe->text : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Est non natus iste, eaque minima ipsum, officia praesentium culpa dolore minus cupiditate temporibus id quisquam officiis quibusdam, pariatur distinctio mollitia quae.';
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->description = $this->text; // Pre-fill the textarea with current text
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->description = '';
    }

    public function edit()
    {
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'description' => 'required|string|max:1000',
        ]);

        // Update or create the about me record
        $aboutMe = AboutMe::first();

        if ($aboutMe) {
            $aboutMe->update(['text' => $this->description]);
        } else {
            AboutMe::create(['text' => $this->description]);
        }

        // Update the displayed text
        $this->text = $this->description;

        // Close modal and reset form
        $this->closeModal();

        // Show success message
        session()->flash('message', 'About me text updated successfully!');
    }

    public function togglePreview()
    {
        $this->previewMode = !$this->previewMode;
    }

    public function getPreviewText()
    {
        return $this->markdownService->process($this->description);
    }

    public function render()
    {
        return view('livewire.aboutme-form');
    }
}
