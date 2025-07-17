<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;

class AdminStats extends Component
{
    public $totalProjects;
    public $activeProjects;


    public function mount()
    {
        $this->refresh();
    }

    public function refresh()
    {
        $this->totalProjects = Project::count();
        $this->activeProjects = Project::where('active', true)->count();
    }

    public function render()
    {
        return view('livewire.admin-stats');
    }
}
