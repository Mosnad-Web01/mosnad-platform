export function initializeSearchModal() {
    let currentAdminTypeId = null;

    const assignModal = document.getElementById('assignModal');
    const closeModalButton = document.getElementById('closeModal');
    const userSearchInput = document.getElementById('userSearch');
    const userListContainer = document.getElementById('userList');

    // Enhanced modal open with animation
    window.openAssignModal = (adminTypeId) => {
        currentAdminTypeId = adminTypeId;
        assignModal.classList.remove('hidden');
        setTimeout(() => {
            assignModal.querySelector('.transform').classList.add('scale-100');
            assignModal.querySelector('.transform').classList.remove('scale-95');
        }, 10);
    };

    // Enhanced modal close with animation
    const closeModal = () => {
        assignModal.querySelector('.transform').classList.add('scale-95');
        assignModal.querySelector('.transform').classList.remove('scale-100');
        setTimeout(() => {
            assignModal.classList.add('hidden');
            userSearchInput.value = '';
            userListContainer.innerHTML = '';
        }, 200);
    };

    closeModalButton.addEventListener('click', closeModal);

    // Enhanced user search with loading state
    userSearchInput.addEventListener('input', debounce(async (e) => {
        const query = e.target.value.trim();

        if (!query) {
            userListContainer.innerHTML = '';
            return;
        }

        // Show loading state
        userListContainer.innerHTML = `
            <div class="flex items-center justify-center py-4">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            </div>
        `;

        try {
            const response = await fetch(`/api/users/search?q=${encodeURIComponent(query)}`);
            const users = await response.json();

            userListContainer.innerHTML = users.map(user => `
                <div onclick="assignToUser('${user.id}')"
                     class="p-3 hover:bg-gray-50 cursor-pointer rounded-lg transition-colors duration-200 flex items-center">
                    <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3">
                        ${user.name.charAt(0).toUpperCase()}
                    </div>
                    <div>
                        <div class="font-medium text-gray-900">${user.name}</div>
                        <div class="text-sm text-gray-500">${user.email}</div>
                    </div>
                </div>
            `).join('');
        } catch (error) {
            console.error('Error fetching user list:', error);
            userListContainer.innerHTML = `
                <div class="text-center py-4 text-red-500">
                    <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Failed to load users
                </div>
            `;
        }
    }, 300));

    window.assignToUser = async (userId) => {
        if (!currentAdminTypeId) return;

        const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
        if (!csrfTokenElement) {
            console.error('CSRF token meta tag is missing.');
            showNotification('Failed to assign user: CSRF token is missing.', 'error');
            return;
        }

        try {
            const csrfToken = csrfTokenElement.content;
            const response = await fetch(`/admin-roles/${currentAdminTypeId}/assign/${userId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            });

            const data = await response.json();
            showNotification(data.message, 'success');
            closeModal();
        } catch (error) {
            console.error('Error assigning admin type:', error);
            showNotification('Error assigning admin type to user', 'error');
        }
    };

    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `fixed bottom-4 left-4 px-6 py-3 rounded-lg shadow-lg ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        } text-white transform transition-all duration-300 translate-y-full`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.remove('translate-y-full');
        }, 100);

        setTimeout(() => {
            notification.classList.add('translate-y-full');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    function debounce(func, wait) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

}
