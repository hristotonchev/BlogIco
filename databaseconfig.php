<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "Ht0891001";
$db_name = "ico";

try
{
     $DB_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $exception){

     echo $exception->getMessage();
}
