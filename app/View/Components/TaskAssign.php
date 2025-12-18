<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Task;
use App\Models\Team;
use Carbon\Carbon;

class TaskAssign extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Team $team,
        public Carbon $date
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $tasks = Task::whereDate('tanggal', $this->date)
            ->whereNull('team_id')
            ->get();

        return view('components.task-assign', [
            'tasks' => $tasks
        ]);
    }
}
