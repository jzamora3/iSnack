<?php
session_start();
// include database configuration file
include 'dbConfig.php';
require_once'db.php';
require_once "functions.php";



// initializ shopping cart class
include 'cart.php';
$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: customerIndex.php");
}

// set customer ID in session
$_SESSION['sessCustomerID'] = $_SESSION['id'];
if(!empty($_SESSION['sessCustomerID'])) {
  


// get customer details by session customer ID
$query = $db->query("SELECT * FROM customers WHERE id = ".$_SESSION['sessCustomerID']);
$custRow = $query->fetch_assoc();
}
else{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Not Logged In');
    window.location.href='https://jzamora4.create.stedwards.edu/iSnack2/customerPortal.html';
    </script>");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    
    .table{width: 65%;float: left;}
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
    footer {
  position: absolute;
  bottom: 0;
  width: 100%;

}
        body { 
    padding-top: 75px; 
}
    </style>
    
    <script src="js/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    

</head>
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
              <a class="nav-link" href="customerIndex.php"><i class="fa fa-bars" style="font-size:24px"></i>Menu
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
  
<div class="container">
    <br />
    <h1>Order Preview</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Discount</th>
            <th>You Saved</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
   
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo '$'.$item["cost"].' USD'; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo '$'.$item["subtotal"].' USD'; ?></td>
            <td><?php echo get_promotion_details($item["name"]).'% OFF'; ?></td>
            <td><?php echo '$' ,totalSaved($item["name"],$item["qty"]).' USD'; ?></td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="4"><p>No items in your cart......</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '$'.$cart->total().' USD'; ?></strong></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    <div class="shipAddr">
        <h4>Customer Details</h4>
        <p><?php echo $custRow['name']; ?></p>
        <p><?php echo $custRow['email']; ?></p>
        <p><?php echo $custRow['phone']; ?></p>
        <p><?php echo $custRow['address']; ?></p>
    </div>
    <div class="footBtn">
        <a href="customerIndex.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a>
        <a href="cartAction.php?action=placeOrder" class="btn btn-success orderBtn">Place Order <i class="glyphicon glyphicon-menu-right"></i></a>
    </div>
</div>
</body>
	<footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; iSnack 2018</p>
      </div>
      <!-- /.container -->
    </footer>
</html>