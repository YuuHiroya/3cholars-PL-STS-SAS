<x-app-layout>
    <div class="min-h-screen bg-[#F2F4F3] font-['Montserrat'] text-[#0B2027] flex flex-col">
        <!-- Header (Full Width) -->
        <header
            class="w-full h-20 flex justify-between items-center px-10 bg-white border-b shadow-sm fixed top-0 left-0 right-0 z-50">
            <!-- Logo and Title -->
            <div class="flex items-center gap-2 cursor-pointer" onclick="window.location.href='{{ url('/') }}'">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="w-8 h-8">
                <h1 class="text-lg font-bold text-[#1565C0]">3cholars</h1>
            </div>

            <!-- User Profile -->
            <div class="flex items-center gap-3">
                <div class="text-sm font-medium">Monica Ernestine</div>
                <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
            </div>
        </header>

        <div class="flex flex-1 pt-20">
            <!-- Sidebar sejajar dengan header -->
            <aside class="w-64 bg-white shadow-md flex flex-col fixed top-20 left-0 h-[calc(100vh-5rem)]">
                <nav class="flex-1 px-4 py-6 space-y-3 text-[#696969] overflow-y-auto">
                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('dashboard') ? 'bg-[#1565C0] text-white' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
                        <iconify-icon icon="material-symbols:dashboard-outline-rounded" style="color:#838383;"
                            width="28" height="28"></iconify-icon>
                        Dashboard
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#F2F4F3] hover:text-[#1565C0]">
                        <iconify-icon icon="mdi:graduation-cap-outline" style="color:#838383;" width="28"
                            height="28"></iconify-icon>
                        Scholarships
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#F2F4F3] hover:text-[#1565C0]">
                        <iconify-icon icon="line-md:account" style="color:#838383;" width="28"
                            height="28"></iconify-icon>
                        Submissions
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-[#F2F4F3] hover:text-[#1565C0]">
                        <iconify-icon icon="mdi:account-secure-outline" style="color:#838383;" width="28"
                            height="28"></iconify-icon>
                        Form
                    </a>
                </nav>
            </aside>
        </div>


        <!-- Main Content -->
        <main class="flex-1 ml-64 p-10">
            <!-- Welcome Card -->
            <div class="bg-[#FAFAFA] rounded-2xl p-8 flex items-center justify-between shadow-sm mb-8">
                <div>
                    <h2 class="text-2xl font-semibold mb-2">Hello, Monica Ernestine</h2>
                    <p class="text-[#696969] mb-4">Welcome back! Let’s continue your journey toward scholarships and
                        new opportunities.</p>
                    <button class="bg-[#1565C0] text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">View
                        Profile</button>
                </div>
                <img src="{{ asset('image/Image Cewe.png') }}" alt="Student Illustration" class="w-56">
            </div>

            <!-- Recommended Campus -->
            <div class="bg-[#FAFAFA] rounded-2xl p-8 shadow-sm">
                <h3 class="text-xl font-semibold mb-2">Top Recommended Campus</h3>
                <p class="text-[#696969] mb-6">Discover universities that match your goals and scholarship
                    opportunities.</p>

                <div class="grid grid-cols-4 gap-6">
                    <div class="bg-white rounded-xl shadow p-4 text-center">
                        <img src="{{ asset('image/Logo UI.jpg') }}" alt="UI" class="w-36 mx-auto mb-3">
                        <h4 class="font-semibold">Universitas Indonesia</h4>
                        <p class="text-[#696969] text-sm">Excellence in research and innovation for global leaders.
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow p-4 text-center">
                        <img src="{{ asset('image/Logo Nanyang.png') }}" alt="NTU" class="w-36 mx-auto mb-3">
                        <h4 class="font-semibold">Nanyang Technological University (NTU)</h4>
                        <p class="text-[#696969] text-sm">Shaping the future with cutting-edge technology and
                            education.</p>
                    </div>

                    <div class="bg-white rounded-xl shadow p-4 text-center">
                        <img src="{{ asset('image/UGM.jpg') }}" alt="UGM" class="w-36 mx-auto mb-3">
                        <h4 class="font-semibold">Universitas Gadjah Mada (UGM)</h4>
                        <p class="text-[#696969] text-sm">Empowering communities with knowledge and culture.</p>
                    </div>

                    <div class="bg-white rounded-xl shadow p-4 text-center">
                        <img src="{{ asset('image/Logo Peking.png') }}" alt="Peking" class="w-36 mx-auto mb-3">
                        <h4 class="font-semibold">Peking University</h4>
                        <p class="text-[#696969] text-sm">China’s top university for excellence in culture, science,
                            and innovation.</p>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <a href="#" class="text-[#1565C0] font-medium hover:underline">Lihat selengkapnya →</a>
                </div>
            </div>
        </main>
    </div>
    </div>
</x-app-layout>