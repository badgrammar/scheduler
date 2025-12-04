<?php

namespace App\Livewire;

use Livewire\Component;
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
        $this->selectedDate = $date;
    }

    public function render()
    {
        return view('livewire.schedule-table');
    }
}
