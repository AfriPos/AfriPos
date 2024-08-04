/*=============================================
CHECKOUT SERVICE
=============================================*/

// Handle form submission
$("#CheckoutForm").submit(function(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    // Get the values of 'service' and 'duration' parameters
    var currentUrl = new URL(window.location.href);
    var service = currentUrl.searchParams.get('service');
    var duration = currentUrl.searchParams.get('duration');
    var serviceid = 0; // Default value

    // Map 'service' to 'serviceid'
    if (service === "basic" && duration === "monthly") {
        serviceid = 1;
    } else if(service === "advanced" && duration === "monthly"){
        serviceid = 2;
    } else if(service === "premium" && duration === "monthly"){
        serviceid = 3;
    } else if (service === "basic" && duration === "yearly") {
        serviceid = 4;
    } else if(service === "advanced" && duration === "yearly"){
        serviceid = 5;
    } else if(service === "premium" && duration === "yearly"){
        serviceid = 6;
    }


    // Serialize form data into JSON
    var formData = $(this).serialize();

    // Add 'serviceid' and 'duration' as additional fields to the formData
    formData += "&serviceid=" + serviceid + "&duration=" + duration + "&service=" + service;

    // Store a reference to the form element
    var form = $(this);

    // Send an AJAX request to your server
    $.ajax({
        type: "POST",
        url: "ajax/checkout.ajax.php", // Replace with the path to your PHP script
        data: formData,
        dataType: "json", // Specify JSON as the expected data type
        success: function(response) {
            // Handle the response from the server
            if (response === "ok") {
                // Display the success alert
                $(".alert-success").show();
                $.ajax({
                    type: "POST",
                    url: "ajax/mail2.ajax.php", // Replace with the path to your PHP script
                    data: formData,
                    dataType: "json", // Specify JSON as the expected data type
                    success: function(response) {
                        if (response === "ok") {
                            // Clear the form fields
                            form[0].reset();
                        }
                    }
                });

                // Hide the success message after 3 seconds (adjust the time as needed)
                setTimeout(function() {
                    $(".alert-success").hide();
                }, 3000); // 3 seconds
            }
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error(xhr.responseText);
        }
    });
});
