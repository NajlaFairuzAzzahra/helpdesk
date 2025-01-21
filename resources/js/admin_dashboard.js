document.addEventListener('DOMContentLoaded', () => {
    const filters = document.querySelectorAll('select');

    filters.forEach(filter => {
        filter.addEventListener('change', () => {
            const params = new URLSearchParams(window.location.search);

            // Update URL params sesuai filter
            filters.forEach(sel => {
                if (sel.value) {
                    params.set(sel.name, sel.value);
                } else {
                    params.delete(sel.name);
                }
            });

            // Redirect ke URL baru dengan filter
            window.location.href = `${window.location.pathname}?${params.toString()}`;
        });
    });
});
