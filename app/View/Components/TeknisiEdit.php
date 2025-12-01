<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Teknisi;

class TeknisiEdit extends Component
{
    /**
     * Create a new component instance.
     */
    public $teknisi;

    public function __construct($teknisi)
    {
        $this->teknisi = $teknisi;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.teknisi-edit');
    }
}
