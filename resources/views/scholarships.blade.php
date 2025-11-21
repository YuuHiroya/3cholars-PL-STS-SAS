<x-app-layout>
    <div class="min-h-screen bg-[#F2F3F4] font-['Montserrat'] text-[#0B2027] flex flex-col">

        {{-- HEADER --}}
        @include('profile.partials.header')

        <div class="flex flex-1 pt-20">

            {{-- SIDEBAR --}}
            @include('profile.partials.sidebar')

            {{-- MAIN CONTENT --}}
            <main class="flex-1 ml-64 p-10">

                {{-- SEARCH + FILTER BAR --}}
                <div class="flex items-center justify-between mb-10">

                    {{-- Search Box --}}
                    <div class="flex items-center bg-white border rounded-xl px-4 py-3 w-[500px]">
                        <iconify-icon icon="material-symbols:search-rounded" width="24"
                            class="text-[#838383]"></iconify-icon>
                        <input id="searchInput" type="text" placeholder="Search schools, locations..."
                            class="ml-3 w-full outline-none focus:outline-none border-0 focus:border-0 border-transparent focus:border-transparent ring-0 focus:ring-0" />
                    </div>

                    {{-- Right Buttons --}}
                    <div class="flex items-center gap-4">

                        {{-- Country Filter --}}
                        <select id="countryFilter"
                            class="bg-white border border-[#D1D1D1] rounded-xl pl-4 pr-10 py-3 text-[#0B2027] appearance-none relative">
                            <option value="">All Countries</option>
                            <option value="USA">USA</option>
                            <option value="UK">United Kingdom</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Germany">Germany</option>
                            <option value="Australia">Australia</option>
                        </select>

                        {{-- Filter Button --}}
                        <button class="bg-white border border-[#D1D1D1] rounded-xl px-4 py-3 flex items-center gap-2">
                            <iconify-icon icon="mingcute:filter-fill" width="20"></iconify-icon>
                            Filter
                        </button>

                        {{-- Grid/List View Toggle --}}
                        <button id="gridView"
                            class="scholarship-view-toggle bg-white border border-[#D1D1D1] rounded-xl w-12 h-12 flex items-center justify-center cursor-pointer hover:cursor-pointer transition-all"
                            data-view="grid" title="Grid View">
                            <iconify-icon icon="mdi:grid" width="24" class="view-icon text-[#0B2027]"></iconify-icon>
                        </button>

                        <button id="listView"
                            class="scholarship-view-toggle bg-white border border-[#D1D1D1] rounded-xl w-12 h-12 flex items-center justify-center cursor-pointer hover:cursor-pointer transition-all"
                            data-view="list" title="List View">
                            <iconify-icon icon="material-symbols:list" width="30"
                                class="view-icon text-[#0B2027]"></iconify-icon>
                        </button>
                    </div>
                </div>

                {{-- SCHOLARSHIP CONTAINER (Grid/List Layout) --}}
                <div id="scholarshipContainer" class="grid grid-cols-3 gap-8 scholarship-grid">
                    {{-- Tiles will be rendered here by JavaScript --}}
                </div>

            </main> 
        </div>
    </div>
    @vite(['resources/css/scholarships.css', 'resources/js/scholarships.js'])
</x-app-layout>