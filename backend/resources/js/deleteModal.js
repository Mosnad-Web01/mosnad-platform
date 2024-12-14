export function initializeDeleteModal() {
    const deleteModal = document.getElementById("deleteModal");
    const deleteForm = document.getElementById("deleteForm");
    const deleteMessage = document.getElementById("deleteMessage");
    const defaultMessage = deleteMessage.dataset.defaultMessage;

    // Add click event listeners to all delete buttons
    document.addEventListener('click', function(e) {
        const deleteButton = e.target.closest('.delete-btn');
        if (deleteButton) {
            e.preventDefault();
            const deleteUrl = deleteButton.dataset.deleteUrl;
            const customMessage = deleteButton.dataset.deleteMessage;

            // Update form action
            deleteForm.action = deleteUrl;

            // Update message if custom message exists
            deleteMessage.textContent = customMessage || defaultMessage;

            // Show modal
            deleteModal.classList.remove("hidden");
            deleteModal.classList.add('opacity-100', 'scale-100');
        }
    });

    // Close modal when clicking outside
    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            closeDeleteModal();
        }
    });

    window.closeDeleteModal = () => {
        deleteModal.classList.add("hidden");
        deleteModal.classList.remove('opacity-100', 'scale-100');
        // Reset form and message
        deleteForm.action = '#';
        deleteMessage.textContent = defaultMessage;
    };
}
