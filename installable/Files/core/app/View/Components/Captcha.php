<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Captcha extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $path;
    public $custom;
    public $addClass;
    public $marginTop;

    public function __construct($path = null,$custom = false,$addClass=null, $marginTop = null)
    {
        $this->custom = $custom;
        $this->marginTop = $marginTop;
        $this->addClass = $addClass;
        $this->path = $path;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if ($this->path) {
            return view($this->path.'.captcha');
        }
        $custom = $this->custom;
        $addClass = $this->addClass;
        $marginTop = $this->marginTop;
        return view('partials.captcha',compact('custom','addClass', 'marginTop'));
    }
}
