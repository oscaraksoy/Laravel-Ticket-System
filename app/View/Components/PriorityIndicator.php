<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PriorityIndicator extends Component
{
    public $priority;

    public function __construct($priority)
    {
        $this->priority = $priority;
    }

    public function render(): View|Closure|string
    {
        return view('components.priority-indicator');
    }
}
