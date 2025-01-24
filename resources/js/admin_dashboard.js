// Make functions globally accessible
window.openDeleteModal = function (id) {
    const modal = document.getElementById(`deleteModal-${id}`);
    if (modal) {
        modal.style.display = 'flex';
    } else {
        console.error(`Delete modal for ticket ID ${id} not found.`);
    }
};

window.closeDeleteModal = function (id) {
    const modal = document.getElementById(`deleteModal-${id}`);
    if (modal) {
        modal.style.display = 'none';
    } else {
        console.error(`Delete modal for ticket ID ${id} not found.`);
    }
};


window.openEditModal = function (id) {
    const modal = document.getElementById(`editModal-${id}`);
    if (modal) {
        modal.style.display = 'flex';
    } else {
        console.error(`Edit modal for ticket ID ${id} not found.`);
    }
};

window.closeEditModal = function (id) {
    const modal = document.getElementById(`editModal-${id}`);
    if (modal) {
        modal.style.display = 'none';
    } else {
        console.error(`Edit modal for ticket ID ${id} not found.`);
    }
};

function submitEditForm(id) {
    const form = document.querySelector(`#editModal-${id} form`);
    if (form) {
        const formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
            .then((response) => {
                if (response.ok) {
                    closeEditModal(id);
                    location.reload(); // Reload to reflect changes
                } else {
                    alert('Failed to update ticket. Please try again.');
                }
            })
            .catch(() => {
                alert('An error occurred. Please try again.');
            });
    } else {
        console.error(`Form for ticket ID ${id} not found.`);
    }
}


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
