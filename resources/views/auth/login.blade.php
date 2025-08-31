<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#F2F4F3] font-[Montserrat]">
        <div class="w-11/12 md:w-4/5 lg:w-3/4 bg-white shadow-lg rounded-lg flex flex-col md:flex-row overflow-hidden">

            <!-- Left Section -->
            <div class="w-full md:w-1/2 relative">
                <!-- Background image -->
                <img src="{{ asset('image/bg1.jpeg') }}" alt="Background" class="w-full h-full object-cover">

                <!-- Rectangle transparan -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="bg-[#F2F4F3]/80 px-14 py-16 max-w-xl text-left relative">

                        <!-- Title dengan segitiga -->
                        <h1
                            class="text-[32px] md:text-[36px] lg:text-[40px] text-[#0B2027] leading-tight flex items-start gap-1 -ml-4">
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
                <h2 class="text-[40px] font-bold text-[#0B2027] mb-2">Hey, Hello!</h2>
                <p class="text-[16px] text-[#838383] mb-6">Enter the information you entered while registrating</p>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <p class="font-semibold font-size: 20px">Email</p>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            placeholder=""
                            class="w-full px-4 py-3 border border-gray-300 rounded-md text-[16px] focus:ring-2 focus:ring-[#090979] focus:outline-none">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block font-semibold text-[20px] mb-1">Password</label>

                        <div class="relative">
                            <input id="password" type="password" name="password" required placeholder=""
                                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-md text-[16px] focus:ring-2 focus:ring-[#090979] focus:outline-none">

                            <!-- Tombol toggle password -->
                            <button type="button" id="togglePasswordBtn"
                                class="absolute right-3 top-1/2 -translate-y-1/2">
                                <img id="toggleIcon" src="{{ asset('image/hidden.png') }}" class="h-6 w-6">
                            </button>
                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="flex items-center justify-between text-[14px]">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="remember" class="accent-[#090979]">
                            <span class="text-[#838383]">Remember Me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="font-bold bg-gradient-to-r from-[#020024] via-[#090979] to-[#00D4FF] text-transparent bg-clip-text hover:underline">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full py-3 rounded-md font-bold text-[16px] text-white bg-[#1565C0] hover:bg-[#0d47a1] transition">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>