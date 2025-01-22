// Make functions globally accessible
window.openDeleteModal = function (ticketId) {
    console.log(`Opening modal for ticket ID: ${ticketId}`);
    const modal = document.getElementById(`deleteModal-${ticketId}`);
    if (modal) {
        modal.classList.remove('hidden');
    }
};

window.closeDeleteModal = function (ticketId) {
    console.log(`Closing modal for ticket ID: ${ticketId}`);
    const modal = document.getElementById(`deleteModal-${ticketId}`);
    if (modal) {
        modal.classList.add('hidden');
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const filters = document.querySelectorAll('select');

    filters.forEach(filter => {
        filter.addEventListener('change', () => {
            const params = new URLSearchParams(window.location.search);

            filters.forEach(sel => {
                if (sel.value) {
                    params.set(sel.name, sel.value);
                } else {
                    params.delete(sel.name);
                }
            });

            window.location.href = `${window.location.pathname}?${params.toString()}`;
        });
    });
});
