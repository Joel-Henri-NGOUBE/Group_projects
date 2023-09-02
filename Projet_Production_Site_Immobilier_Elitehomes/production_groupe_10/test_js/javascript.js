
        function incrementPassenger() {
        var passengerInput = document.getElementById("passenger");
        var currentValue = parseInt(passengerInput.value);
        passengerInput.value = currentValue + 1;
    }

    function decrementPassenger() {
        var passengerInput = document.getElementById("passenger");
        var currentValue = parseInt(passengerInput.value);
        if (currentValue > 0) {
            passengerInput.value = currentValue - 1;
        }
    }
