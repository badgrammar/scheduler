<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class WeeklyPicker extends Component
{
    public $date;
    public $selectedDate;
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

        $this->dispatch('date-selected', date: $this->selectedDate);
    }

    public function render()
    {
        return view('livewire.weekly-picker');
    }
}
