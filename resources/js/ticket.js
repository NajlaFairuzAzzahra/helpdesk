$(document).ready(function () {
    $('#system').on('change', function (event) {
        event.preventDefault();
        const system = $(this).val();
        const subSystemDropdown = $('#sub_system');

        subSystemDropdown.html('<option value="">-- Select Sub-system --</option>');

        if (system) {
            $.ajax({
                url: `${window.location.origin}/get-sub-systems`,
                type: 'GET',
                data: { system },
                success: function (data) {
                    console.log(data); // Debugging response
                    if (data && data.length > 0) {
                        data.forEach(function (subSystem) {
                            subSystemDropdown.append(`<option value="${subSystem}">${subSystem}</option>`);
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
