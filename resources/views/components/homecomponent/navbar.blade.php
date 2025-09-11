<div class="fixed top-0 left-0 right-0 z-50 p-3">
    <nav id="navbar"
        class="bg-[#0C64C5] px-10 py-5 flex items-center justify-between rounded-lg transition-transform duration-300 ease-in-out shadow-lg">

        <!-- Left Menu -->
        <div class="flex items-center gap-10 text-white font-bold text-[14px]">
            <a href="#" class="hover:underline">HOME</a>
            <a href="#" class="hover:underline">INFO</a>
            <a href="#" class="hover:underline">ABOUT US</a>
        </div>

        <!-- Center Logo -->
        <div class="absolute left-1/2 transform -translate-x-1/2 rounded-full p-4">
            <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-16 w-20 object-contain">
        </div>

        <!-- Right Menu -->
        <div class="flex items-center gap-10 text-[#f2f4f3] font-bold text-[14px]">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="hover:underline">DASHBOARD</a>
                @else
                    <a href="{{ route('register') }}" class="hover:underline">REGISTER</a>
                    <a href="{{ route('login') }}" class="hover:underline">LOGIN</a>
                @endauth
            @endif
        </div>
    </nav>
</div>