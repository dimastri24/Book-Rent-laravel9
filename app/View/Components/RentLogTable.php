<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RentLogTable extends Component
{
    public $rentlogs;
    public $paginate;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($rentlogs, $paginate = false)
    {
        $this->rentlogs = $rentlogs;
        $this->paginate = $paginate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rent-log-table');
    }
}
