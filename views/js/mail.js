/*=============================================
SEND MAIL
=============================================*/

// Handle form submission
$("#contactForm").submit(function(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    // Serialize form data into JSON
    var formData = $(this).serialize();
    
    // Store a reference to the form element
    var form = $(this);

    // Send an AJAX request to your server
    $.ajax({
        type: "POST",
        url: "ajax/mail.ajax.php", // Replace with the path to your PHP script
        data: formData,
        dataType: "json", // Specify JSON as the expected data type
        success: function(response) {
            // Handle the response from the server
            if (response === "ok") {
                // Display the success alert
                $(".alert-success").show();
                $(".alert-danger").hide();
                
                // Clear the form fields
                form[0].reset();

                // Hide the success message after 3 seconds (adjust the time as needed)
                setTimeout(function() {
                    $(".alert-success").hide();
                }, 3000); // 3 seconds

            } else if (response === "error") {
                // Display the error alert
                $(".alert-danger").show();
                $(".alert-success").hide();

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
