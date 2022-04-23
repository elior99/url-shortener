<?php

$conn = new mysqli("localhost", "root", "", "affiliate_short");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


mysqli_set_charset($conn, 'utf8');


?>