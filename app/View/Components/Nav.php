<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Nav extends Component
{
    protected $items;
    protected $active;
    /**
     * Create a new component instance.
     */
    public function __construct($context)
    {

        $this->items = config('nav');
        $this->active = Route::currentRouteName();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav',
        [
            'items' =>$this->items,
            'active' =>$this->active,
        ]);
    }
}
