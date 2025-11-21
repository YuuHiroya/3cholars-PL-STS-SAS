<x-app-layout>
    <div class="min-h-screen bg-[#F2F4F3] font-['Montserrat'] text-[#0B2027] flex flex-col">
        <!-- HEADER -->
        @include('profile.partials.header')
        <div class="flex flex-1 pt-20">
            <!-- SIDEBAR -->
            @include('profile.partials.sidebar')

            <!-- MAIN -->
            <main class="flex-1 ml-64 p-10">
                <a href="{{ request('from') ?? url('/') }}"
                    class="flex items-center text-[#1565C0] text-sm mb-3 hover:underline">
                    <iconify-icon icon="mdi:arrow-left" width="18" height="18" class="mr-1"></iconify-icon>
                    Back to Previous Page
                </a>

                <h1 class="text-2xl font-semibold mb-1">My Profile</h1>
                <p class="text-[#838383] text-sm mb-6">Manage your personal information and track your scholarship
                    progress.
                </p>

                <div class="bg-white rounded-2xl shadow-sm p-8">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center gap-6">
                            <!-- FOTO PROFIL -->
                            <div class="relative w-32 h-32">
                                <img id="profile-image"
                                    src="{{ Auth::user()?->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('image/profile-picture.png') }}"
                                    class="w-32 h-32 rounded-full object-cover border-4 border-[#1565C0]">

                                <label id="camera-label" for="profile-upload"
                                    class="absolute bottom-0 right-0 bg-[#1565C0] p-2 rounded-full cursor-pointer flex justify-center items-center hover:bg-blue-700 transition w-8 h-8 hidden">
                                    <iconify-icon icon="solar:camera-outline" class="text-white" width="18"
                                        height="18"></iconify-icon>
                                </label>
                            </div>

                            <!-- INFO PROFIL -->
                            <form id="profile-form" action="{{ route('profile.update') }}" method="POST"
                                enctype="multipart/form-data" class="flex flex-col justify-center">
                                @csrf
                                @method('PATCH')

                                <input id="profile-upload" name="profile_picture" type="file" accept="image/*"
                                    class="hidden">

                                <!-- Hidden inputs for academic information -->
                                <input type="hidden" name="username" id="username-hidden"
                                    value="{{ Auth::user()?->username ?? '' }}">
                                <input type="hidden" name="field" id="field-input"
                                    value="{{ Auth::user()?->field ?? '-' }}">
                                <input type="hidden" name="education" id="education-input"
                                    value="{{ Auth::user()?->education ?? "-" }}">
                                <input type="hidden" name="gpa" id="gpa-input" value="{{ Auth::user()?->gpa ?? '-' }}">
                                <input type="hidden" name="location" id="location-input"
                                    value="{{ Auth::user()?->location ?? 'Pontianak, Indonesia' }}">
                                <input type="hidden" name="preferred_country" id="country-hidden"
                                    value="{{ Auth::user()?->preferred_country ?? '-' }}">
                                <textarea name="about" id="about-hidden"
                                    style="display: none;">{{ Auth::user()?->about ?? '' }}</textarea>

                                <div class="flex flex-col gap-1">
                                    <h2 id="name-display" class="text-xl font-semibold editable-display">
                                        {{ Auth::user()?->username}}
                                    </h2>
                                    <input type="text" name="username" id="name-input"
                                        class="editable-input hidden bg-transparent border-b border-gray-300 focus:outline-none text-xl font-semibold"
                                        value="{{ Auth::user()?->username}}">

                                    <div class="flex items-center text-[#838383]">
                                        <iconify-icon icon="material-symbols:mail-outline" width="20" height="20"
                                            class="mr-2"></iconify-icon>
                                        {{ Auth::user()?->email}}
                                    </div>

                                    <div class="flex items-center text-[#838383]">
                                        <iconify-icon icon="mingcute:location-line" width="20" height="20"
                                            class="mr-2"></iconify-icon>
                                        {{ Auth::user()?->location ?? 'Pontianak, Indonesia' }}
                                    </div>

                                    <div class="flex items-center text-[#838383]">
                                        <iconify-icon icon="mdi:graduation-cap-outline" width="20" height="20"
                                            class="mr-2"></iconify-icon>
                                        {{ Auth::user()?->field ?? '-' }} - {{ Auth::user()?->education ?? '-' }}
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 mt-4">
                                    <div
                                        class="bg-[#1565C0] text-white text-sm px-4 py-1 rounded-full flex items-center gap-2">
                                        <iconify-icon icon="material-symbols-light:star-outline" width="20"
                                            height="20"></iconify-icon>
                                        GPA: {{ Auth::user()?->gpa ?? '-' }}
                                    </div>
                                    <div class="bg-[#EFEFEF] text-[#0B2027] text-sm px-4 py-1 rounded-full">
                                        ID: {{ (Auth::user()?->id ?? 0) + 1000 }}
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
                                            {{ Auth::user()?->username}}
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">Email Address</label>
                                        <p class="text-[#0B2027]">{{ Auth::user()?->email ?? 'No email' }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">Location</label>
                                        <p class="text-[#0B2027] editable-display" id="location-display">
                                            {{ Auth::user()?->location ?? 'Pontianak, Indonesia' }}
                                        </p>
                                        <input type="text"
                                            class="editable-input hidden border-b border-[#D1D1D1] w-full focus:outline-none location-input"
                                            value="{{ Auth::user()?->location ?? 'Pontianak, Indonesia' }}">
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">Student ID</label>
                                        <p class="text-[#0B2027] editable-display" id="studentid-display">
                                            {{ 1000 + (Auth::user()?->id ?? 0) }}
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
                                        <p class="text-[#0B2027] editable-display" id="field-display">
                                            {{ Auth::user()?->field ?? '-' }}
                                        </p>
                                        <input type="text"
                                            class="editable-input hidden border-b border-[#D1D1D1] w-full focus:outline-none field-input"
                                            value="{{ Auth::user()?->field ?? '-' }}">
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">Education Information</label>
                                        <p class="text-[#0B2027] editable-display" id="education-display">
                                            {{ Auth::user()?->education ?? "-" }}
                                        </p>
                                        <input type="text"
                                            class="editable-input hidden border-b border-[#D1D1D1] w-full focus:outline-none education-input"
                                            value="{{ Auth::user()?->education ?? "-" }}">
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">GPA</label>
                                        <p class="text-[#0B2027] editable-display" id="gpa-display">
                                            {{ Auth::user()?->gpa ?? '-' }}
                                        </p>
                                        <input type="text"
                                            class="editable-input hidden border-b border-[#D1D1D1] w-full focus:outline-none gpa-input"
                                            value="{{ Auth::user()?->gpa ?? '-' }}">
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">Preferred Study Country</label>

                                        <!-- Display chips (shows existing countries from database) -->
                                        <!-- NOTE: Does NOT have editable-display class so it stays visible in edit mode -->
                                        <div id="country-display" class="flex gap-2 mt-1 flex-wrap">
                                            @php
                                                $countryValue = Auth::user()?->preferred_country ?? '-';
                                                $countries = ($countryValue && $countryValue !== '-')
                                                    ? array_filter(array_map('trim', explode(',', $countryValue)))
                                                    : [];
                                            @endphp

                                            @if(count($countries) > 0)
                                                @foreach ($countries as $c)
                                                    <span class="bg-[#1565C0] text-white text-sm px-4 py-1 rounded-full">
                                                        {{ $c }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <p class="text-[#838383] text-sm italic">No countries selected yet</p>
                                            @endif
                                        </div>

                                        <!-- Input box for adding new countries (hidden by default, shows in edit mode) -->
                                        <input type="text" id="country-input-box"
                                            class="editable-input hidden border-b border-[#D1D1D1] w-full focus:outline-none mt-2"
                                            placeholder="Type a country and press Enter">
                                    </div>

                                    <div>
                                        <label class="block text-sm text-[#838383]">About Me</label>
                                        <p class="text-[#0B2027] editable-display" id="about-display">
                                            {{ Auth::user()?->about ?? "-" }}
                                        </p>
                                        <textarea id="about-input" rows="4"
                                            class="editable-input hidden border border-[#D1D1D1] rounded-md w-full focus:outline-none p-2 about-input">{{ Auth::user()?->about ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- MY SAVED SCHOLARSHIPS -->
                    <div class="mt-10 bg-white rounded-2xl shadow-sm p-8 border border-[#D1D1D1]">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <iconify-icon icon="icon-park-outline:like" width="32" height="32"
                                    class="text-[#1565C0]"></iconify-icon>
                                <h2 class="text-xl font-semibold text-[#0B2027]">My Saved Scholarships</h2>
                                <span
                                    class="bg-[#1565C0] text-white text-sm px-3 py-1 rounded-full">{{ count($saved ?? []) }}</span>
                            </div>
                        </div>

                        @if(isset($saved) && count($saved) > 0)
                            <div class="mt-10 bg-white rounded-2xl shadow-sm p-8 border border-[#D1D1D1]">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center gap-3">
                                        <iconify-icon icon="icon-park-outline:like" width="32" height="32"
                                            class="text-[#1565C0]"></iconify-icon>
                                        <h2 class="text-xl font-semibold text-[#0B2027]">My Saved Scholarships</h2>
                                        <span
                                            class="bg-[#1565C0] text-white text-sm px-3 py-1 rounded-full">{{ count($saved) }}</span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-6">
                                    @foreach($saved as $index => $item)
                                        <div
                                            class="bg-[#FAFAFA] rounded-xl border border-[#D1D1D1] p-6 {{ ($loop->last && count($saved) == 3) ? 'col-span-2' : '' }}">
                                            <img src="{{ $item['image'] }}" class="w-full h-40 rounded-lg object-cover mb-4" />

                                            <h3 class="text-lg font-semibold text-[#0B2027]">{{ $item['title'] }}</h3>
                                            <p class="text-sm text-[#1565C0] mb-2">{{ $item['university'] }}</p>

                                            <div class="space-y-1 text-sm text-[#0B2027]">
                                                <div class="flex items-center gap-2">
                                                    <iconify-icon icon="mingcute:calendar-line" width="20"
                                                        height="20"></iconify-icon>
                                                    <span>{{ $item['deadline'] }}</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <iconify-icon icon="mynaui:dollar" width="20" height="20"></iconify-icon>
                                                    <span>{{ $item['funding'] }}</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <iconify-icon icon="tabler:book" width="20" height="20"></iconify-icon>
                                                    <span>{{ $item['location'] }}</span>
                                                </div>
                                            </div>

                                            <div class="flex justify-between mt-4">
                                                <button class="px-4 py-2 bg-[#EFEFEF] text-[#0B2027] rounded-md">More
                                                    Details</button>
                                                <button
                                                    class="px-4 py-2 bg-[#1565C0] text-white rounded-md flex items-center gap-2">
                                                    <iconify-icon icon="icon-park-outline:share" width="20"
                                                        height="20"></iconify-icon>
                                                    Apply Now
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>