<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#F2F4F3] font-[Montserrat]">
        <div
            class="w-11/12 md:w-4/5 lg:w-3/4 mt-4 bg-white shadow-lg rounded-lg flex flex-col md:flex-row overflow-hidden">

            <!-- Left Section -->
            <div class="w-full md:w-1/2 relative">
                <!-- Background image -->
                <img src="{{ asset('image/bg1.jpeg') }}" alt="Background" class="w-full h-full object-cover">

                <!-- Rectangle transparan -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="bg-[#F2F4F3]/80 px-14 py-16 max-w-xl text-left relative">

                        <!-- Title dengan segitiga -->
                        <h1
                            class="text-3xl md:text-[36px] lg:text-[40px] text-[#0B2027] leading-tight flex items-start gap-1 -ml-4">
                            <!-- Segitiga -->
                            <span
                                class="mt-3 w-0 h-0 border-t-[12px] border-b-[12px] border-l-[18px] border-transparent border-l-[#1565c0]"></span>

                            <!-- Teks -->
                            <span class="font-medium -ml-6">
                                &nbsp;&nbsp;&nbsp;Digital <br> Platform for <br>
                                <span
                                    class=" font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#090979] to-[#00D4FF]">
                                    Free <br> Scholarship <br> Programs!!
                                </span>
                            </span>
                        </h1>
                    </div>
                </div>
            </div>


            <!-- Right Section -->
            <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
                <h2 class="text-2xl md:text-3xl lg:text-[40px] font-bold text-[#0B2027] mb-2">Are you new here?</h2>
                <p class="text-sm md:text-[16px] text-[#838383] mt-2">Please register your information so we can create an account
                    for you!!</p>

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- username -->
                    <div>
                        <label for="name" class="block font-semibold text-sm md:text-[16px] mb-1">Username</label>

                        <input id="name" type="text" name="name" :value="old('name')" required autofocus
                            placeholder="Enter your username"
                            class="w-full px-4 py-3 border border-gray-300 rounded-md text-sm md:text-[16px] focus:ring-2 focus:ring-[#090979] focus:outline-none">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block font-semibold text-sm md:text-[16px] mb-1">Email</label>

                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            placeholder="Enter your email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-md text-sm md:text-[16px] focus:ring-2 focus:ring-[#090979] focus:outline-none">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block font-semibold text-sm md:text-[16px] mb-1">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                placeholder="Enter your password"
                                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-md text-sm md:text-[16px] focus:ring-2 focus:ring-[#090979] focus:outline-none">

                            <!-- Button Toggle -->
                            <button type="button"
                                class="toggle-btn absolute right-3 top-1/2 -translate-y-1/2 text-gray-600">
                                <i class="bi bi-eye-fill text-xl toggle-icon"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <label for="password_confirmation" class="block font-semibold text-sm md:text-[16px] mb-1">Confirm
                            Password</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                placeholder="Confirm your password"
                                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-md text-sm md:text-[16px] focus:ring-2 focus:ring-[#090979] focus:outline-none">

                            <!-- Button Toggle -->
                            <button type="button"
                                class="toggle-btn absolute right-3 top-1/2 -translate-y-1/2 text-[#0B2027]">
                                <i class="bi bi-eye-fill text-xl toggle-icon"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="flex items-center justify-between text-xs md:text-[14px]">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="remember" class="accent-[#090979]">
                            <span class="text-[#838383]">Remember Me</span>
                        </label>
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}"
                                class="font-bold bg-gradient-to-r from-[#020024] via-[#090979] to-[#00D4FF] text-transparent bg-clip-text hover:underline">
                                Already Registered?
                            </a>
                        @endif
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full py-3 rounded-md font-bold text-sm md:text-[16px] text-white bg-[#1565C0] hover:bg-[#0d47a1] transition">
                        Create Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>