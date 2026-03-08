<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Task;

class Schedule extends Component
{
    public $selectedDate;
    public $date;
    public $week = [];

    public function mount()
    {
        $this->date = Carbon::now();

        $this->selectedDate = $this->date->format('d-m-Y');

        $this->week($this->date);

    }

    public function week(Carbon $date)
    {
        $start = $date->startOfWeek();

        $week = collect(range(0,6))
            ->map(fn($i) => $start->clone()->addDays($i)->format('d-m-Y'))
            ->toArray();

        $this->week = $week;
    }

    public function nextWeek()
    {
        $this->week($this->date->addWeek());
    }

    public function prevWeek()
    {
        $this->week($this->date->subWeek());
    }

    public function selectDate(string $date)
    {
        $this->selectedDate = $date;
    }

    public function createTeam()
    {
        $date = Carbon::parse($this->selectedDate);

        Team::create([
            'created_at' => $date
        ]);

    }

    #[Layout('components.layouts.app', ['title' => 'Schedule'])]
    public function render()
    {
       $pending = Task::whereNull('team_id')->orderBy('updated_at', 'desc')->get();

       $teams = Team::with(['tasks' => function ($query){
            $query->orderBy('jam');
       }, 'members' ])
            ->whereDate('created_at', Carbon::parse($this->selectedDate))->get();

       return view('livewire.schedule', [
            'pending' => $pending,
            'teams' => $teams
       ]);
    }
}
