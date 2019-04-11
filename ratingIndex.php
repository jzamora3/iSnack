<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<title>iSnack Menu Ratings</title>
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
<style>


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
    body { 
    padding-top: 100px; 
}
</style>
</head>

<body  onload="showProductData('getRatingData.php')">
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
    <div class="container">
        <h2 align="center">iSnack Menu Ratings</h2>
        <span align="center", id="product_list"></span>
    </div>
    


</body>
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; iSnack 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</html>

<script type="text/javascript">

    function showProductData(url)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("product_list").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();

    } 

    function mouseOverRating(productId, rating) {

        resetRatingStars(productId)

        for (var i = 1; i <= rating; i++)
        {
            var ratingId = productId + "_" + i;
            document.getElementById(ratingId).style.color = "#ff6e00";

        }
    }

    function resetRatingStars(productId)
    {
        for (var i = 1; i <= 5; i++)
        {
            var ratingId = productId + "_" + i;
            document.getElementById(ratingId).style.color = "#9E9E9E";
        }
    }

   function mouseOutRating(productId, userRating) {
	   var ratingId;
       if(userRating !=0) {
    	       for (var i = 1; i <= userRating; i++) {
    	    	      ratingId = productId + "_" + i;
    	          document.getElementById(ratingId).style.color = "#ff6e00";
    	       }
       }
       if(userRating <= 5) {
    	       for (var i = (userRating+1); i <= 5; i++) {
	    	      ratingId = productId + "_" + i;
	          document.getElementById(ratingId).style.color = "#9E9E9E";
	       }
       }
    }

    function addRating (productId, ratingValue) {
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function ()
            {
                if (this.readyState == 4 && this.status == 200) {

                    showProductData('getRatingData.php');
                    
                    if(this.responseText != "success") {
                    	   alert(this.responseText);
                    }
                }
            };

            xhttp.open("POST", "insertRating.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var parameters = "index=" + ratingValue + "&product_id=" + productId;
            xhttp.send(parameters);
    }
</script>