$(document).ready(function () {
    $('#infrastructure').on('change', function (event) {
        event.preventDefault();
        const infrastructure = $(this).val();
        const hardwareDropdown = $('#hardware');

        hardwareDropdown.html('<option value="">-- Select Hardware --</option>');

        if (infrastructure) {
            $.ajax({
                url: `${window.location.origin}/get-hardwares`,
                type: 'GET',
                data: { infrastructure },
                success: function (data) {
                    console.log(data); // Debugging response
                    if (data && data.length > 0) {
                        data.forEach(function (hardware) {
                            hardwareDropdown.append(`<option value="${hardware}">${hardware}</option>`);
                        });
                    }
                },
                error: function () {
                    alert('Failed to fetch hardwares. Please try again.');
                },
            });
        }
    });
});
