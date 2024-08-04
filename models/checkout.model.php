<?php
require "connection.php";
class checkoutModel{

    public static function mdlProcesscheckout($table, $ads, $data){

        $stmt = connection::connectbilling()->prepare("INSERT INTO $table(name, email, phone, address, packageid, organizationcode, organizationname, remaining_days) VALUES (:name, :email, :phone, :address, :serviceid, :organizationcode, :organizationname, :remaining_days)");

        $stmt -> bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt -> bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":phone", $data["phone"], PDO::PARAM_STR);
        $stmt -> bindParam(":address", $data["address"], PDO::PARAM_STR);
        $stmt -> bindParam(":organizationname", $data["organizationname"], PDO::PARAM_STR);
        $stmt -> bindParam(":serviceid", $data["serviceid"], PDO::PARAM_INT);
        $stmt -> bindParam(":organizationcode", $ads['organizationcode'], PDO::PARAM_STR);
        $stmt -> bindParam(":remaining_days", $ads['remaining_days'], PDO::PARAM_INT);

        if ($stmt->execute()) {

            // Close the statement and set it to null
            $stmt->closeCursor();

            $stmt = null;

            return 'ok';
            
        } else {

            // Close the statement and set it to null
            $stmt->closeCursor();

            $stmt = null;

            return 'error';

        }

    }
    public static function mdlFreeInvoice($invoiceId, $item, $duedate, $totaltax, $total, $discount, $dueamount, $subtotal, $timestamp, $data){
        // Prepare the SQL insert statement
        $stmt = connection::connectbilling()->prepare("INSERT INTO invoices (invoiceId, item, startdate, duedate, customername, phone, totaltax, total, discount, dueamount, subtotal, datecreated) VALUES (:invoiceId, :item, CURDATE(), :duedate, :customername, :phone, :totaltax, :total, :discount, :dueamount, :subtotal, :datecreated)");

        // Bind parameters individually
        $stmt -> bindParam(':invoiceId', $invoiceId, PDO::PARAM_STR);
        $stmt -> bindParam(':item', $item, PDO::PARAM_STR);
        $stmt -> bindParam(':duedate', $duedate, PDO::PARAM_STR);
        $stmt -> bindParam(':customername', $data["name"], PDO::PARAM_STR);
        $stmt -> bindParam(':phone', $data["phone"], PDO::PARAM_STR);
        $stmt -> bindParam(':totaltax', $totaltax, PDO::PARAM_STR);
        $stmt -> bindParam(':total', $total, PDO::PARAM_STR);
        $stmt -> bindParam(':discount', $discount, PDO::PARAM_STR);
        $stmt -> bindParam(':dueamount', $dueamount, PDO::PARAM_STR);
        $stmt -> bindParam(':subtotal', $subtotal, PDO::PARAM_STR);
        $stmt -> bindParam(':datecreated', $timestamp, PDO::PARAM_STR);

        if ($stmt->execute()) {

            // Close the statement and set it to null
            $stmt->closeCursor();

            $stmt = null;

            return 'ok';
            
        } else {

            // Close the statement and set it to null
            $stmt->closeCursor();

            $stmt = null;

            return 'error';

        }

    }

}
