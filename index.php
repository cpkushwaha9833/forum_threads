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
  <!---slider start here--->
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://source.unsplash.com/2400x700/?code,apple" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/2400x700/?iphone,software" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/2400x700/?microsoft,android" class="d-block w-100" alt="...">
    </div>
  </div>
</div>
<!--- categories container start here--->
  <div class="container my-4" id="ques">
    <h2 class="text-center my-4">iDiscuss -Browse Categories</h2>
    <div class="row my-4">
      <!---fetch all the categories and use a loop to iterate through categories -->
      <?php 
      $sql = "SELECT * FROM `categories`";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)){
       // echo $row['category_id'];
       // echo $row['category_name'];
       $id = $row['category_id'];
       $cat = $row['category_name'];
       $desc = $row['category_description'];
       
        echo ' <div class="col-md-4 my-2">
        <div class="card" style="width: 18rem;">
          <img src="https://source.unsplash.com/500x400/?' . $cat . ',coding" class="card-img-top" alt="Image for this category">
          <div class="card-body">
          <h5 class="card-title"><a href="threadlist.php?catid=' . $id . '">' . $cat . '</a></h5>
          <p class="card-text">' . substr($desc, 0, 90). '...</p>
          <a href="threadlist.php?catid=' . $id . '" class="btn btn-primary">Viwe Threads</a>
        </div>
       </div>
    </div>';
      }

      ?>



    </div>
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