<!DOCTYPE html>
<html lang="en">
<head>
  <title>Palestra Bella</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .container {
        text-align: center; 
    }
    .carousel {
        margin: auto; 
        border-radius: 20px;
        box-shadow: none; 
        overflow: hidden; 
    }
    .carousel-inner {
        border-radius: 20px;
    }
    .carousel-inner img {
        width: 100%; 
        height: auto;
        border-radius: 20px;
        object-fit: cover; 
    }
    .carousel, .carousel-inner, .carousel-inner img {
        border-radius: 20px; 
        border: none; 
    }
    .carousel-control {
        width: 10%; 
        height: 100%; 
        background: none; 
        border: none; 
    }
    .carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right {
        font-size: 2em;
        color: #000; 
    }
    .carousel-sm {
        max-width: 300px; 
        max-height: 200px; 
    }
    .carousel-sm .carousel-control {
        width: 15%; 
    }
    .carousel-sm .carousel-control .glyphicon-chevron-left, .carousel-sm .carousel-control .glyphicon-chevron-right {
        font-size: 1em; 
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Recensioni</h2>  
  <div id="myCarousel2" class="carousel carousel-sm slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel2" data-slide-to="1"></li>
      <li data-target="#myCarousel2" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        recensione1
      </div>
      <div class="item">
        recensione2
      </div>
      <div class="item">
        recensione3
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel2" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<div class="container">
  <h2>Galleria</h2>  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="immagine.jpg" alt="Los Angeles">
      </div>
      <div class="item">
        <img src="immagine1.jpg" alt="Chicago">
      </div>
      <div class="item">
        <img src="immagine2.jpg" alt="New york">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

</body>
</html>
