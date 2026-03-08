<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Task;
use App\Models\Team;

class KanbanCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Task $task,
        public Team $team
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.kanban-card');
    }
}
