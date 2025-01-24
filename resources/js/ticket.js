$(document).ready(function () {
    $('#system').on('change', function (event) {
        event.preventDefault(); // Mencegah reload halaman

        // Fetch data sub-systems
        if (selectedSystem) {
            fetch(`/get-sub-systems?system=${selectedSystem}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Sub-systems fetched:', data);
                    const subSystemDropdown = $('#sub_system');
                    subSystemDropdown.empty().append('<option value="">-- Select Sub-system --</option>');
                    data.forEach(sub => {
                        subSystemDropdown.append(`<option value="${sub}">${sub}</option>`);
                    });
                })
                .catch(error => {
                    console.error('Error fetching sub-systems:', error);
                });
        }
    });
});
