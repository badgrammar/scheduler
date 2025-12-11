<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Team;
use Carbon\Carbon;

class ScheduleTable extends Component
{
    public $selectedDate;
    public $selectedTeam;

    protected $listeners = [
        'date-selected' => 'updateTable'
    ];

    public function mount()
    {
        $this->selectedDate = Carbon::now();
        $this->selectedTeam = Team::whereDate('created_at', $this->selectedDate)->oldest()->first()->id;
    }

    public function updateTable(string $date)
    {
        $this->selectedDate = Carbon::parse($date);
    }

    public function createTeam()
    {
        Team::create();
    }

    public function selectTeam(int $id)
    {
        $this->selectedTeam = $id;
    }

    public function render()
    {
        $teams = Team::with('members')
            ->whereDate('created_at', $this->selectedDate);

        $listTeam = $teams->get();

        $selected = $teams->find($this->selectedTeam);

        return view('livewire.schedule-table', [
            'listTeam' => $listTeam,
            'selected' => $selected
        ]);
    }
}
