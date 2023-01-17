<?php

namespace App\View\Components;

use Illuminate\View\Component;

class chat-item extends Component
{
    public $message;
    public $name;
    public $time;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message, $name, $time)
    {
        $this->message = $message;
        $this->name = $name;
        $this->time = $time;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.chat-item');
    }
}
