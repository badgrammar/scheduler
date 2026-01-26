<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Team;
use App\Models\Task;
use Carbon\Carbon;

class KanbanBoard extends Component
{
    public $selectedDate;

    protected $listeners = [
        'date-selected' => 'updateKanban'
    ];

    public function mount()
    {
        $this->selectedDate = Carbon::now();
    }

    public function updateKanban(string $date)
    {
        $this->selectedDate = Carbon::parse($date);
    }

    public function createTeam()
    {
        $date = Carbon::parse($this->selectedDate);

        Team::create([
            'created_at' => $date
        ]);

    }

    public function render()
    {
        $pending = Task::whereNull('team_id')->get();

        $scheduled = Task::whereNull('team_id')->whereDate('created_at', $this->selectedDate)->get();

        $teams = Team::with('tasks')->whereDate('created_at', $this->selectedDate)->get();

        return view('livewire.kanban-board', [
            'pending' => $pending,
            'scheduled' => $scheduled,
            'teams' => $teams
        ]);
    }
}
