<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulky SMS</title>
    <!-- Correct the script and stylesheet links -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-md-8 col-lg-6 col-xl-5">
                <form method="POST" action="index.php">
                    <div class="card bg-dark">
                        <div class="row mt-0">
                            <div class="col-md-12">
                                <h4 class="">SMS Mailer💌</h4>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-12 mb-0">
                                <p class="mb-1">Phone</p> <input id="e-mail" type="text" placeholder="Enter your phone" name="phone" class="form-control input-box rm-border">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 mb-2">
                                <p class="mb-1">Message</p> <textarea id="message" placeholder="Enter your message" name="message" class="form-control input-box rm-border"></textarea>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center mb-0">
                            <div class="col-md-12 px-3"> <input type="submit" value="Submit" name="submit" class="btn btn-block btn-purple rm-border"> </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['submit'])){
    # PHP example
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mobitechtechnologies.com/sms/sendsms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(array(
            "mobile" => $_POST['phone'],
            "response_type" => "json",
            "sender_name" => "23107",
            "service_id" => 0,
            "message" => $_POST['message']
        )),
        CURLOPT_HTTPHEADER => array(
            'h_api_key: 2de81b4e457f9ea8e21ab06a96076a91ed73da31c68b4db336840f67422afbaf',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'cURL error: ' . curl_error($curl);
    } else {
        echo 'API Response: ' . $response;
    }

    curl_close($curl);
}
?>
</body>
</html>
