<header class="w-full h-20 flex justify-between items-center px-10 bg-white border-b shadow-sm fixed top-0 left-0 right-0 z-50">
    <div class="flex items-center gap-2 cursor-pointer" onclick="window.location.href='{{ url('/') }}'">
        <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="w-8 h-8">
        <h1 class="text-lg font-bold text-[#1565C0]">3cholars</h1>
    </div>

    <!-- Admin Info (Name and Email only, no avatar) -->
    <div class="flex items-center gap-4">
        <div class="text-right">
            <p class="text-sm font-medium text-[#0B2027]">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</p>
            <p class="text-xs text-[#696969]">{{ Auth::guard('admin')->user()->email ?? '' }}</p>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="px-4 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition font-semibold text-sm">
                Logout
            </button>
        </form>
    </div>
</header>
