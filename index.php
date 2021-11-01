<!DOCTYPE html>
<html lang="en">
<head>
  <title>Live Search</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<style>
  #add{
    margin: 2rem;
    position: relative;
    justify-content: center;
  }

</style>
</head>


<body>



 <div class="jumbotron bg-info text-center">
  <h1>Tracking My Internship Progress</h1>
</div>
  
<div class="container">
  <div class="row">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-6">
     <!-- Button trigger modal -->
     <button type="button" id="add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Add
     </button>

     <!-- Add Modal -->
     <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Jobs</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!--form action, method and class-->
                        <form action="index.php" method="POST" class="form">
                            <h2>Internship Status</h2>
                            <div class="mb-3">
    

                                <label class="form-label">Company</label>
                                <input type="text" name="company" class="form-control" required>
    
                                <label for="Enginesize" class="form-label">Link</label>
                                <input type="link" name="link" class="form-control" required>

                                <label for="Enginesize" class="form-label">Link Name</label>
                                <input type="text" name="linkName" class="form-control" required>
    
                                <label for="TransmissionType" class="form-label">Role</label><br>
                                <input type="text" name="role" id="TransmissionType" required/>
                                
    
    
                            </div>
    
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="insertdata" class="btn btn-primary">Add Job</button>
    
                            </form>
    
    
                    </div>
                    <div class="modal-footer">
    
                        </form>
                    </div>
                </div>
            </div>
        </div>
      <input type="text" placeholder="Search for names and adresses..." class="form-control" id="search">
      <table class="table table-info">
      <thead>
        <tr>
          <th>Company</th>
          <th>Link</th>
          <th>Role</th>
          <th>Status</th>
          <th>Delete</th>
          
          
        </tr>
      </thead>
      <tbody id="output">
        
      </tbody>
    </table>
    </div>
    <div class="col-sm-3">
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $("#search").keypress(function(){
      $.ajax({
        type:'POST',
        url:'search.php',
        data:{
          name:$("#search").val(),
        },
        success:function(data){
          $("#output").html(data);
        }
      });
    });
  });

</script>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    
</body>
</html>

<?php





if ($_SERVER['REQUEST_METHOD'] == 'POST') {   // checking method
    $errors = array(); // creating an errors array to record errors if there are any.


    if (empty($_POST['company'])) {
        $errors[] = 'name is required.';
    } else {
        // trim function removes whitespace and other predefined characters from both sides of a string.
        $company = trim($_POST['company']);
        // checking for the valid pattern from user
        if (!preg_match('/^[a-z A-Z]*$/', $company)) {
            $errors[] = 'Invalid  Company!';
        }
    }

    // check if the ManufacturingYear is provided and is valid
    if (empty($_POST['link'])) {
        $errors[] = 'address is required.';
    } else {
        $link = trim($_POST['link']);
        if (!preg_match('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si', $link)) {
            $errors[] = 'Invalid Link';
        }
    }

    // check if the Enginesize is provided and is valid
    if (empty($_POST['linkName'])) {
        $errors[] = 'area is required.';
    } else {
        $linkName = trim($_POST['linkName']);
        if (!preg_match('/^[a-z A-Z]*$/', $linkName)) {
            $errors[] = 'Invalid Role!';
        }
    }

    // check if the Transmissiontype is provided and is valid
    if (empty($_POST['role'])) {
      $errors[] = 'area is required.';
  } else {
      $role = trim($_POST['role']);
      if (!preg_match('/^[a-z A-Z]*$/', $role)) {
          $errors[] = 'Invalid Role!';
      }
  }



    // if empty erros insert data
    if (empty($errors)) {
        require('/home/s3022041/sqlC/dbConnect.php');
        $company = $_POST['company'];
        $link = $_POST['link'];
        $linkName = $_POST['linkName'];
        $role = $_POST['role'];
        session_start();
        // insert query
        $query = "INSERT INTO intern (company, link, linkName, role) 
                    VALUES ('$company','$link', '$linkName', '$role');";
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
          $_SESSION['message'] = "Record has been added";
          $_SESSION['msg_type'] = "Success";

          header("location: index.php");
            // echo "<h2>Added successfully</h2>";
            // echo "<a href='index.php'>home</a>";
        } else {
            echo 'Error! ' . mysqli_error($connection); // else print errors
        }
        mysqli_close($connection); // close the database connection

    } else {
        echo "<h3 class='errorH'>Error! <br>The following error(s) occurred:</h3>";
        foreach ($errors as $msg) {
            echo "<div class='error'>$msg </div>";
        }
    }
}
    ?>