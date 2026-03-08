<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Task;
use Carbon\Carbon;

class TaskAssign extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Task $task,
        public Carbon $tanggal,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task-assign');
    }
}
