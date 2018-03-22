<?php
session_start();
require('includes/dbconnect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Index</title>
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="css/bootstrap-magnify.css" type="text/css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap-magnify.js"></script>
</head>
<body>
  <?php
  require("includes/navbar.php");
  ?>

  <div class="container-fluid">

    <div class="row">

      <div class="col-6 col-md-2" >

        <div class="container-fluid">

          <ul class="list-group">
            <center><h3>Shop</h3></center>

            <li class="list-group-item">  <a href="#">Man</a>&nbsp;  <a href="#">Woman</a></li>
            <li class="list-group-item">  <a href="#">Kids</a> &nbsp;  <a href="#">Couples</a></li>

          </ul>


          <ul class="list-group">
            <center><h5>Discover</h5></center>

            <li class="list-group-item">  <a href="#">Easter Shirts</a> &nbsp;  <a href="#">Earth day Shirts</a></li>
            <li class="list-group-item"><a href="#">Country Music Shirts</a> </br> <a href="#">Feminist Shirts</a> </li>
            <li class="list-group-item">  <a href="#">Funny Shirts</a> &nbsp; <a href="#">Horoscope Shirts</a></li>

          </ul>

        </div>

        <ul class="list-group">
          <center><h5>Create your own</h5>
          </center>

          <li class="list-group-item">  <a href="#">T-Shirt</a>&nbsp;  <a href="#">Hoodies</a>
          </li>
          <li class="list-group-item"> <a href="#">Tank Tops</a> &nbsp;     <a href="#">Sweats</a></li>
          <li class="list-group-item"> <a href="#">Polo Shirt</a> &nbsp; <a href="#">Longsleeve</a>
          </li>

        </ul>
      </div>



      <div class="col-5 col-md-8" >

        <div class="container-fluid">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="images/banner1.jpg" height="300px" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/banner2.jpg" height="300px"  alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/banner3.jpg"  height="300px" alt="Third slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/banner4.jpg"  height="300px" alt="forth slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-sm">
              <div class="card">
                <img class="card-img-top" src="images/man_unisex.jpg" alt="man_unisex img cap">
                <div class="card-body">
                  <h5 class="card-title">Men/Unisex</h5>
                  <div class="card-text">
                    <a href="#">T-Shirt</a>
                    <a href="#">Longsleeve</a>
                    <a href="#">Polos</a></br>
                    <a href="#">Sweats & Hoddies</a></br>
                    <a href="#">Tank Tops</a>



                  </div>


                </div>

              </div>

            </div>
            <div class="col-sm">
              <div class="card">
                <img class="card-img-top" src="images/woman.jpg" alt="woman image cap">
                <div class="card-body">
                  <h5 class="card-title">Women</h5>
                  <div class="card-text">


                    <a href="#">T-Shirt</a>
                    <a href="#">Longsleeve</a>
                    <a href="#">Polos</a></br>
                    <a href="#">Sweats & Hoddies</a></br>
                    <a href="#">Tank Tops</a>
                  </div>
                </div>

              </div>

            </div>
            <div class="col-sm">
              <div class="card">
                <img class="card-img-top" src="images/kids_babies.jpg" alt="kids_babies image cap">
                <div class="card-body">
                  <h5 class="card-title">Kids</h5>
                  <div class="card-text">

                    <a href="#">T-Shirt</a>
                    <a href="#">Longsleeve</a>
                    <a href="#">Polos</a></br>

                  </div>
                </div>

              </div>

            </div>
            <div class="col-sm">
              <div class="card">
                <img class="card-img-top" src="images/couples.jpg" alt="couples image cap">
                <div class="card-body">
                  <h5 class="card-title">Couples</h5>
                  <div class="card-text">


                    <a href="#">T-Shirt</a>
                    <a href="#">Longsleeve</a>
                    <a href="#">Polos</a></br>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-2" >

        <div class="container-fluid">

          <ul class="list-group">
            <center><h5>Trending</h5></center>

            <li class="list-group-item"> <a href="#">Inspirational T-Shirts</a>
              &nbsp;  <a href="#">Football Shirts</a>
            </li>
            <li class="list-group-item"><a href="#">Make up T-Shirts</a>
            </li>

            <ul class="list-group">
              <center><h5>Seasonal</h5></center>

              <li class="list-group-item"> <a href="#">Inspirational T-Shirts</a>  &nbsp;  <a href="#">Football Shirts</a>  </li>
              <li class="list-group-item"><a href="#">Make up T-Shirts</a></li>

            </ul>

            <ul class="list-group">
              <center><h5>Our Favorite</h5></center>
              <li class="list-group-item"> <a href="#">Vintage T-Shirts</a> &nbsp;  <a href="#">Gaming T-Shirts</a></li>
              <li class="list-group-item"><a href="#">Vegan T-Shirts</a> &nbsp; <a href="#">Graphic T-Shirts</a></li>

            </ul>
          </div>

        </div>

      </div>
    </div>


    <?php
    require("includes/footer.php");
    ?>
  </body>
  </html>
  
