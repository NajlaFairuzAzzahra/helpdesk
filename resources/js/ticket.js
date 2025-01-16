$(document).ready(function () {
    $('#system').on('change', function () {
        const system = $(this).val();
        const subSystemDropdown = $('#sub_system');

        // Reset sub-system dropdown
        subSystemDropdown.html('<option value="">-- Select Sub-system --</option>');

        if (system) {
            $.ajax({
                url: '/get-sub-systems',
                type: 'GET',
                data: { system },
                success: function (data) {
                    if (data && data.length > 0) {
                        data.forEach(function (subSystem) {
                            subSystemDropdown.append(
                                `<option value="${subSystem}">${subSystem}</option>`
                            );
                        });
                    }
                },
                error: function () {
                    alert('Failed to fetch sub-systems. Please try again.');
                },
            });
        }
    });
});
