<div class="fixed top-0 left-0 right-0 z-50 p-3">
    <nav id="navbar"
        class="bg-[#0C64C5] px-2 sm:px-4 lg:px-10 py-5 flex items-center justify-between rounded-lg transition-transform duration-300 ease-in-out shadow-lg relative">

        <!-- Left Menu (Desktop Only) -->
        <div class="hidden sm:flex items-center gap-4 text-white font-semibold text-sm lg:text-base">
            <a href="#" class="hover:underline">HOME</a>
            <a href="#" class="hover:underline">INFO</a>
            <a href="#" class="hover:underline">ABOUT US</a>
        </div>

        <!-- Hamburger Button (Mobile Only) -->
        <button id="menu-btn" class="sm:hidden text-white text-2xl focus:outline-none ml-auto z-50 relative pr-4"
            aria-expanded="false" aria-controls="mobile-menu" aria-label="Open menu">
            <i class="bi bi-list"></i>
        </button>

        <!-- Center Logo -->
        <div class="absolute sm:left-1/2 sm:-translate-x-1/2 left-4 rounded-full sm:p-4 transition-all duration-300">
            <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="h-10 w-12 sm:h-12 sm:w-12 object-contain">
        </div>

        <!-- Right Menu (Desktop Only) -->
        <div class="hidden sm:flex items-center gap-10 text-white font-semibold text-sm lg:text-base">
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

<!-- Overlay -->
<div id="mobile-overlay" class="hidden fixed inset-0 bg-black/40 z-40 sm:hidden"></div>

<!-- Mobile Menu -->
<div id="mobile-menu"
    class="fixed right-0 sm:hidden bg-[#0C64C5] text-white p-5 rounded-b-lg transform translate-x-[120%] transition-transform duration-300 ease-in-out z-50 overflow-y-auto shadow-lg will-change-transform"
    aria-hidden="true" role="dialog" aria-label="Mobile menu">
    <div class="flex flex-col gap-4 text-[14px] font-semibold">
        <a href="#" class="hover:underline">HOME</a>
        <a href="#" class="hover:underline">INFO</a>
        <a href="#" class="hover:underline">ABOUT US</a>

        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="hover:underline">DASHBOARD</a>
            @else
                <a href="{{ route('register') }}" class="hover:underline">REGISTER</a>
                <a href="{{ route('login') }}" class="hover:underline">LOGIN</a>
            @endauth
        @endif
    </div>
</div>