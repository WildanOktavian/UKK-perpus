<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BrowwingTable extends Component
{
    public $browwing;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($browwing)
    {
        $this->browwing = $browwing;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.browwing-table');
    }
}
