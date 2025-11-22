<aside class="w-64 bg-white shadow-md flex flex-col fixed top-20 left-0 h-[calc(100vh-5rem)]">
    <nav class="flex-1 px-4 py-6 space-y-3 text-[#696969] overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ url('admin/dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('admin/dashboard') ? 'bg-[#1565C0] text-[#F2F4F3]' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
            <iconify-icon icon="material-symbols:dashboard-outline-rounded" style="color: {{ request()->is('admin/dashboard') ? '#F2F4F3' : '#696969' }}" width="28" height="28"></iconify-icon>
            Dashboard
        </a>

        <!-- Users -->
        <a href="{{ url('admin/users') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('admin/users') ? 'bg-[#1565C0] text-[#F2F4F3]' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
            <iconify-icon icon="fluent:people-16-regular" style="color: {{ request()->is('admin/users') ? '#F2F4F3' : '#696969' }}" width="28" height="28"></iconify-icon>
            Users
        </a>

        <!-- Scholarships -->
        <a href="{{ url('admin/scholarships') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('admin/scholarships') ? 'bg-[#1565C0] text-[#F2F4F3]' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
            <iconify-icon icon="mdi:graduation-cap-outline" style="color: {{ request()->is('admin/scholarships') ? '#F2F4F3' : '#696969' }}" width="28" height="28"></iconify-icon>
            Scholarships
        </a>

        <!-- Admin -->
        <a href="{{ url('admin/admin') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('admin/admin') ? 'bg-[#1565C0] text-[#F2F4F3]' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
            <iconify-icon icon="fluent:shield-16-regular" style="color: {{ request()->is('admin/admin') ? '#F2F4F3' : '#696969' }}" width="28" height="28"></iconify-icon>
            Admin
        </a>
    </nav>
</aside>
