document.addEventListener("DOMContentLoaded", function () {
    const infrastructureDropdown = document.getElementById("infrastructure");
    const hardwareDropdown = document.getElementById("hardware");

    if (infrastructureDropdown) {
        infrastructureDropdown.addEventListener("change", function (event) {
            event.preventDefault(); // Prevent the default form submission
            const selectedInfrastructure = this.value;

            hardwareDropdown.innerHTML = '<option value="">-- Select Hardware --</option>';

            if (selectedInfrastructure) {
                fetch(`/get-hardwares?infrastructure=${selectedInfrastructure}`)
                    .then((response) => response.json())
                    .then((data) => {
                        if (data && data.length > 0) {
                            data.forEach((hardware) => {
                                const option = document.createElement("option");
                                option.value = hardware;
                                option.textContent = hardware;
                                hardwareDropdown.appendChild(option);
                            });
                        }
                    })
                    .catch((error) => {
                        console.error("Error fetching hardware:", error);
                    });
            }
        });
    }
});
