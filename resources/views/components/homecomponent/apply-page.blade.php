<section class="bg-[#f2f4f3] py-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

        <!-- Judul (hanya tampil di mobile di atas gambar) -->
        <div class="order-1 md:order-1 text-center md:text-left md:hidden">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#0B2027] font-['Montserrat']">
                Start Your Journey with
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#020027] via-[#090979] to-[#00D4FF]">
                    3cholars
                </span>
            </h2>
        </div>

        <!-- Gambar -->
        <div class="order-2 md:order-2 flex justify-center md:justify-end">
            <figure class="rounded-xl overflow-hidden shadow-lg bg-white max-w-lg md:max-w-xl">
                <img src="{{ asset('image/stanford1.jpg') }}" alt="Stanford" class="w-full h-auto object-cover">
                <figcaption class="text-center text-xs md:text-base italic text-[#0B2027] p-4 font-['Montserrat']">
                    “Study at top universities worldwide with full or partial scholarships.”
                </figcaption>
            </figure>
        </div>

        <!-- Deskripsi + Tombol (dan judul untuk desktop) -->
        <div class="order-3 md:order-1 flex flex-col justify-center text-center md:text-left space-y-6">
            <!-- Judul untuk desktop -->
            <h2 class="hidden md:block text-2xl md:text-3xl lg:text-4xl font-bold text-[#0B2027] font-['Montserrat']">
                Start Your Journey with
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#020027] via-[#090979] to-[#00D4FF]">
                    3cholars
                </span>
            </h2>

            <p class="text-[#838383] font-['Montserrat'] text-[14px] md:text-[16px] leading-relaxed">
                Discover scholarship opportunities designed to support your dreams.
                Whether you aim for global universities or local excellence,
                3cholars connects ambition with opportunity.
            </p>

            <div class="flex flex-wrap gap-3 md:gap-4 justify-center md:justify-start">
                @if(Auth::check())
                    <a href="{{ url('/dashboard') }}"
                        class="px-5 md:px-6 py-2 bg-[#1565c0] text-white rounded-lg shadow hover:bg-blue-800 transition text-[14px] sm:text-[16px]">
                        Apply Now
                    </a>
                    <a href="{{ url('/dashboard') }}"
                        class="px-5 md:px-6 py-2 border border-[#1565c0] text-[#1565c0] rounded-lg shadow hover:bg-[#1565c0] hover:text-[#f2f4f3] transition text-[14px] sm:text-[16px]">
                        Explore Scholarships
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="px-5 md:px-6 py-2 bg-[#1565c0] text-white rounded-lg shadow hover:bg-blue-800 transition text-[14px] sm:text-[16px]">
                        Apply Now
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-5 md:px-6 py-2 border border-[#0b2027] text-[#0B2027] rounded-lg shadow hover:bg-[#0b2027] hover:text-[#f2f4f3] transition text-[14px] sm:text-[16px]">
                        Explore Scholarships
                    </a>
                @endif
            </div>
        </div>

    </div>
</section>