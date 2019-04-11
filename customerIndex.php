<?php
session_start();
// include database configuration file
include 'dbConfig.php';
require_once "functions.php";
?>


<?php
 //index.php
$connect = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
function make_query($connect)
{
 $query = "SELECT * FROM Promotion ORDER BY id ASC";
 $result = mysqli_query($connect, $query);
 return $result;
}

function make_slide_indicators($connect)
{
 $output = ''; 
 $count = 0;
 $result = make_query($connect);
     while($row = mysqli_fetch_array($result))
     {
          if($count == 0)
          {
           $output .= '
           <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
           ';
          }
          else
          {
           $output .= '
           <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
           ';
          }
          $count = $count + 1;
     }
 return $output;
}

function make_slides($connect)
{
     $output = '';
     $count = 0;
     $result = make_query($connect);
     while($row = mysqli_fetch_array($result))
     {
          if($count == 0)
          {
           $output .= '<div class="item active">';
          }
          else
          {
           $output .= '<div class="item">';
           
          }
          $output .= '
                    
            <div class="banner"> 

            <div class="big-text animated tada">'.$row["discount"].'% OFF '.$row["name"].' </div>
            </div>

          </div>
          ';
          $count = $count + 1;
      
     }
    
     return $output;
}

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>iSnack Shop</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    

  </head>
<style> 
pic {
    width: 175px;
    height: 175px;
    display: block;
    margin-left: auto;
    margin-right: auto;

    -webkit-transition-property: width, height; /* Safari */
    -webkit-transition-duration: 2s; /* Safari */
    transition-property: width, height;
    transition-duration: 2s;
}

pic:hover {
    width: 300px;
    height: 300px;
}
glow {
  font-size: 80px;
  color: #fff;
  text-align: center;
  -webkit-animation: glow 1s ease-in-out infinite alternate;
  -moz-animation: glow 1s ease-in-out infinite alternate;
  animation: glow 1s ease-in-out infinite alternate;
}

@-webkit-keyframes glow {
  from {
     text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
  }
  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
  }
}

    
.cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}

ul {
    margin: 0px;
    padding: 10px 0px 0px 0px;
}

li.star {
    list-style: none;
    display: inline-block;
    margin-right: 5px;
    cursor: pointer;
    color: #9E9E9E;
}

li.star.selected {
    color: #ff6e00;
}

.row-title {
    font-size: 20px;
    color: #00BCD4;
}

.review-note {
    font-size: 12px;
    color: #999;
    font-style: italic;
}
.row-item {
    margin-bottom: 20px;
    border-bottom: #F0F0F0 1px solid;
}
p.text-address {
    font-size: 12px;
}
.banner{
    width: 100%;
    background: gold;
    background-size: cover;
    font-size: 80px;
    color: black;
    text-align: center;
    padding: 40px 15px;
    animation-name: tada;
}
.big-text{
    font-size: 75px;
    font-weight: 600;
    animation-delay: 1s;
}
    body { 
    padding-top: 75px; 
}

</style>
  <body class="bg-light">
      
      

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
              <a class="nav-link" href="customerLogout.php"><i class="fa fa-user-o" style="font-size:24px">Log In</i>
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="customerLogout.php"><i class="fa fa-sign-out" style="font-size:24px">Logout</i>
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a href="viewCart.php" <i class="fa fa-shopping-cart" style="font-size:24px;color:green"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <br />
  <div class="container">
   <br />
   <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php echo make_slide_indicators($connect); ?>
    </ol>

    <div class="carousel-inner">
     <?php echo make_slides($connect); ?>
    </div>
    <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left"></span>
     <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right"></span>
     <span class="sr-only">Next</span>
    </a>

   </div>
  </div>
        

    

    <!-- Page Content -->
   <?php
//require_once'db.php';
    function get_product_details()
    {
        $db = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
        $ret = array();
        $sql = "SELECT * FROM Product";
        ////ql.= "SELECT Vendor.name FROM Vendor, Product WHERE Product.vendor = 'Vendor.id'";
        //$res = db::sql($sql);
        $res = mysqli_query($db, $sql);
 
        while($ar = mysqli_fetch_assoc($res))
        {
            $ret[] = $ar;
        }
        return $ret;
    }
        function get_product_name($vendor)
    {
        $db = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');
        $rValue = "";
        $query = "SELECT Vendor.name FROM Vendor, Product WHERE Product.vendor = Vendor.id AND Product.vendor = $vendor";
        $result = mysqli_query($db, $query);
        if ($row = mysqli_fetch_array($result)){
            $rValue = $row['name'];
        }
        return $rValue;
    }


?>






        <article class = "main_area2">
            <h1 class = "food_h1" style="color: black;font-size:50px; text-align: center;font-weight: bold;text-shadow: grey 2px 2px">Menu</h1><br>
            <section class = "menu_section">
                <div class="container">
                    <div class="row">
                <?php 
                    $products = get_product_details(); 
                    $db = new mysqli('jzamora4.create.stedwards.edu', 'jzamorac', 'IHk2875ski', 'jzamorac_doslocos');

                        foreach($products as $ap)
                        {
                            $name = $ap['name'];
                            $description = $ap['details'];
                            $price = $ap['cost'];
                            $vendor = $ap['vendor'];
                            $picture = $ap['picture'];
                            $vendorName = get_product_name($vendor);
                            $average = avgRating($ap['id'], $db);
                           
                            
                            
                        ?>
                            
                        <div class="col-lg-4 col-md-6 mb-4">
                          <div class="card h-100 py-5 bg-light">
                             <p class="card-text" style="color: red;font-weight: bold;font-size:35px;text-align: center;text-shadow: 2px 2px 2px black"><?php echo $vendorName; ?></p>

                            <pic href="#"><img class="card-img-top" src="data:image/jpeg;base64,<?php echo base64_encode($picture);  ?>" alt=""></pic>
                            <div class="card-body">
                              <h4 class="card-title" style="color: #FEF305;font-size:30px;text-align: center">
                                <a href="#"style="color: yellow;text-align: center;text-shadow: 2px 2px 2px black"><?php echo $name; ?></a>
                              </h4>
                              <h5 style="color: black;text-align: center">$<?php echo $price; ?></h5>
                              <p class="card-text" style="color: black;font-weight: bold;font-size:20px;text-align: center"><?php echo $description; ?></p>
                              <!--<a href="#"style="color: red">Add to Cart</a>-->
                            <div class="col-md-6">
                                <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?php echo $ap["id"]; ?>">Add to cart</a>
                            </div>
                            </div>
                            <div class="card-footer">
                              
                            </div>
                            <div class="col-md-6">
                                <a href="ratingIndex.php"><span class="glyphicon glyphicon-star", align="center">Rate</span></a>
                                <p align="center" class="review-note"> <?php echo $average; ?> out of 5 stars</p>
                            </div>
                          </div>
                        </div>
                    
   
                            <?php
                            }?>
            </section>
        </article>
        </div>
        </div>
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; iSnack 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

  </body>

</html>
