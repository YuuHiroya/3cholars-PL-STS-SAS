<x-admin.layout>
    <div class="min-h-screen bg-[#F2F4F3] font-['Montserrat'] text-[#0B2027] flex flex-col">
        <!-- Header -->
        <x-admin.layout.header />

        <div class="flex flex-1 pt-20">
            <!-- Sidebar -->
            <x-admin.sidebar.admin-sidebar />
        </div>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-10">
            <div class="bg-[#FAFAFA] rounded-2xl p-8 shadow-sm">
                <h3 class="text-xl font-semibold mb-2">Users Management</h3>
                <p class="text-[#696969] mb-6">Manage user accounts and permissions.</p>
                <!-- Add user management content here -->
            </div>
        </main>
    </div>
</x-admin.layout>
