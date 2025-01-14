<?php
require('./db/connect.php'); // database connection is required

// check if form is submitted
  if(isset($_POST['submit'])){
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $degree = $_POST['degree'];

    // upload image
    // converting it to base64 and storing in database
    $base64 = '';
    if(isset($_FILES['image']))
    {
      $allowed_ext= array('jpg','jpeg','png','gif');
      $file_name =$_FILES['image']['name'];
    // seperating the extension
      $seperateExt = explode('.',$file_name);
      $file_ext = strtolower( end($seperateExt));
      $file_size=$_FILES['image']['size'];
      $file_tmp= $_FILES['image']['tmp_name'];
      $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
      $data = file_get_contents($file_tmp);
      $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
      if(in_array($file_ext,$allowed_ext) === false)
      {
         die('upload only image format');
      }
      if($file_size > 2097152)
      {
          die('File size must be under 2mb');
      }
    }
      $sql = "INSERT INTO StudentList (fullname, email, phone, degree, image) VALUES ('$name', '$email', '$phone',' $degree', '$base64')";
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
    <!-- provides navigation links within current document or to other documents -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="./">My Student Details</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          <!--defines a section or a section in the document -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form method='get' action='search.php' class="form-inline my-2 my-lg-0 ml-auto">
                <input class="form-control mr-sm-2" name='search' type="search" placeholder="Search" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">Search</button>
              </form>
              <!-- clickable button in which we can put text -->
              <button class="btn btn-primary my-2 my-sm-0 ml-sm-2" type="submit" onclick="window.location.href='./addStudent.php'">+ Add Student</button>
            </div>
          </nav>
    </header>
    <!-- defines a section in document -->
    <section class="mt-5 mb-5">
        <div class="container">
            <h1 class="text-center">Add new Student</h1>
            <form action='' method='post' enctype="multipart/form-data">
                <div class="form-group">
                    <label>Upload Your Image</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Browse… <input type="file" name='image' id="img">
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