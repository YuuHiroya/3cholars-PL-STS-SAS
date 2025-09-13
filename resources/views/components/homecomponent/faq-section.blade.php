<section class="py-10 md:py-14">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Title -->
        <h2
            class="text-3xl md:text-4xl font-bold text-center mb-4 text-transparent bg-clip-text bg-gradient-to-r from-[#020024] via-[#090979] to-[#00D4FF]">
            Frequently asked questions!!
        </h2>
        <p class="text-[#838383] text-center max-w-2xl mx-auto mb-12 text-[14px] lg:text-[16px]">
            Find answers to the most common questions about our scholarship programs and application process.
        </p>

        <div class="grid md:grid-cols-2 gap-8 items-start">
            <!-- Left Image -->
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <img src="{{ asset('image/Cambridge 1.jpg') }}" alt="University" class="w-full h-full object-cover">
            </div>

            <!-- Right FAQ List -->
            <div class="space-y-4 text-xs md:text-sm lg:text-lg transition-all" x-data="{ open: null }">
                <!-- Item 1 -->
                <div class="bg-[#1565c0] rounded-xl shadow border">
                    <button @click="open === 1 ? open = null : open = 1"
                        class="flex justify-between items-center w-full px-5 py-4 text-left font-medium text-[#FAFAFA]">
                        <span>What expenses does the scholarship cover?</span>
                        <i :class="open === 1 ? 'bi bi-caret-up-fill' : 'bi bi-caret-down-fill'"></i>
                    </button>
                    <div x-show="open === 1" x-collapse class="px-5 pb-4 text-[#FAFAFA]">
                        Most scholarships cover tuition fees, accommodation, books, and sometimes living expenses or
                        travel allowance depending on the program.
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="bg-[#1565c0] rounded-xl shadow border">
                    <button @click="open === 2 ? open = null : open = 2"
                        class="flex justify-between items-center w-full px-5 py-4 text-left font-medium text-[#FAFAFA]">
                        <span>Which documents do I need to prepare?</span>
                        <i :class="open === 2 ? 'bi bi-caret-up-fill' : 'bi bi-caret-down-fill'"></i>
                    </button>
                    <div x-show="open === 2" x-collapse class="px-5 pb-4 text-[#FAFAFA]">
                        Usually you need transcripts, recommendation letters, proof of language proficiency
                        (TOEFL/IELTS), a CV, and a motivation or personal statement.
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="bg-[#1565c0] rounded-xl shadow border">
                    <button @click="open === 3 ? open = null : open = 3"
                        class="flex justify-between items-center w-full px-5 py-4 text-left font-medium text-[#FAFAFA]">
                        <span>Can I apply for multiple scholarships at the same time?</span>
                        <i :class="open === 3 ? 'bi bi-caret-up-fill' : 'bi bi-caret-down-fill'"></i>
                    </button>
                    <div x-show="open === 3" x-collapse class="px-5 pb-4 text-[#FAFAFA]">
                        Yes, you can apply for more than one scholarship, but make sure you meet the eligibility
                        criteria and manage deadlines carefully.
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="bg-[#1565c0] rounded-xl shadow border">
                    <button @click="open === 4 ? open = null : open = 4"
                        class="flex justify-between items-center w-full px-5 py-4 text-left font-medium text-[#FAFAFA]">
                        <span>What are the eligibility requirements for this scholarship?</span>
                        <i :class="open === 4 ? 'bi bi-caret-up-fill' : 'bi bi-caret-down-fill'"></i>
                    </button>
                    <div x-show="open === 4" x-collapse class="px-5 pb-4 text-[#FAFAFA]">
                        Requirements differ by program, but usually include academic achievement, language
                        proficiency, and sometimes financial need or leadership potential.
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="bg-[#1565c0] rounded-xl shadow border">
                    <button @click="open === 5 ? open = null : open = 5"
                        class="flex justify-between items-center w-full px-5 py-4 text-left font-medium text-[#FAFAFA]">
                        <span>How do I choose the right country or university for my studies abroad?</span>
                        <i :class="open === 5 ? 'bi bi-caret-up-fill' : 'bi bi-caret-down-fill'"></i>
                    </button>
                    <div x-show="open === 5" x-collapse class="px-5 pb-4 text-[#FAFAFA]">
                        Consider your academic goals, the ranking and reputation of universities, available
                        scholarships, language, culture, and long-term career opportunities.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>