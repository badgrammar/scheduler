<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Task;
use Carbon\Carbon;

class UnassignedTasksTable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $tasks,
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
        return view('components.unassigned-tasks-table');
    }
}
