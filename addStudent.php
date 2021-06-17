<?php
require('./db/connect.php');
  if(isset($_POST['submit'])){
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $degree = $_POST['degree'];
    $sql = "INSERT INTO StudentList (fullname, email, phone, degree) VALUES ('$name', '$email', '$phone',' $degree')";
    if($connect->query($sql)){
      echo '<script>alert("Success")</script>';
    }
    else {
      die($connect->error);
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student - Student Details List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #img-upload{
    width: 300px;
    height: 300px;
    background-position: center center;
    background-size: contain;
    background-repeat: no-repeat;
    display:none;
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
            <h1 class="text-center">Add new Student</h1>
            <form action='' method='post'>
                <div class="form-group">
                    <label>Upload Your Image</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" id="img">
                            </span>
                        </span>
                    </div>
                    <img id='img-upload'/>
                </div>
                <div class="form-group">
                    <label for="full_name">Full Name*</label>
                    <input type="text" name='fullname' required class="form-control" id="full_name" placeholder="Full Name">
                  </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address*</label>
                  <input type="email" name='email' required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number*</label>
                    <input type="number" name='phone' required class="form-control" id="phone" placeholder="Phone Number">
                  </div>
                <div class="form-group">
                <label for="degree">Degree*</label>
                <input type="text" name='degree' required class="form-control" id="degree" placeholder="Degree">
                </div>
                <div class="form-check">
                  <input type="checkbox" required class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">I agree to all <a href='#'>terms & conditions</a></label>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
              </form>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).on("change","#img", function(){
        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                $('#img-upload').css("display","inline-block");
                $('#img-upload').css("background-image", "url("+this.result+")");
            }
        }
    })
</script>
</body>
</html>