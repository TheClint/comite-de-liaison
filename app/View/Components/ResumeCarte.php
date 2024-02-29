<?php

namespace App\View\Components;

use App\Models\Departement;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ResumeCarte extends Component
{

    private Departement $departement;

    /**
     * Create a new component instance.
     */
    public function __construct($departement)
    {
        $this->departement = $departement;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.resume-carte', [
            'departement' => $this->departement
        ]);
    }
}
