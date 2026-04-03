<?php
$servername = "localhost";
$thisuser = "root";
$pwd = "";
$dbname = "daily_discoveries";
$con = mysqli_connect($servername,$thisuser,$pwd,$dbname);
if (!$con){
    die ("Connection failed : ").mysqli_connect_error();
}