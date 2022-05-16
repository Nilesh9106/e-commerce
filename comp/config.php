<?php
$DB_SERVER='localhost';
$DB_USERNAME='root';
$DB_PASSWORD='';
$DB_NAME='user';

$link = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if ($link === false) {

    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
}


?>