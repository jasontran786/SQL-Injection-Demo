<?php
//Set variables needed to reach the database suck as domain name, username, passsword
function startconn()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "db-sqli";

// Use mysqli function to connect using the parameters in variables
    $conn = new mysqli($servername, $username, $password, $database);
    return $conn;
}
