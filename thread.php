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
  $id = $_GET['threadid'];
  $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)){
     $title = $row['thread_title'];
     $desc = $row['thread_desc'];
  }
  ?>

<?php
  $showAlert = false;
  $method = $_SERVER['REQUEST_METHOD'];
  if($method=='POST'){
    //Insert into comments db
    $comment = $_POST['comment'];
    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '0', current_timestamp())";
  $result = mysqli_query($conn, $sql);
  $showAlert = true;
  if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>Your comment has been added!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  }
  
  ?>
 
<!--- categories container start here--->
  <div class="container my-4">
  <div class="jumbotron">
  <h1 class="display-4"><?php echo $title; ?></h1>
  <p class="lead"><?php echo $desc; ?></p>
  <hr class="my-4">
  <p>This is peer to per forumr. No Spam / Advertising / Self-promote in the forums.
Do not post copyright-infringing material.
Do not post “offensive” posts, links or images.
Remain respectful of other members at all times.</p>
  <p>Posted By :<b> CP</b></p>
</div>
  </div>

  <div class="container">
  <h1 class="py-2">Post a Comment</h1>
  <form action=<?php echo $_SERVER['REQUEST_URI'] ?> method="post">
  
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Type Your Comment</label>
  <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
</div>
  <button type="submit" class="btn btn-success">Post Comment</button>
</form>
  </div>


  <div class="container" id="ques">
      <h1 class="py-2">Discussions</h1>
     <?php
  $id = $_GET['threadid'];
  $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
  $result = mysqli_query($conn, $sql);
  $noResult = true;
  while($row = mysqli_fetch_assoc($result)){
    $noResult = false;
     $id = $row['comment_id'];
     $content = $row['comment_content'];
     $comment_time = $row['comment_time'];


     echo ' <div class="media my-3">
     <img src="img/userdefault.png" width="54px" class="mr-3" alt="...">
     <div class="media-body">
     <p class="font-weight-bold my-0">Anonymous User at '.$comment_time .'</p>
       ' . $content . '
     </div>
   </div>';
  }

  if($noResult){
    echo '<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <p class="display-4">No Threads Found</p>
      <p class="lead">Be the first person to ask the question</p>
    </div>
  </div>';
  }

  ?>


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