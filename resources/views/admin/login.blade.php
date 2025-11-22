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
                            class="text-3xl md:text-[36px] lg:text-[40px] text-[#0B2027] leading-tight flex items-start gap-1 -ml-4">
                            <!-- Segitiga -->
                            <span
                                class="mt-3 w-0 h-0 border-t-[12px] border-b-[12px] border-l-[18px] border-transparent border-l-[#1565c0]"></span>

                            <!-- Teks -->
                            <span class="font-medium -ml-6">
                                &nbsp;&nbsp;&nbsp;Admin <br> Portal for <br>
                                <span
                                    class=" font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#090979] to-[#00D4FF]">
                                    Secure <br> Administration <br> System!!
                                </span>
                            </span>
                        </h1>
                    </div>
                </div>
            </div>


            <!-- Right Section -->
            <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
                <h2 class="text-2xl md:text-3xl lg:text-[40px] font-bold text-[#0B2027] mb-2">Admin Login</h2>
                <p class="text-sm md:text-[16px] text-[#838383] mb-2">Enter your admin credentials to access the dashboard</p>

                <!-- Form -->
                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block font-semibold text-sm md:text-[16px] mb-1">Email</label>

                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="Enter your email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-md text-sm md:text-[16px] focus:ring-2 focus:ring-[#090979] focus:outline-none @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block font-semibold text-sm md:text-[16px] mb-1">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                placeholder="Enter your password"
                                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-md text-sm md:text-[16px] focus:ring-2 focus:ring-[#090979] focus:outline-none @error('password') border-red-500 @enderror">

                            <!-- Button Toggle -->
                            <button type="button"
                                class="toggle-btn absolute right-3 top-1/2 -translate-y-1/2 text-[#0B2027]">
                                <i class="bi bi-eye-fill text-xl toggle-icon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember -->
                    <div class="flex items-center justify-between text-xs md:text-[14px]">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="remember" class="accent-[#090979]">
                            <span class="text-[#838383]">Remember Me</span>
                        </label>
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full py-3 rounded-md font-bold text-sm md:text-[16px] text-white bg-[#1565C0] hover:bg-[#0d47a1] transition">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Toggle Password Script -->
    <script>
        document.querySelectorAll('.toggle-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.closest('.relative').querySelector('input');
                const icon = this.querySelector('.toggle-icon');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye-fill');
                    icon.classList.add('bi-eye-slash-fill');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash-fill');
                    icon.classList.add('bi-eye-fill');
                }
            });
        });
    </script>
</x-guest-layout>
