$(document).ready(function () {
    $('#infrastructure').on('change', function () {
        const infrastructure = $(this).val();
        const hardwareDropdown = $('#hardware');

        // Reset hardware dropdown
        hardwareDropdown.html('<option value="">-- Select Hardware --</option>');

        if (infrastructure) {
            $.ajax({
                url: '/get-hardwares',
                type: 'GET',
                data: { infrastructure },
                success: function (data) {
                    if (data && data.length > 0) {
                        data.forEach(function (hardware) {
                            hardwareDropdown.append(
                                `<option value="${hardware}">${hardware}</option>`
                            );
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
