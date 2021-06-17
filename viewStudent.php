<?php 
  require('./db/connect.php');
  if(isset( $_GET['id'])){
    $searchId = $_GET['id'];
    $sql = "Select * from StudentList where id=$searchId";
  if(!$connect->query($sql)){
    die($connect->error);
  }
  $results=mysqli_query($connect,$sql);
  $row_users = mysqli_fetch_assoc($results);
  $row_count=mysqli_num_rows($results);
}
else {
    die('Incorrect details');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student - Student Details List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #img{
    width: 200px;
    height: 200px;
    background-position: center center;
    background-size: contain;
    background-repeat: no-repeat;
    margin: 0 15px
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="./">My Student Details</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <form method='get' action='search.php' class="form-inline my-2 my-lg-0 ml-auto">
                <input class="form-control mr-sm-2" name='search' type="search" placeholder="Search" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">Search</button>
              </form>
              <button class="btn btn-primary my-2 my-sm-0 ml-sm-2" type="submit" onclick="window.location.href='./addStudent.php'">+ Add Student</button>
            </div>
          </nav>
    </header>
    <section class="mt-5 mb-5">
    <div class="container">
        <h1 class="text-center mb-5"><?php echo $row_users['fullname'] ?>'s Details</h1>
        <div>
        <div class="card">
        <div class="card-img-top" id='img' style='background-image:url(<?php echo $row_users['image'] ?>)' alt="Card image cap"></div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $row_users['fullname'] ?></h5>
            <p class="card-text"><strong>Email: </strong><?php echo $row_users['email'] ?></p>
            <p class="card-text"><strong>Phone: </strong><?php echo $row_users['phone'] ?></p>
            <p class="card-text"><strong>Degree: </strong><?php echo $row_users['degree'] ?></p>
            <a href="./editStudent.php?id=<?php echo $row_users['id'] ?>" class="btn btn-primary">Edit</a>
        </div>
        </div>
        </div>
    </div>
    </section>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>