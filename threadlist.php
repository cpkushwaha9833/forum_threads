<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
      #ques{
        min-height: 433px;
      }
    </style>

    <title>welcome to iDiscuss - Coding Forums</title>
  </head>
  <body>
  <?php include 'partials/_header.php'; ?>
  <?php include 'partials/_dbconnect.php'; ?>
  <?php
  $id = $_GET['catid'];
  $sql = "SELECT * FROM `categories` WHERE category_id=$id";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)){
     $catname = $row['category_name'];
     $catdesc = $row['category_description'];
  }
  ?>

  <?php
  $showAlert = false;
  $method = $_SERVER['REQUEST_METHOD'];
  if($method=='POST'){
    //Insert into threads db
    $th_title = $_POST['title'];
    $th_desc = $_POST['desc'];
    $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())";
  $result = mysqli_query($conn, $sql);
  $showAlert = true;
  if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>Your thread has been added! please wait for community to respond.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  }
  
  ?>
 
<!--- categories container start here--->
  <div class="container my-4">
  <div class="jumbotron">
  <h1 class="display-4">Welcom to <?php echo $catname; ?> forum</h1>
  <p class="lead"><?php echo $catdesc; ?></p>
  <hr class="my-4">
  <p>This is peer to per forum. No Spam / Advertising / Self-promote in the forums.
Do not post copyright-infringing material.
Do not post “offensive” posts, links or images.
Remain respectful of other members at all times.</p>
  <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
</div>
  </div>

  <div class="container">
  <h1 class="py-2">Start a Discussion</h1>
  <form action=<?php echo $_SERVER['REQUEST_URI'] ?> method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Problem Title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">keep your title as short and crisp as possible.</small>
  </div>
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Ellaborate Your Concern</label>
  <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
</div>
  <button type="submit" class="btn btn-success">Submit</button>
</form>
  </div>

  <div class="container" id="ques">
      
      <?php
  $id = $_GET['catid'];
  $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
  $result = mysqli_query($conn, $sql);
  $noResult = true;
  while($row = mysqli_fetch_assoc($result)){
    $noResult = false;
     $id = $row['thread_id'];
     $title = $row['thread_title'];
     $desc = $row['thread_desc'];
     $thread_time = $row['timestamp'];

     echo ' <div class="media my-3">
     <img src="img/userdefault.png" width="54px" class="mr-3" alt="...">
     <div class="media-body">
     <p class="font-weight-bold my-0">Anonymous User at '.$thread_time .'</p>
       <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $id. '">' . $title . ' </a></h5>
       ' . $desc . '
     </div>
   </div>';
  }
  // echo var_dump($noResult);
  if($noResult){
    echo '<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <p class="display-4">No Threads Found</p>
      <p class="lead">Be the first person to ask the question</p>
    </div>
  </div>';
  }

  ?>




     
<!--- remove later; putting this just to check html alignment for now --->
<!--- <div class="media my-3">
  <img src="img/userdefault.png" width="54px" class="mr-3" alt="...">
  <div class="media-body">
    <h5 class="mt-0">Unable to install pyaudio error in windows</h5>
    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
  </div>
</div> --->


  </div>

  <?php include 'partials/_footer.php'; ?>
  

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>