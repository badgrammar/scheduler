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
        $teamData = Team::whereDate('created_at', $this->selectedDate)->oldest()->first();

        $this->selectedTeam = $teamData ? $teamData->id : null;
    }

    public function updateTable(string $date)
    {
        $this->selectedDate = Carbon::parse($date);
        $teamData = Team::whereDate('created_at', $this->selectedDate)->oldest()->first();

        $this->selectedTeam = $teamData ? $teamData->id : null;
    }

    public function createTeam()
    {
        $date = Carbon::parse($this->selectedDate);

        Team::create([
            'created_at' => $date
        ]);

        $this->selectedTeam = Team::whereDate('created_at', $this->selectedDate)->latest()->first()->id;
    }

    public function selectTeam(int $id)
    {
        $this->selectedTeam = $id;
    }

    public function deleteTeam(int $id)
    {
        Team::find($id)->delete();

        $team = Team::whereDate('created_at', $this->selectedDate)->latest()->first();

        $this->selectedTeam = $team ? $team->id : null;
    }

    public function deleteMember(int $id)
    {
        
    }

    public function render()
    {
        $teams = Team::with('members')
            ->whereDate('created_at', $this->selectedDate);

        $listTeam = $teams->get();

        $selected = $teams->find($this->selectedTeam);

        $unassignedTasks = Task::whereDate('tanggal', $this->selectedDate->format('Y-m-d'))
            ->whereNull('team_id')
            ->get();

        return view('livewire.schedule-table', [
            'listTeam' => $listTeam,
            'selected' => $selected,
            'unassignedTasks' => $unassignedTasks
        ]);
    }
}
