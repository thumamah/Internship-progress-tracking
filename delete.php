<?php

//delete_data.php
require('/home/s3022041/sqlC/dbConnect.php');

if(isset($_POST['delete_btn'])){
$id = $_POST["delete_id"];

$sql = "DELETE FROM intern WHERE id = $id";
echo "$sql";
$query_run = mysqli_query($connection, $sql);

if($query_run){
    header('Location: index.php');
}
else{
    header('Location: index.php');
}
}



?>