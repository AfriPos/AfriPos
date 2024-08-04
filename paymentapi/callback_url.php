<?php
header("Content-Type: application/json");

// DATA
$mpesaResponse = file_get_contents('php://input');

// Log the response
$logFile = "M_PESAConfirmationResponse.json";

// Split the concatenated JSON input by newline character
$mpesaResponses = explode("\n", $mpesaResponse);

    $dbHost = '54.38.38.23';
    $dbName = 'afriposc_pos_db_billing';
    $dbUser = 'afriposc_root';
    $dbPass = 'Afripos@123!';
    $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("<h1>Error connecting to db:</h1> " . $conn->connect_error);
}

    // Set the timezone to Nairobi
    date_default_timezone_set('Africa/Nairobi');

foreach ($mpesaResponses as $mpesaResponse) {
    // Skip empty lines
    if (empty(trim($mpesaResponse))) {
        continue;
    }

    $callbackContent = json_decode($mpesaResponse);

    // Check if the JSON is in the expected format
    if (isset($callbackContent->Body->stkCallback->ResultCode)) {
        $Resultcode = $callbackContent->Body->stkCallback->ResultCode;
        $Message = $callbackContent->Body->stkCallback->ResultDesc;
        $Status = ($Resultcode == 0) ? "Success" : "Failed"; // Determine the status based on ResultCode
        $Action = "Refill balance payment request";
        $MerchantRequestID = $callbackContent->Body->stkCallback->MerchantRequestID;
        $CheckoutRequestID = $callbackContent->Body->stkCallback->CheckoutRequestID;
        $CallbackMetadata = json_encode($callbackContent->Body->stkCallback->CallbackMetadata);

        $Response = "Body: 
                        stkCallback: 
                        MerchantRequestID: $MerchantRequestID
                        CheckoutRequestID: $CheckoutRequestID
                        ResultCode: $Resultcode
                        ResultDesc: $Message
                        CallbackMetadata: 
                        $CallbackMetadata";

        $Errors = ""; // Initialize Errors field
        $CustomerId = 2315; // You need to specify the correct customer ID
        $Datetime = date('Y-m-d H:i:s'); // Current date and time

        // Insert data into the database
        $insertQuery = "INSERT INTO mobile_transactions (Message, Status, Action, Response, CustomerId, Datetime)
                        VALUES ('$Message', '$Status', '$Action', '$Response', $CustomerId, '$Datetime')";

        if (mysqli_query($conn, $insertQuery)) {
            // Data inserted successfully
        } else {
            // Handle the database query error
            echo json_encode([
                "error" => true,
                "message" => "Error inserting data into the database: " . mysqli_error($conn)
            ]);
        }
    } else {
        // Handle invalid or unexpected response format
        echo json_encode([
            "error" => true,
            "message" => "Invalid or unexpected response format."
        ]);
    }
}

// Close the database connection
mysqli_close($conn);

// Respond with a success message
$response = '{
    "ResultCode": 0, 
    "ResultDesc": "Confirmation Received Successfully"
}';
echo $response;
