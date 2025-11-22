<?php

namespace App\View\Components\Admin\Content;

use Illuminate\View\Component;
use Illuminate\View\View;

class DashboardContent extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.admin.content.dashboard-content');
    }
}
