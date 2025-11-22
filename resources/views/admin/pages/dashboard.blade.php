<x-admin.layout>
    <div class="min-h-screen bg-[#F2F4F3] font-['Montserrat'] text-[#0B2027] flex flex-col">
        <!-- Header -->
        <x-admin.layout.header />

        <div class="flex flex-1 pt-20">
            <!-- Sidebar -->
            <x-admin.sidebar.admin-sidebar />
        </div>

        <!-- Main Content -->
        <x-admin.content.dashboard-content />
    </div>
</x-admin.layout>
