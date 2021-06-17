<?php 
  require('./db/connect.php'); //database connection is required 
  $sql = "Select * from StudentList";
  if(!$connect->query($sql)){
    die($connect->error);
  }
  $results=mysqli_query($connect,$sql);
  $row_count=mysqli_num_rows($results);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- specifies the character encoding -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <header>
    <!-- defines the navigation links -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="./">My Student Details</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          <!-- defines a division or section in the document -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <form method='get' action='search.php' class="form-inline my-2 my-lg-0 ml-auto">
                <input class="form-control mr-sm-2" name='search' type="search" placeholder="Search" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">Search</button>
              </form>
              <button class="btn btn-primary my-2 my-sm-0 ml-sm-2" type="submit" onclick="window.location.href='./addStudent.php'">+ Add Student</button>
            </div>
          </nav>
    </header>
    <!-- defines section of documents -->
    <section class="mt-5 mb-5">
    <div class="container">
        <h1 class="text-center mb-5">Welcome to My Student details List</h1>
        <div>
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Degree</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody> <?php
                $count = 1;
                if($row_count < 1){
                  echo '<tr><td colspan="4">Sorry no students are present....</td></tr>';
                }
                while ($row_users = mysqli_fetch_array($results)) { 
                  ?>
                  <tr>
                    <th scope="row"><?php echo $count++; ?></th>
                    <td><?php echo $row_users['fullname'] ?></td>
                    <td><?php echo $row_users['email'] ?></td>
                    <td><?php echo $row_users['phone'] ?></td>
                    <td><?php echo $row_users['degree'] ?></td>
                    <td><a href='./viewStudent.php?id=<?php echo $row_users['id'] ?>'>View Profile</a></td>
                    <td><a href='./editStudent.php?id=<?php echo $row_users['id'] ?>'>Edit Profile</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
        </div>
    </div>
    </section>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>