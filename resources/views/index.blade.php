<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Alex+Brush&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="min-h-screen flex flex-col bg-[#F2F4F3] font-[Montserrat]">

    <!-- Background Video -->
    <video id="bg-video" autoplay muted playsinline class="absolute inset-0 w-full h-full object-cover -z-10">
        <source src="{{ asset('image/Oxfordwak.mp4') }}" type="video/mp4">
    </video>

    {{-- Redirect otomatis kalau sudah login --}}
    @if (Auth::check())
        <script>
            window.location.href = "{{ url('/dashboard') }}";
        </script>
    @endif

    <!-- Navbar -->
    <x-homecomponent.navbar />

    <!-- Hero Section -->
    <section class="relative" style="height: 100vh;">
        <div class="flex flex-col justify-end items-center text-center h-full px-4 pb-9">
            <h1 class="text-2xl md:text-[36px] lg:text-[48px] text-[#f2f4f3] leading-tight">
                Legacies Forged in
                <span
                    class="font-normal text-[52px] md:text-[70px] text-transparent bg-clip-text bg-gradient-to-r from-[#020024] via-[#090979] to-[#00D4FF] font-['Alex_Brush']">
                    Learning.
                </span>
            </h1>
            <p class="text-[#f2f4f3] font-normal text-xs md:text-[18px]">
                3cholars ignites pathways to wisdom.<br>
                Where ambition meets opportunity, knowledge becomes legacy.
            </p>
        </div>
    </section>

    <!-- Apply Scholarship -->
    <x-homecomponent.apply-page />

    <!-- FAQ Section -->
    <x-homecomponent.faq-section />

    <!-- Motivation Section -->
    <x-homecomponent.motivational />

    <!-- Information Card -->
    <x-homecomponent.infocard />

    <!-- Footer -->
    <footer
        class="relative bg-gradient-to-br from-blue-600 to-blue-900 text-[#FAFAFA] font-['Montserrat'] overflow-hidden">
        {{-- Floating Shapes --}}
        <div class="absolute w-20 h-20 bg-[#FAFAFA]/10 rounded-full animate-float top-[10%] right-[10%]"></div>
        <div class="absolute w-32 h-32 bg-[#FAFAFA]/10 rounded-full animate-float bottom-[20%] right-[5%] delay-2000">
        </div>
        <div class="absolute w-16 h-16 bg-[#FAFAFA]/10 rounded-full animate-float top-1/2 right-[20%] delay-4000">
        </div>

        <div class="relative z-10 container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-8">
                {{-- Brand --}}
                <div>
                    <div class="flex items-center mb-6">
                        <img src="{{ asset('image/Logo.png') }}" alt="3cholars Logo"
                            class="w-16 h-16 md:w-20 md:h-20 object-contain mr-4 animate-logo-glow">
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#FAFAFA]">3CHOLARS.</h2>
                    </div>

                    <p class="text-[#FAFAFA]/80 mb-6 leading-relaxed text-sm md:text-[20px] lg:text-lg">
                        3cholars serves as a trusted gateway to scholarships and academic opportunities,
                        guiding ambitious students toward global education with clarity and purpose.
                    </p>

                    {{-- Social --}}
                    <div class="flex space-x-4">
                        <a href="#" target="_blank" rel="noopener"
                            class="social-icon w-10 md:w-12 h-10 md:h-12 bg-[#FAFAFA]/20 rounded-full flex items-center justify-center hover:bg-[#FAFAFA]/30 transition transform hover:-translate-y-1 hover:scale-110 shadow-md">
                            <i class="bi bi-instagram text-lg md:text-2xl"></i>
                        </a>
                        <a href="#" target="_blank" rel="noopener"
                            class="social-icon w-10 md:w-12 h-10 md:h-12 bg-[#FAFAFA]/20 rounded-full flex items-center justify-center hover:bg-[#FAFAFA]/30 transition transform hover:-translate-y-1 hover:scale-110 shadow-md">
                            <i class="bi bi-facebook text-xl md:text-2xl"></i>
                        </a>
                        <a href="tel:+6289514941001" target="_blank" rel="noopener"
                            class="social-icon w-10 md:w-12 h-10 md:h-12 bg-[#FAFAFA]/20 rounded-full flex items-center justify-center hover:bg-[#FAFAFA]/30 transition transform hover:-translate-y-1 hover:scale-110 shadow-md">
                            <i class="bi bi-whatsapp text-xl md:text-2xl"></i>
                        </a>
                        <a href="#" target="_blank" rel="noopener"
                            class="social-icon w-10 md:w-12 h-10 md:h-12 bg-[#FAFAFA]/20 rounded-full flex items-center justify-center hover:bg-[#FAFAFA]/30 transition transform hover:-translate-y-1 hover:scale-110 shadow-md">
                            <i class="bi bi-tiktok text-xl md:text-2xl"></i>
                        </a>
                    </div>
                </div>

                {{-- Links --}}
                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg md:text-xl font-semibold mb-4 md:mb-6">Information</h3>
                        <ul class="space-y-3 ">
                            <li><a href="#" class="footer-link inline-block">Scholarship Listings</a></li>
                            <li><a href="#" class="footer-link inline-block">Application Guide</a></li>
                            <li><a href="#" class="footer-link inline-block">Scholarship Insights</a></li>
                            <li><a href="#" class="footer-link inline-block">FAQs</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg md:text-xl font-semibold mb-4 md:mb-6">Company</h3>
                        <ul class="space-y-3">
                            <li><a href="#" class="footer-link inline-block">About Us</a></li>
                            <li><a href="#" class="footer-link inline-block">Terms &amp; Conditions</a></li>
                            <li><a href="#" class="footer-link inline-block">Privacy Policy</a></li>
                            <li><a href="#" class="footer-link inline-block">Affiliation</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg md:text-xl font-semibold mb-4 md:mb-6">Contact</h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="mailto:info@3cholars.com"
                                    class="contact-link block hover:text-[#71ABED] transition-colors">
                                    <span class="text-sm text-[#FAFAFA]/70">Email</span><br>
                                    lionellcons2@gmail.com
                                </a>
                            </li>
                            <li>
                                <a href="tel:+6289514941001"
                                    class="contact-link block hover:text-[#71ABED] transition-colors">
                                    <span class="text-sm text-[#FAFAFA]/70">Phone</span><br>
                                    +62 895-1494-1001
                                </a>
                            </li>
                            <li>
                                <span class="text-sm text-[#FAFAFA]/70">Address</span><br>
                                Pontianak, Indonesia
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Bottom --}}
            <div class="border-t border-[#FAFAFA]/20 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="flex items-center text-sm text-[#FAFAFA]/70">
                        <i class="bi bi-c-circle mr-2"></i>
                        <span> 3cholars. All Rights Reserved.</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-[#FAFAFA]/70">
                        <span>Crafted with love for the future of education</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>