<x-app-layout>
    <div class="min-h-screen bg-[#F2F4F3] font-['Montserrat'] text-[#0B2027] flex flex-col">
        <!-- Header -->
        @include('profile.partials.header')
        <div class="flex flex-1 pt-20">
            <!-- Sidebar -->
            @include('profile.partials.sidebar')
        </div>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-10">
            <div class="bg-[#FAFAFA] rounded-2xl p-8 flex items-center justify-between shadow-sm mb-8">
                <div>
                    <h2 class="text-2xl font-semibold mb-2">Hello, {{ Auth::user()->username}}</h2>
                    <p class="text-[#696969] mb-4">Welcome back! Let’s continue your journey toward scholarships and new
                        opportunities.</p>
                    <button onclick="window.location.href='{{ route('profile.edit', ['from' => url()->current()]) }}'"
                        class="bg-[#1565C0] text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        View Profile
                    </button>
                </div>
                <img src="{{ asset('image/Image Cewe.png') }}" alt="Student Illustration" class="w-56">
            </div>

            <!-- Recommended Campus -->
            <div class="bg-[#FAFAFA] rounded-2xl p-8 shadow-sm">
                <h3 class="text-xl font-semibold mb-2">Top Recommended Campus</h3>
                <p class="text-[#696969] mb-6">
                    Discover universities that match your goals and scholarship opportunities.
                </p>

                <div class="grid grid-cols-4 gap-6">

                    <!-- UI -->
                    <a href="#" class="block bg-white rounded-xl shadow p-4 text-center 
                    hover:shadow-lg hover:-translate-y-1 transition-transform">
                        <img src="{{ asset('image/Logo UI.jpg') }}" alt="UI" class="w-36 mx-auto mb-3">
                        <h4 class="font-semibold">Universitas Indonesia</h4>
                        <p class="text-[#696969] text-sm">
                            Excellence in research and innovation for global leaders.
                        </p>
                    </a>

                    <!-- NTU -->
                    <a href="#" class="block bg-white rounded-xl shadow p-4 text-center 
                    hover:shadow-lg hover:-translate-y-1 transition-transform">
                        <img src="{{ asset('image/Logo Nanyang.png') }}" alt="NTU" class="w-36 mx-auto mb-3">
                        <h4 class="font-semibold">Nanyang Technological University (NTU)</h4>
                        <p class="text-[#696969] text-sm">
                            Shaping the future with cutting-edge technology and education.
                        </p>
                    </a>

                    <!-- UGM -->
                    <a href="#" class="block bg-white rounded-xl shadow p-4 text-center 
                    hover:shadow-lg hover:-translate-y-1 transition-transform">
                        <img src="{{ asset('image/UGM.jpg') }}" alt="UGM" class="w-36 mx-auto mb-3">
                        <h4 class="font-semibold">Universitas Gadjah Mada (UGM)</h4>
                        <p class="text-[#696969] text-sm">
                            Empowering communities with knowledge and culture.
                        </p>
                    </a>

                    <!-- Peking University -->
                    <a href="#" class="block bg-white rounded-xl shadow p-4 text-center 
                    hover:shadow-lg hover:-translate-y-1 transition-transform">
                        <img src="{{ asset('image/Logo Peking.png') }}" alt="Peking" class="w-36 mx-auto mb-3">
                        <h4 class="font-semibold">Peking University</h4>
                        <p class="text-[#696969] text-sm">
                            China’s top university for excellence in culture, science, and innovation.
                        </p>
                    </a>

                </div>

                <div class="mt-6 text-center">
                    <a href="scholarships" class="text-[#1565C0] font-medium hover:underline">
                        Lihat selengkapnya →
                    </a>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>