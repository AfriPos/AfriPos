<?php

    class connection{

        static public function connect(){

                $pdo = new PDO('mysql:host=54.38.38.23;dbname=afriposc_pos_db;','afriposc_root','Afripos@123!');

                $pdo->exec('set names utf8');

                return $pdo;
        }

        static public function connectbilling(){

                $pdo = new PDO('mysql:host=54.38.38.23;dbname=afriposc_pos_db_billing;','afriposc_root','Afripos@123!');

                $pdo->exec('set names utf8');

                return $pdo;
        }
    }

?>