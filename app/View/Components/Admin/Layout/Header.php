<?php

namespace App\View\Components\Admin\Layout;

use Illuminate\View\Component;
use Illuminate\View\View;

class Header extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.admin.layout.header');
    }
}
