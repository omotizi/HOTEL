<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConfirmationModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $web;
    public function __construct($web = false)
    {
        $this->web = $web;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $web = $this->web;
        return view('components.confirmation-modal',compact('web'));
    }
}
