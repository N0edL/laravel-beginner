<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;


class ProjectsTabel extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $isOpen = false;
    public $activeFilter = '';
    public $projectId;
    public $name;
    public $description;
    public $stack;
    public $due_date;
    public $active;
    public $url;

    protected $rules = [
        'name' => 'required|string|max:55',
        'description' => 'required|string',
        'stack' => 'required|string',
        'due_date' => 'nullable|date',
        'active' => 'boolean',
        'url' => 'nullable|url',
    ];

    public function render()
    {
        return view('livewire.projects-tabel', [
            'projects' => Project::query()
                ->when($this->search, function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('stack', 'like', '%' . $this->search . '%');
                })
                ->when($this->activeFilter, function ($query) {
                    $query->where('active', $this->activeFilter);
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            if ($field === 'due_date') {
                $this->sortDirection = 'desc';
            } else {
                $this->sortDirection = 'asc';
            }
            $this->sortField = $field;
        }
    }

    public function filterByActive($status)
    {
        $this->activeFilter = $status;
    }

    public function resetFilters()
    {
        $this->reset(['search', 'activeFilter']);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $this->projectId = $id;
        $this->name = $project->name;
        $this->description = $project->description;
        $this->stack = $project->stack;
        $this->due_date = $project->due_date ? $project->due_date->format('Y-m-d') : null;
        $this->active = $project->active;
        $this->url = $project->url;

        $this->openModal();
    }

    public function toggleActive($id)
    {
        $project = Project::findOrFail($id);
        $project->active = !$project->active;
        $project->save();

        // session()->flash('message', 'Project status updated successfully.');
        $this->dispatch('flash-message', message: 'Project status updated successfully.');
    }

    public function delete($id)
    {
        Project::find($id)->delete();
        // session()->flash('message', 'Project deleted successfully.');
        $this->dispatch('flash-message', message: 'Project deleted successfully.');
    }

    public function store()
    {
        $this->validate();

        Project::updateOrCreate(
            ['id' => $this->projectId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'stack' => $this->stack,
                'due_date' => $this->due_date ? $this->due_date : now(),
                'active' => $this->active,
                'url' => $this->url,
            ]
        );

        $this->closeModal();
        // session()->flash('message', $this->projectId ? 'Project updated successfully.' : 'Project created successfully.');
        // return redirect(request()->header('Referer') ?? url()->previous());
        $this->dispatch('flash-message', message: $this->projectId ? 'Project updated successfully.' : 'Project created successfully.');
    }

    private function resetInputFields()
    {
        $this->projectId = null;
        $this->name = '';
        $this->description = '';
        $this->stack = '';
        $this->due_date = null;
        $this->active = false;
        $this->url = '';
    }
}
