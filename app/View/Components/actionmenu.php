<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class actionmenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $editUrl;
    public $deleteUrl;
    public $uniqueId;

    public function __construct($editUrl, $deleteUrl, $uniqueId)
    {
        $this->editUrl = $editUrl;
        $this->deleteUrl = $deleteUrl;
        $this->uniqueId = $uniqueId;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.actionmenu');
    }
}
