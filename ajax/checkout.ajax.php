<?php

require_once "../controllers/checkout.controller.php";
require_once "../models/checkout.model.php";

class AjaxCheckout {

    /*=============================================
    CHECKOUT SERVICE
    =============================================*/    

    public $data;

    public function ajaxcheckout(){

        $data = $this->data;
        $table = "invoices";

        // Add 'service' and 'duration' parameters to the $data array
        $data['service'] = $_POST["service"];
        $data['serviceid'] = $_POST["serviceid"];
        $data['duration'] = $_POST["duration"];

        $answer = checkoutController::ctrProcesscheckout($data);

        if ($answer == "ok") {
            $answer = checkoutController::ctrFreeInvoice($data);
            echo json_encode($answer);
        }        

    }

}

/*=============================================
CHECKOUT SERVICE
=============================================*/    

$checkout = new AjaxCheckout();
$checkout->data = array(
    'name' => $_POST["name"],
    'email' => $_POST["email"],
    'phone' => $_POST["phone"],
    'address' => $_POST["address"],
    'organizationname' => $_POST["company"]
);
$checkout->ajaxcheckout();
