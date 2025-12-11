<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Team;
use App\Models\Teknisi;

class MemberAdd extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
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
        $teknisis = Teknisi::all();

        return view('components.member-add', [
            'teknisis' => $teknisis
        ]);
    }
}
