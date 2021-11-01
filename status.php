<?php

require('/home/s3022041/sqlC/dbConnect.php');

$mid = $_GET['id'];
$status = $_GET['display'];

$query = "update intern set display = $status where id = $mid";
echo $query;
$newerr = mysqli_error("error : "+$query);
echo $newerr;
mysqli_query($connection, $query);

 header('location: index.php');