<x-admin.layout>
    <div class="min-h-screen bg-[#F2F4F3] font-['Montserrat'] text-[#0B2027] flex flex-col">
        <!-- Header -->
        <x-admin.layout.header />

        <div class="flex flex-1 pt-20">
            <!-- Sidebar -->
            <x-admin.sidebar.admin-sidebar />

            <!-- Main Content -->
            <main class="flex-1 ml-64 p-10">
                <!-- Page Title -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-[#0B2027] mb-2">Admin Management</h1>
                    <p class="text-[#696969]">Manage and promote administrators for the system</p>
                </div>

                <!-- Alert Messages -->
                <div id="alertContainer"></div>

                <!-- Current Admins Section -->
                <div class="bg-white rounded-2xl p-8 shadow-sm mb-10">
                    <h2 class="text-2xl font-bold text-[#0B2027] mb-6">Current Admins</h2>

                    @if($admins->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full" id="adminsTable">
                                <thead>
                                    <tr class="border-b-2 border-gray-200">
                                        <th class="text-left px-6 py-4 font-semibold text-[#0B2027]">Admin Name</th>
                                        <th class="text-left px-6 py-4 font-semibold text-[#0B2027]">Email Address</th>
                                        <th class="text-left px-6 py-4 font-semibold text-[#0B2027]">Status</th>
                                        <th class="text-left px-6 py-4 font-semibold text-[#0B2027]">Joined Date</th>
                                        <th class="text-center px-6 py-4 font-semibold text-[#0B2027]">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="adminsList">
                                    @foreach($admins as $admin)
                                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition admin-row" data-admin-id="{{ $admin->id }}">
                                            <td class="px-6 py-4 font-semibold text-[#0B2027]">{{ $admin->name }}</td>
                                            <td class="px-6 py-4 text-[#696969]">{{ $admin->email }}</td>
                                            <td class="px-6 py-4">
                                                <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold {{ $admin->status == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $admin->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-[#696969]">{{ $admin->created_at->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 text-center">
                                                <button class="px-4 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition font-semibold text-sm remove-btn" data-admin-id="{{ $admin->id }}" onclick="removeAdmin(event, {{ $admin->id }})">
                                                    Remove
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-[#696969] text-lg">No admins found in the system</p>
                        </div>
                    @endif
                </div>

                <!-- Promote Users to Admin Section -->
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <h2 class="text-2xl font-bold text-[#0B2027] mb-6">Promote User to Admin</h2>

                    <!-- Search Bar -->
                    <div class="mb-6">
                        <div class="relative">
                            <input 
                                type="text" 
                                id="userSearch" 
                                placeholder="Search users by name or email..." 
                                class="w-full px-6 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1565C0] focus:outline-none"
                            >
                            <i class="bi bi-search absolute right-4 top-1/2 transform -translate-y-1/2 text-[#696969]"></i>
                        </div>
                    </div>

                    <!-- Available Users List -->
                    @if($nonAdminUsers->count() > 0)
                        <div class="space-y-3" id="usersContainer">
                            @foreach($nonAdminUsers as $user)
                                <div class="user-card flex items-center justify-between p-6 border border-gray-200 rounded-xl hover:shadow-md transition" data-name="{{ strtolower($user->name) }}" data-email="{{ strtolower($user->email) }}" data-user-id="{{ $user->id }}">
                                    <div class="flex items-center space-x-4">
                                        <div>
                                            <h3 class="font-semibold text-[#0B2027]">{{ $user->name }}</h3>
                                            <p class="text-sm text-[#696969]">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <button 
                                        class="px-6 py-2 rounded-lg bg-[#1565C0] text-white hover:bg-[#0d47a1] transition font-semibold text-sm promote-btn" 
                                        data-user-id="{{ $user->id }}"
                                        onclick="promoteAdmin(event, {{ $user->id }}, '{{ addslashes($user->name) }}')"
                                    >
                                        Promote to Admin
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <!-- No Results Message -->
                        <div id="noResults" class="hidden text-center py-12">
                            <p class="text-[#696969] text-lg">No users match your search</p>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-[#696969] text-lg">All users are already admins!</p>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <!-- JavaScript for Search and Promote/Remove Functions -->
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        // Show alert messages
        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alertContainer');
            const alertClass = type === 'success' ? 'bg-green-50 text-green-800 border-green-200' : 'bg-red-50 text-red-800 border-red-200';
            const alertHTML = `
                <div class="mb-6 p-4 rounded-lg border ${alertClass} flex justify-between items-center">
                    <span>${message}</span>
                    <button onclick="this.parentElement.remove()" class="text-lg cursor-pointer">&times;</button>
                </div>
            `;
            alertContainer.insertAdjacentHTML('beforeend', alertHTML);

            // Auto-remove after 5 seconds
            setTimeout(() => {
                alertContainer.querySelector('div:last-child')?.remove();
            }, 5000);
        }

        // Search functionality
        document.getElementById('userSearch')?.addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const userCards = document.querySelectorAll('.user-card');
            const noResults = document.getElementById('noResults');
            let visibleCount = 0;

            userCards.forEach(card => {
                const name = card.dataset.name;
                const email = card.dataset.email;
                
                if (name.includes(searchTerm) || email.includes(searchTerm)) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show no results message if no cards are visible
            if (visibleCount === 0 && userCards.length > 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        });

        // Promote user to admin function
        function promoteAdmin(event, userId, userName) {
            event.preventDefault();

            if (!confirm(`Are you sure you want to promote ${userName} to Admin?`)) {
                return;
            }

            const button = event.target;
            button.disabled = true;
            button.textContent = 'Promoting...';

            fetch('{{ route("admin.admins.promote") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    user_id: userId,
                }),
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Failed to promote user');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Remove user card from DOM
                    const userCard = event.target.closest('.user-card');
                    userCard.remove();

                    // Add new admin row to table
                    const adminsList = document.getElementById('adminsList');
                    const newRow = `
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition admin-row" data-admin-id="${data.admin.id}">
                            <td class="px-6 py-4 font-semibold text-[#0B2027]">${data.admin.name}</td>
                            <td class="px-6 py-4 text-[#696969]">${data.admin.email}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    Active
                                </span>
                            </td>
                            <td class="px-6 py-4 text-[#696969]">${data.admin.created_at}</td>
                            <td class="px-6 py-4 text-center">
                                <button class="px-4 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition font-semibold text-sm remove-btn" data-admin-id="${data.admin.id}" onclick="removeAdmin(event, ${data.admin.id})">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    `;
                    adminsList.insertAdjacentHTML('beforeend', newRow);

                    showAlert(data.message, 'success');

                    // Check if all users are promoted
                    if (document.querySelectorAll('.user-card').length === 0) {
                        document.getElementById('usersContainer').innerHTML = '<div class="text-center py-12"><p class="text-[#696969] text-lg">All users are already admins!</p></div>';
                    }
                } else {
                    showAlert(data.message, 'error');
                    button.disabled = false;
                    button.textContent = 'Promote to Admin';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert(error.message || 'An error occurred', 'error');
                button.disabled = false;
                button.textContent = 'Promote to Admin';
            });
        }

        // Remove admin function
        function removeAdmin(event, adminId) {
            event.preventDefault();

            if (!confirm('Are you sure you want to remove this admin? This action cannot be undone.')) {
                return;
            }

            const button = event.target;
            button.disabled = true;
            button.textContent = 'Removing...';

            const destroyUrl = `/admin/admins/${adminId}`;

            fetch(destroyUrl, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Failed to remove admin');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Remove row from table
                    const row = event.target.closest('.admin-row');
                    row.remove();

                    showAlert(data.message, 'success');
                } else {
                    showAlert(data.message, 'error');
                    button.disabled = false;
                    button.textContent = 'Remove';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert(error.message || 'An error occurred', 'error');
                button.disabled = false;
                button.textContent = 'Remove';
            });
        }
    </script>
</x-admin.layout>
