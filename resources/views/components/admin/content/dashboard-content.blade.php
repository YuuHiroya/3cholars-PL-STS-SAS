<main class="flex-1 ml-64 p-10">
    <div class="bg-[#FAFAFA] rounded-2xl p-8 flex items-center justify-between shadow-sm mb-8">
        <div>
            <h2 class="text-2xl font-semibold mb-2">Hello, {{ Auth::user()->name ?? 'Admin' }}</h2>
            <p class="text-[#696969] mb-4">Welcome to the Admin Dashboard. Manage users, scholarships, and more.</p>
            <button onclick="window.location.href='{{ route('profile.edit') }}'" class="bg-[#1565C0] text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                View Profile
            </button>
        </div>
        <img src="{{ asset('image/Image Cewe.png') }}" alt="Admin Illustration" class="w-56">
    </div>

    <!-- Admin Stats -->
    <div class="bg-[#FAFAFA] rounded-2xl p-8 shadow-sm">
        <h3 class="text-xl font-semibold mb-2">Admin Overview</h3>
        <p class="text-[#696969] mb-6">Quick stats and management tools.</p>

        <div class="grid grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow p-4 text-center">
                <h4 class="font-semibold">Total Users</h4>
                <p class="text-[#696969] text-sm">Manage user accounts</p>
            </div>

            <div class="bg-white rounded-xl shadow p-4 text-center">
                <h4 class="font-semibold">Scholarships</h4>
                <p class="text-[#696969] text-sm">Active scholarship programs</p>
            </div>

            <div class="bg-white rounded-xl shadow p-4 text-center">
                <h4 class="font-semibold">Applications</h4>
                <p class="text-[#696969] text-sm">Pending reviews</p>
            </div>

            <div class="bg-white rounded-xl shadow p-4 text-center">
                <h4 class="font-semibold">Reports</h4>
                <p class="text-[#696969] text-sm">System analytics</p>
            </div>
        </div>
    </div>
</main>
