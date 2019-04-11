<?php
if(!isset($_REQUEST['id'])){
    header("Location: customerIndex.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Success</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      
    <script src="js/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    

    <style>
        footer {
  position: absolute;
  bottom: 0;
  width: 100%;

}
        body { 
    padding-top: 75px; 
}
    p{color: #34a853;font-size: 18px;}
    </style>
</head>
</head>
<body>
                <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="landingIndex.html" style="font-size:24px">iSnack</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="customerIndex.php"><i class="fa fa-bars" style="font-size:24px"></i>Menu
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="customerLogout.php"><i class="fa fa-user-o" style="font-size:24px"></i>Log In
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="customerLogout.php"><i class="fa fa-sign-out" style="font-size:24px"></i>Logout
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a href="viewCart.php" <i class="fa fa-shopping-cart" style="font-size:36px;color:green"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <br />
    <a class="nav-link" href="customerIndex.php">
    <div class="container">
    <h1>Order Status</h1>
    <p>Your order was submitted successfully. Order ID is #<?php echo $_GET['id']; ?></p>
    <p>Click to go back to menu</p>
</div>
</body>
	<footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; iSnack 2018</p>
      </div>
      <!-- /.container -->
    </footer>
</html>