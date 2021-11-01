
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$serverName = "localhost";
$username = "s3022041";
$passsword = "irogyman";
$database = "s3022041";


// creating connnection
$connection = mysqli_connect($serverName, $username, $passsword, $database);



 
if (!$connection) {
    die("connection failed:" . mysqli_connect_error());
} else {


    mysqli_set_charset($connection, 'utf8');
    #echo "hello welcome";
}

//$query = "SELECT * FROM masjid where address LIKE '%" . $_POST['address'] . "%' OR name LIKE '%" . $_POST['name'] . "%' ";
$query = "SELECT * FROM intern WHERE company LIKE '%" . $_POST['name'] . "%'";
//$query = "SELECT * FROM 'intern' WHERE 'company' LIKE ? OR 'role' LIKE ?";
$result = mysqli_query($connection, $query);



if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
// echo "<br><a href='$row[pageLINK]'> $row[pageNAME]</a><br>";
        
        ?>
           
        	<tr>
		          <td> <?php echo $row['company']; ?></td>
                  <td><a href= <?php echo $row['link']; ?> ><?php echo $row['linkName']; ?></a></td>
                 <td> <?php echo $row['role']; ?></td>
                  <td> 
                     <?php
                  if($row['display']== 1){
                    echo '<a <button type="button" href="status.php?id='.$row['id'].'&display=0" class="btn btn-warning btn-xs">Applied</button></a>';
                  }elseif($row['display']== 2){
                      echo '<a <button type="button" href="status.php?id='.$row['id'].'&display=1" class="btn btn-success btn-xs">Interviews</button></a>';
                  }else{
                    echo '<a <button type="button" href="status.php?id='.$row['id'].'&display=2" class="btn btn-info btn-xs">Not Applied</button></a>';
                  }  ?></td>
                  <td> <form action="delete.php" method="POST" class="form">
                      <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" name="delete_btn" value="'<?php $row["id"] ?>'" class="btn btn-danger btn-xs delete">Delete</button>
                     </form></td>
                     
		    </tr>;
           <?php
    }
} else {
    echo "<tr><td>0 result's found</td></tr>";
}

// close connection
mysqli_close($connection);
?>
<!-- CREATE TABLE intern (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    company VARCHAR(200) NOT NULL,
    link VARCHAR(200) NOT NULL,
    linkName VARCHAR(200) NOT NULL,
    role VARCHAR(200) NOT NULL,
    display varchar(30) DEFAULT NULL
);

INSERT INTO masjid (name, address, area)
VALUES ('muhammad', 'Liffey Road Liffey Valley Park', 'Lucan');

 