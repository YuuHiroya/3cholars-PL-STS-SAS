<?php

namespace App\View\Components\Admin\Sidebar;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminSidebar extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.admin.sidebar.admin-sidebar');
    }
}
