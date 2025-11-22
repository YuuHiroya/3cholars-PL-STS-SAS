<header
    class="w-full h-20 flex justify-between items-center px-10 bg-white border-b shadow-sm fixed top-0 left-0 right-0 z-50">
    <div class="flex items-center gap-2 cursor-pointer" onclick="window.location.href='{{ url('/') }}'">
        <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="w-8 h-8">
        <h1 class="text-lg font-bold text-[#1565C0]">3cholars</h1>
    </div>


    <div class="flex items-center gap-3 cursor-pointer" onclick="window.location.href='{{ route('profile.edit') }}'">
        <div class="text-sm font-medium">{{ Auth::user()?->username }}</div>
        <img src="{{ Auth::user()?->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://via.placeholder.com/40' }}"
            alt="Profile" class="w-10 h-10 rounded-full object-cover">
    </div>
</header>