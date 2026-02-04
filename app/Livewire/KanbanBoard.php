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

        $teams = Team::with(['tasks', 'members', 'assigned'])->whereDate('created_at', $this->selectedDate)->get();

        return $teams;

        return view('livewire.kanban-board', [
            'pending' => $pending,
            'teams' => $teams
        ]);
    }
}
