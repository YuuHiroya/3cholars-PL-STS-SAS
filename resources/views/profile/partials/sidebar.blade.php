<aside class="w-64 bg-white shadow-md flex flex-col fixed top-20 left-0 h-[calc(100vh-5rem)]">
    <nav class="flex-1 px-4 py-6 space-y-3 text-[#696969] overflow-y-auto">

        <!-- Home -->
        <a href="{{ url('/') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('/') ? 'bg-[#1565C0] text-[#F2F4F3]' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
            <iconify-icon icon="fluent:home-16-regular" style="color: {{ request()->is('/') ? '#F2F4F3' : '#696969' }}"
                width="28" height="28"></iconify-icon>
            Home
        </a>

        <!-- Dashboard -->
        <a href="{{ url('dashboard') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('dashboard') ? 'bg-[#1565C0] text-[#F2F4F3]' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
            <iconify-icon icon="material-symbols:dashboard-outline-rounded"
                style="color: {{ request()->is('dashboard') ? '#F2F4F3' : '#696969' }}" width="28"
                height="28"></iconify-icon>
            Dashboard
        </a>

        <!-- Scholarships -->
        <a href="{{ url('scholarships') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('scholarships') ? 'bg-[#1565C0] text-[#F2F4F3]' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
            <iconify-icon icon="mdi:graduation-cap-outline"
                style="color: {{ request()->is('scholarships') ? '#F2F4F3' : '#696969' }}" width="28"
                height="28"></iconify-icon>
            Scholarships
        </a>

        <!-- Submissions -->
        <a href="{{ url('submissions') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('submissions') ? 'bg-[#1565C0] text-[#F2F4F3]' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
            <iconify-icon icon="line-md:account"
                style="color: {{ request()->is('submissions') ? '#F2F4F3' : '#696969' }}" width="28"
                height="28"></iconify-icon>
            Submissions
        </a>

        <!-- Form -->
        <a href="{{ url('form') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('form') ? 'bg-[#1565C0] text-[#F2F4F3]' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
            <iconify-icon icon="lets-icons:form-fill" style="color: {{ request()->is('form') ? '#F2F4F3' : '#696969' }}"
                width="28" height="28"></iconify-icon>
            Form
        </a>

    </nav>
</aside>