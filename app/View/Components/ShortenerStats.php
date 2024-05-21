<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShortenerStats extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $data, public string $name)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shortener-stats', [
            'data' => $this->data,
            'name' => $this->name,
        ]);
    }
}
