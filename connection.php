<?php
error_reporting(0);
$user="root";
$password="";
$database="mku_pastpapers";
$host="localhost";

$link=mysqli_connect($host,$user,$password,$database) or die("Unable to connect to the database");

?> 