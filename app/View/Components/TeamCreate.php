<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Team;
use App\Models\Teknisi;
use Carbon\Carbon;

class TeamCreate extends Component
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
        $teknisis = Teknisi::all();

        return view('components.team-create', [
            'teknisis' => $teknisis
        ]);
    }
}
