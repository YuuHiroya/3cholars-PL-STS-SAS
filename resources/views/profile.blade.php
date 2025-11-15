<x-app-layout>
    <div class="min-h-screen bg-[#F2F4F3] font-['Montserrat'] text-[#0B2027] flex flex-col">
        <!-- HEADER -->
        <header
            class="w-full h-20 flex justify-between items-center px-10 bg-white border-b shadow-sm fixed top-0 left-0 right-0 z-50">
            <div class="flex items-center gap-2 cursor-pointer" onclick="window.location.href='{{ url('/') }}'">
                <img src="{{ asset('image/Logo.png') }}" alt="Logo" class="w-8 h-8">
                <h1 class="text-lg font-bold text-[#1565C0]">3cholars</h1>
            </div>

            <!-- Klik nama atau foto untuk buka profile -->
            <div class="flex items-center gap-3 cursor-pointer"
                onclick="window.location.href='{{ route('profile.edit') }}'">
                <div class="text-sm font-medium">{{ Auth::user()->name ?? 'Guest' }}</div>
                <img src="{{ Auth::user()->profile_picture
    ? asset('storage/' . Auth::user()->profile_picture)
    : 'https://via.placeholder.com/40' }}" alt="Profile" class="w-10 h-10 rounded-full object-cover">
            </div>
        </header>

        <div class="flex flex-1 pt-20">
            <!-- SIDEBAR -->
            <aside class="w-64 bg-white shadow-md flex flex-col fixed top-20 left-0 h-[calc(100vh-5rem)]">
                <nav class="flex-1 px-4 py-6 space-y-3 text-[#696969] overflow-y-auto">
                    <a href="{{ url('/') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('/') ? 'bg-[#1565C0] text-white' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
                        <iconify-icon icon="fluent:home-16-regular" width="28" height="28"></iconify-icon>
                        Home
                    </a>
                    <a href="{{ url('dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('dashboard') ? 'bg-[#1565C0] text-white' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
                        <iconify-icon icon="material-symbols:dashboard-outline-rounded" width="28"
                            height="28"></iconify-icon>
                        Dashboard
                    </a>
                    <a href="{{ url('scholarships') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('scholarships') ? 'bg-[#1565C0] text-white' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
                        <iconify-icon icon="mdi:graduation-cap-outline" width="28" height="28"></iconify-icon>
                        Scholarships
                    </a>
                    <a href="{{ url('submissions') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('submissions') ? 'bg-[#1565C0] text-white' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
                        <iconify-icon icon="line-md:account" width="28" height="28"></iconify-icon>
                        Submissions
                    </a>
                    <a href="{{ url('form') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('form') ? 'bg-[#1565C0] text-white' : 'hover:bg-[#F2F4F3] hover:text-[#1565C0]' }}">
                        <iconify-icon icon="mdi:account-secure-outline" width="28" height="28"></iconify-icon>
                        Form
                    </a>
                </nav>
            </aside>

            <!-- MAIN -->
            <main class="flex-1 ml-64 p-10">
                <button onclick="window.history.back()"
                    class="flex items-center text-[#1565C0] text-sm mb-3 hover:underline">
                    <iconify-icon icon="mdi:arrow-left" width="18" height="18" class="mr-1"></iconify-icon>
                    Back to Previous Page
                </button>

                <h1 class="text-2xl font-semibold mb-1">My Profile</h1>
                <p class="text-[#838383] text-sm mb-6">Manage your personal information and track your scholarship
                    progress.</p>

                <div class="bg-white rounded-2xl shadow-sm p-8">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-6">
                            <!-- FOTO PROFIL -->
                            <div class="relative w-32 h-32">
                                <img id="profile-image"
                                    src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('image/profile-picture.png') }}"
                                    class="w-32 h-32 rounded-full object-cover border-4 border-[#D1D1D1]">

                                <label id="camera-label" for="profile-upload"
                                    class="absolute bottom-0 right-0 bg-[#1565C0] p-2 rounded-full cursor-pointer flex justify-center items-center hover:bg-blue-700 transition w-8 h-8 hidden">
                                    <iconify-icon icon="solar:camera-outline" class="text-white" width="18"
                                        height="18"></iconify-icon>
                                </label>

                                <input id="profile-upload" name="profile_picture" type="file" accept="image/*"
                                    class="hidden" onchange="previewProfile(event)">
                            </div>

                            <!-- INFO PROFIL -->
                            <form id="profile-form" action="{{ route('profile.update') }}" method="POST"
                                enctype="multipart/form-data" class="flex flex-col justify-center">
                                @csrf
                                @method('PATCH')

                                <div class="flex flex-col gap-1">
                                    <h2 id="name-display" class="text-xl font-semibold">
                                        {{ Auth::user()->name }}
                                    </h2>
                                    <input type="text" name="name" id="name-input"
                                        class="hidden bg-transparent border-b border-gray-300 focus:outline-none text-xl font-semibold"
                                        value="{{ Auth::user()->name }}">

                                    <div class="flex items-center text-[#838383]">
                                        <iconify-icon icon="material-symbols:mail-outline" width="20" height="20"
                                            class="mr-2"></iconify-icon>
                                        {{ Auth::user()->email }}
                                    </div>

                                    <div class="flex items-center text-[#838383]">
                                        <iconify-icon icon="mingcute:location-line" width="20" height="20"
                                            class="mr-2"></iconify-icon>
                                        Pontianak, Indonesia
                                    </div>

                                    <div class="flex items-center text-[#838383]">
                                        <iconify-icon icon="mdi:graduation-cap-outline" width="20" height="20"
                                            class="mr-2"></iconify-icon>
                                        <span id="major-display">
                                            {{ Auth::user()->major ?? 'Business Analyst - Bachelor’s' }}
                                        </span>
                                        <input type="text" name="major" id="major-input"
                                            class="hidden bg-transparent border-b border-gray-300 focus:outline-none text-[#838383]"
                                            value="{{ Auth::user()->major ?? 'Business Analyst - Bachelor’s' }}">
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 mt-4">
                                    <div
                                        class="bg-[#1565C0] text-white text-sm px-4 py-1 rounded-full flex items-center gap-2">
                                        <iconify-icon icon="material-symbols-light:star-outline" width="20"
                                            height="20"></iconify-icon>
                                        GPA: {{ Auth::user()->gpa ?? '4.0 / 4.0' }}
                                    </div>
                                    <div class="bg-[#EFEFEF] text-[#0B2027] text-sm px-4 py-1 rounded-full">
                                        ID: {{ Auth::user()->id + 1000 }}
                                    </div>
                                    <div class="bg-[#D6F2D3] text-[#1E980E] text-sm px-4 py-1 rounded-full">
                                        Scholarship Seeker
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- BUTTON EDIT -->
                        <div class="flex flex-col gap-3">
                            <button id="edit-btn"
                                class="bg-[#1565C0] text-white px-4 py-2 rounded-md hover:bg-blue-700 transition flex items-center gap-2">
                                <iconify-icon icon="cuida:edit-outline" width="20" height="20"></iconify-icon>
                                Edit Profile
                            </button>


                            <div class="hidden flex-col gap-2" id="action-buttons">
                                <button type="submit" form="profile-form"
                                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                                    Save Changes
                                </button>
                                <button id="cancel-btn"
                                    class="bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-500 transition">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- PROFILE DETAILS -->
                    <div class="mt-8 bg-[#FAFAFA] rounded-xl border border-[#D1D1D1] p-8">
                        <h2 class="text-xl font-semibold mb-6 text-[#0B2027]">Profile Details</h2>

                        <div class="grid grid-cols-2 gap-8">
                            <!-- PERSONAL INFORMATION -->
                            <div>
                                <div class="flex items-center gap-2 mb-4">
                                    <iconify-icon icon="icon-park-solid:people" width="32" height="32"
                                        class="text-[#1565C0]"></iconify-icon>
                                    <h3 class="text-lg font-semibold text-[#0B2027]">Personal Information</h3>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm text-[#838383]">Name</label>
                                        <p class="text-[#0B2027]">
                                            {{ Auth::user()->name }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">Email Address</label>
                                        <p class="text-[#0B2027]">{{ Auth::user()->email }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">Location</label>
                                        <p class="text-[#0B2027]" id="location-display">
                                            {{ Auth::user()->location ?? 'Pontianak, Indonesia' }}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">Student ID</label>
                                        <p class="text-[#0B2027]" id="studentid-display">
                                            {{ 1000 + Auth::user()->id }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- ACADEMIC INFORMATION -->
                            <div>
                                <div class="flex items-center gap-2 mb-4">
                                    <iconify-icon icon="tabler:book" width="28" height="28"
                                        class="text-[#1565C0]"></iconify-icon>
                                    <h3 class="text-lg font-semibold text-[#0B2027]">Academic Information</h3>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm text-[#838383]">Field of Study</label>
                                        <p class="text-[#0B2027]" id="field-display">
                                            {{ Auth::user()->field ?? 'Business Analyst' }}
                                        </p>
                                        <input type="text" name="field" id="field-input"
                                            class="hidden border-b border-[#D1D1D1] w-full focus:outline-none"
                                            value="{{ Auth::user()->field ?? 'Business Analyst' }}">
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">Education Information</label>
                                        <p class="text-[#0B2027]" id="education-display">
                                            {{ Auth::user()->education ?? "Bachelor's" }}
                                        </p>
                                        <input type="text" name="education" id="education-input"
                                            class="hidden border-b border-[#D1D1D1] w-full focus:outline-none"
                                            value="{{ Auth::user()->education ?? "Bachelor's" }}">
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">GPA</label>
                                        <p class="text-[#0B2027]" id="gpa-display">
                                            {{ Auth::user()->gpa ?? '4.0 / 4.0' }}
                                        </p>
                                        <input type="text" name="gpa" id="gpa-input"
                                            class="hidden border-b border-[#D1D1D1] w-full focus:outline-none"
                                            value="{{ Auth::user()->gpa ?? '4.0 / 4.0' }}">
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">Preferred Study Country</label>
                                        <div id="country-display" class="flex gap-2 mt-1">
                                            <span
                                                class="bg-[#1565C0] text-white text-sm px-4 py-1 rounded-full">Germany</span>
                                            <span
                                                class="bg-[#1565C0] text-white text-sm px-4 py-1 rounded-full">Finland</span>
                                        </div>
                                        <input type="text" name="preferred_country" id="country-input"
                                            class="hidden border-b border-[#D1D1D1] w-full focus:outline-none"
                                            value="Germany, Finland">
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">About Me</label>
                                        <p class="text-[#0B2027]" id="about-display">
                                            {{ Auth::user()->about ?? "Passionate computer science student with a focus on artificial intelligence and machine learning. Currently pursuing my Bachelor's degree and actively seeking international scholarship opportunities to further my education in Europe." }}
                                        </p>
                                        <textarea name="about" id="about-input" rows="4"
                                            class="hidden border border-[#D1D1D1] rounded-md w-full focus:outline-none p-2">{{ Auth::user()->about ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>