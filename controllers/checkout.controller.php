<?php

class checkoutController{

    public static function ctrProcesscheckout($data){
        $table = "customers";

        $randomNumber = mt_rand(1000, 9999); // Generate a random 4-digit number
        $timezone = new DateTimeZone("Africa/Nairobi"); // Replace "Your_Timezone" with the desired timezone identifier, such as "America/New_York"
        $current_time = new DateTime("now", $timezone); // Get the current time in the specified timezone
        $current_time_formatted = $current_time->format("His"); // Format the current time in hours, minutes, and seconds
        $organizationcode = "ORG-" . $randomNumber . "-" . $current_time_formatted;

        $ads = array(
            'organizationcode' => $organizationcode,
            'remaining_days' => 3,
        );

        $answer = checkoutModel::mdlProcesscheckout($table, $ads, $data);

        return $answer;

    }

    public static function ctrFreeInvoice($data){
        // Define invoice data
        $randomNumber = mt_rand(1000, 9999); // Generate a random 4-digit number
        $timezone = new DateTimeZone("Africa/Nairobi"); // Replace "Your_Timezone" with the desired timezone identifier, such as "America/New_York"
        $current_time = new DateTime("now", $timezone); // Get the current time in the specified timezone
        $current_time_formatted = $current_time->format("His"); // Format the current time in hours, minutes, and seconds
        $invoiceId = "INV-" . $randomNumber . "-" . $current_time_formatted;

        $item = $data["service"]." package ". $data["duration"]." free trial";
        $totaltax = 0; // Total tax amount
        $discount = 0; // Discount amount
        $subtotal = 0; // Subtotal amount
        $duedate = date('Y-m-d', strtotime('+3 days')); // Calculate due date 3 days from now

        // Calculate total and due amount
        $total = $subtotal + $totaltax - $discount;
        $dueamount = $total;
        
        // Set the timezone you want to use
        $timezone = new DateTimeZone('Africa/Nairobi'); // Change to your desired timezone

        // Create a DateTime object with the specified timezone
        $datetime = new DateTime('now', $timezone);

        // Format the timestamp as a string
        $timestamp = $datetime->format('Y-m-d H:i:s T'); // Adjust the format as needed


        $answer = checkoutModel::mdlFreeInvoice($invoiceId, $item, $duedate, $totaltax, $total, $discount, $dueamount, $subtotal, $timestamp, $data);

        return $answer;

    }

}