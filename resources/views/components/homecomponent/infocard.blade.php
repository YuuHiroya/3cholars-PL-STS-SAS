<section class="min-h-screen bg-[#f2f4f3] px-6 py-12 font-['Montserrat']">
    <!-- Main Card -->
    <div id="main-card"
        class="bg-[#FAFAFA] rounded-2xl shadow-md flex flex-col md:flex-row p-6 gap-6 items-start md:items-stretch transition-all duration-300"
        data-title="Facts you maybe didn't knew"
        data-description="In several European countries such as Germany, Finland, and Norway, higher education is completely tuition-free—not only for domestic students but also for international students. This means that whether you are pursuing a Bachelor's, Master's, or even a PhD, you typically do not pay tuition fees. As a result, students from all over the world flock to these destinations, making them some of the most diverse and internationally connected education systems on the planet."
        data-img="image/royalbuilding.jpg" data-tags="Culture, Education, Europe"
        data-links='[{"text":"Guide to Studying in Europe","url":"#"},{"text":"Explore Tuition-Free Countries","url":"#"},{"text":"Universities in Germany","url":"#"}]'>
        <!-- Konten -->
        <div class="flex-1 flex flex-col gap-4 justify-between">
            <div class="flex items-center justify-between">
                <div class="flex gap-4 text-[#0b2027] text-xl">
                    <i id="share-btn" class="bi bi-share cursor-pointer"></i>
                    <i id="bookmark-btn" class="bi bi-bookmark cursor-pointer"></i>
                </div>
            </div>

            <h2 id="main-card-title" class="text-xl md:text-2xl font-bold leading-snug text-[#0b2027]">
                Facts you maybe didn't knew
            </h2>

            <div id="main-card-tags" class="flex flex-wrap gap-2 tags-container"></div>

            <p id="main-card-desc" class="text-[#0b2027] text-xs md:text-base leading-relaxed main-desc flex-1">
                In several European countries such as Germany, Finland, and Norway, higher education is completely
                tuition-free—not only for domestic students but also for international students. This means that
                whether you are pursuing a Bachelor's, Master's, or even a PhD, you typically do not pay tuition
                fees. As a result, students from all over the world flock to these destinations, making them some of
                the most diverse and internationally connected education systems on the planet.
            </p>

            <hr class="border-t border-[#838383]" />

            <div id="main-card-links" class="flex flex-col gap-2 text-sm mt-2 links-container"></div>
        </div>

        <!-- Gambar -->
        <div class="flex-shrink-0 w-full md:w-1/2">
            <img id="main-card-img" src="image/royalbuilding.jpg" alt="Royal Building"
                class="rounded-xl w-full h-full object-cover shadow-md" />
        </div>
    </div>

    <!-- Related Information -->
    <div class="mt-12">
        <div class="text-center">
            <h3 class="text-xl md:text-2xl font-bold text-[#0b2027] inline-block relative">
                Related Information
                <span
                    class="block w-1/2 h-1 mx-auto mt-2 mb-8 bg-gradient-to-r from-[#020027] via-[#090979] to-[#00D4FF] rounded"></span>
            </h3>
        </div>

        <!-- Related Cards -->
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="related-card cursor-pointer bg-[#f2f4f3] rounded-xl shadow-md overflow-hidden transition hover:shadow-lg"
                data-title="Scholarship Opportunities Worldwide"
                data-description="Many universities and governments worldwide provide a variety of scholarships. These range from merit-based awards for high-achieving students, to need-based grants for those from low-income families. Some programs also prioritize leadership, community involvement, or research potential, giving students multiple pathways to financial support."
                data-img="{{ asset('image/scholarship.jpg') }}" data-tags="Scholarships, Global, Funding"
                data-links='[{"text":"Find Scholarships in Canada","url":"#"},{"text":"Full-Ride vs Partial Scholarships","url":"#"},{"text":"Government-Funded Programs","url":"#"}]'>
                <img src="{{ asset('image/scholarship.jpg') }}" alt="Scholarship" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="font-bold text-[#0b2027] text-sm md:text-md">Scholarship Opportunities Worldwide</h4>
                    <p class="text-xs md:text-sm text-[#0b2027] mt-2 line-clamp-3">Many universities and governments worldwide
                        provide a variety of scholarships. These range from merit-based awards for high-achieving
                        students, to need-based grants for those from low-income families. Some programs also
                        prioritize leadership, community involvement, or research potential, giving students
                        multiple pathways to financial support.</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="related-card cursor-pointer bg-[#f2f4f3] rounded-xl shadow-md overflow-hidden transition hover:shadow-lg"
                data-title="Global Education Rankings" data-description="International university rankings, such as
                            QS and Times Higher Education, evaluate institutions using criteria like research impact,
                            teaching quality, employability, and international collaboration. Rankings often influence
                            where students choose to study and help universities measure their global competitiveness in
                            education and innovation." data-img="{{ asset('image/edurank.jpg') }}"
                data-tags="Education, Rankings, Global Index"
                data-links='[{"text":"Top 50 Universities Guide","url":"#"},{"text":"Impact of Rankings on Careers","url":"#"},{"text":"Asian Education Success","url":"#"}]'>
                <img src="{{ asset('image/edurank.jpg') }}" alt="Education Rank" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="font-bold text-[#0b2027] text-sm md:text-md">Global Education Rankings</h4>
                    <p class="text-xs md:text-sm text-[#0b2027] mt-2 line-clamp-3">International university rankings, such as
                        QS and Times Higher Education, evaluate institutions using criteria like research impact,
                        teaching quality, employability, and international collaboration. Rankings often influence
                        where students choose to study and help universities measure their global competitiveness in
                        education and innovation.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="related-card cursor-pointer bg-[#f2f4f3] rounded-xl shadow-md overflow-hidden transition hover:shadow-lg"
                data-title="Top Scholarships in Asia"
                data-description="Asia is becoming a major destination for international education, offering thousands of scholarships every year. Programs like Japan’s MEXT, South Korea’s Global Scholarship, and China’s CSC aim to attract top talents by covering tuition fees, providing monthly stipends, and even offering language training. Beyond financial support, these scholarships open doors to cultural exchange, world-class research opportunities, and international career pathways for students who want to study in Asia’s rapidly growing academic environment."
                data-img="{{ asset('image/asiascholar.jpg') }}" data-tags="Asia, Scholarships, Education, International"
                data-links='[
        {"text":"Korean Global Scholarship","url":"#"},
        {"text":"Chinese CSC Scholarship","url":"#"},
        {"text":"ASEAN University Network Grants","url":"#"}
    ]'>
                <img src="{{ asset('image/asiascholar.jpg') }}" alt="Asia Scholarship" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h4 class="font-bold text-[#0b2027] text-sm md:text-md">Top Scholarships in Asia</h4>
                    <p class="text-xs md:text-sm text-[#0b2027] mt-2 line-clamp-3 ">
                        Asia is becoming a major destination for international education, offering thousands of
                        scholarships every year. Programs like Japan’s MEXT, South Korea’s Global Scholarship, and
                        China’s CSC aim to attract top talents by covering tuition fees, providing monthly stipends,
                        and even offering language training. Beyond financial support, these scholarships open doors
                        to cultural exchange, world-class research opportunities, and international career pathways
                        for students who want to study in Asia’s rapidly growing academic environment.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>