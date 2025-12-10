<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Team;
use Carbon\Carbon;

class ScheduleTable extends Component
{
    public $selectedDate;

    protected $listeners = [
        'date-selected' => 'updateTable'
    ];

    public function mount()
    {
        $this->selectedDate = Carbon::now();
    }

    public function updateTable(string $date)
    {
        $this->selectedDate = Carbon::parse($date);
    }

    public function createTeam()
    {
        Team::create();
    }

    public function render()
    {
        $teams = Team::whereDate('created_at', $this->selectedDate)->get();

        return view('livewire.schedule-table', [
            'teams' => $teams
        ]);
    }
}
