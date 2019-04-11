<?php
require_once'db.php';
isset($_SESSION) or exit(header('Location: portal.html'));
isset($_SESSION['id']) or exit(header('Location: logout.php'));
db::populate($_SESSION['id']);global $data, $view; $view = getView();
function getView() {
    global $data;
    if (isset($_GET['employees']))     {$data = $_SESSION['employees']; return 'Employee';}
    else if (isset($_GET['products'])) {$data = $_SESSION['products']; return 'Product';}
    else if (isset($_GET['vendors']))  {$data = $_SESSION['vendors']; return 'Vendor';}
    else if (isset($_GET['order_item']))  {$data = $_SESSION['order_item']; return 'order_items';}
    else if (isset($_GET['order']))  {$data = $_SESSION['order']; return 'orders';}
    else if (isset($_GET['promotions']))  {$data = $_SESSION['promotions']; return 'Promotion';}
    else if (isset($_GET['ratings']))  {$data = $_SESSION['ratings']; return 'Rating';}}?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8"><meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<title>iSnack</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/dataTables.bootstrap4.min.css" rel="stylesheet"><link href="css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="css/isnack.min.css" rel="stylesheet"><link href="css/absolution.css" rel="stylesheet">
	<link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="css/buttons.dataTables.min.css" rel="stylesheet">
	<link href="css/responsive.dataTables.min.css" rel="stylesheet">
	<link href="css/dataTables.select.min.css" rel="stylesheet">
	<link href="css/isnack.min.css" rel="stylesheet">
	<link href="css/absolution.css" rel="stylesheet">
	
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="js/dataTables.bootstrap4.min.js"></script><script src="js/isnack.min.js"></script><script src="js/fontawesome.min.js"></script>
	<script src="js/pdfmake.min.js"></script><script src="js/vfs_fonts.js"></script>
	<script src="js/dataTables.buttons.min.js"></script>
	<script src="js/buttons.colVis.min.js"></script>
	<script src="js/buttons.html5.min.js"></script>
	<script src="js/buttons.print.min.js"></script>
	<script src="js/dataTables.responsive.min.js"></script>
	<script src="js/dataTables.select.min.js"></script>

	
</head>
<style>
body { 
    padding-top: 75px;
   padding-bottom: 80px;

}



</style>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="landingIndex.html">iSnack</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="customerIndex.php" style="font-size:24px">Menu
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="deleteItem.php" style="font-size:24px">Delete Items
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="portal.html" style="font-size:24px" >Logout
                <span class="sr-only">(current)</span>
              </a>
          </ul>
        </div>
      </div>
    </nav>
    <div class="godown-60" id="godown"></div>

<body id="page-top" style="background-color: #092859; background-repeat: no-repeat; margin: 20px";padding-top = "65px";>
    
	<div class="row">
	    <div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-danger o-hidden h-100" style="<?=isset($_GET['account']) ? 'border: 2px black solid' : 'border: 0'?>">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa fa-user"></i>
					</div><a href='admin.php?account'><div class="mr-5">Admin: <?=$_SESSION['username']?></div></a>
				</div>
				<a class="card-footer text-white clearfix small z-1" href="logout.php" style="color:white"><span class="float-left">Log Out</span> 
				<span class="float-right"><i class="fas fa-angle-right"></i></span></a>
			</div>
		</div>
	
	    <div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-warning o-hidden h-100" style="<?=isset($_GET['vendors']) ? 'border: 2px black solid' : 'border: 0'?>">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa fa-building"></i>
					</div><a href='admin.php?vendors'><div class="mr-5">Restaurant Locations: <?=count($_SESSION['vendors'])?></div></a>
				</div>
				<div  id="vendors" class="card-footer text-white clearfix small z-1" style="color:white"><span id="ve" class="float-left">Add Shop</span> 
				<span class="float-right"><i class="fas fa-angle-right"></i></span></div>
			</div>
		</div>
	    
		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-info o-hidden h-100" style="<?=isset($_GET['employees']) ? 'border: 2px black solid' : 'border: 0'?>">
				<div class="card-body">
				    <div class="card-body-icon">
						<i class="fas fa-fw fa fa-id-badge"></i>
					</div><a href='admin.php?employees'><div class="mr-5">Employees: <?=count($_SESSION['employees'])?></div></a>
				</div>
                <div id="employees" class="card-footer text-white clearfix small z-1" style="color:white"><span id="em" class="float-left">Add Employee</span> 
				<span class="float-right"><i class="fas fa-angle-right"></i></span></div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-success o-hidden h-100" style="<?=isset($_GET['order_item']) ? 'border: 2px black solid' : 'border: 0'?>">
				<div class="card-body">
				    <div class="card-body-icon">
						<i class="fas fa-fw fa-shopping-cart"></i>
					</div><a href='admin.php?order_item'><div class="mr-5">Order Items: <?=count($_SESSION['order_item'])?></div></a>
				</div>
                <div id="order_item" class="card-footer text-white clearfix small z-1" style="color:white"><span id="em" class="float-left"></span> 
				<span class="float-right"><i class="fas fa-angle-right"></i></span></div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-primary o-hidden h-100" style="<?=isset($_GET['products']) ? 'border: 2px black solid' : 'border: 0'?>">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw  fa fa-list-ol"></i>
					</div><a href='admin.php?products'><div class="mr-5">Products: <?=count($_SESSION['products'])?></div></a>
				</div>
				<div id="products"  class="card-footer text-white clearfix small z-1" style="color:white"><span id="pr" class="float-left">Add Product</span> 
				<span class="float-right"><i class="fas fa-angle-right"></i></span></div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-dark o-hidden h-100" style="<?=isset($_GET['promotions']) ? 'border: 2px black solid' : 'border: 0'?>">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw far fa-list-alt"></i>
					</div><a href='admin.php?promotions'><div class="mr-5">Promotions:<?=count($_SESSION['promotions'])?> </div></a>
				</div>
				<div id="promotions"  class="card-footer text-white clearfix small z-1" style="color:white"><span id="in" class="float-left">Add Promotion</span> 
				<span class="float-right"><i class="fas fa-angle-right"></i></span></div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-secondary o-hidden h-100" style="<?=isset($_GET['ratings']) ? 'border: 2px black solid' : 'border: 0'?>">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa fa-clipboard"></i>
					</div><a href='admin.php?ratings'><div class="mr-5">Ratings:<?=count($_SESSION['ratings'])?> </div></a>
				</div>
				<div id="ratings"  class="card-footer text-white clearfix small z-1"  style="color:white"><span id="pr" class="float-left"></span> 
				<span class="float-right"><i class="fas fa-angle-right"></i></span></div>
			</div>
		</div>
    
		<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card text-white bg-success o-hidden h-100" style="<?=isset($_GET['order']) ? 'border: 2px black solid' : 'border: 0'?>">
				<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa fa-credit-card"></i>
					</div><a href='admin.php?order'><div class="mr-5">Sales: <?=count($_SESSION['order'])?> </div></a>
				</div>
				<a id="order"  class="card-footer text-white clearfix small z-1"  style="color:white"><span id="pr" class="float-left"></span> 
				<span class="float-right"><i class="fas fa-angle-right"></i></span></a>
			</div>
		</div>
	</div>

	
	<div class="container-fluid">
        <div class="card" style="background-color: beige; border: 4px groove black">
        	<div class="card-body"><?=db::table($data ?? [])?><!-- That's the table. the = sign there means go php and echo -->
            	<div class="card-footer small text-muted" id="last">Updated <script>$('#last').html((new Date()))</script></div>
            </div>
        </div>
    </div>
    
    <!--begin "off-camera" forms, aka sliders-->

    <div class="container-fluid" id="employee">
		<div class="card card-login mx-auto mt-5">
			<div class="card-header">New Employee</div>
			<div class="card-body">
				<form action="index.php" method="post">
					<div class="form-group">
						<label for="name">Name</label><input class="form-control" name="name" required="" type="text">
					</div>
					<div class="form-group">
						<label for="email">Email</label><input class="form-control" name="email" required="" type="text">
					</div>
					<div class="form-group">
						<label for="phone">Phone Number</label><input class="form-control" name="phone" required="" type="text">
					</div>
					<div class="form-group">
						<label for="wage">Hourly Wage</label><input class="form-control" name="wage" required="" type="text">
					</div>
					<div class="form-group">
						<label for="vendor">Shop</label><select name="vendor"><?foreach($_SESSION['vendors'] as $v) echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';?></select>
					</div>
					<button class="btn btn-primary"  style="float: right" type="submit">Submit</button>
 					<button class="btn btn-primary" onclick="cancel()" style = "float: left" type="button">Cancel</button>
				</form>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="vendor">
		<div class="card card-login mx-auto mt-5">
			<div class="card-header">New Shop</div>
			<div class="card-body">
				<form action="index.php" method="post">
					<div class="form-group">
						<label>Shop Name</label> <input class="form-control" name="name" required="" type="text">
						<label>Shop Address</label><input class="form-control" name="address" required="" type="text">
						<label>Shop Details</label><input class="form-control" name="details" required="" type="text">
					</div>
					<button class="btn btn-primary" style="float: right" type="submit">Submit</button>
 					<button class="btn btn-primary" onclick="cancel()" style = "float: left" type="button">Cancel</button>
				</form>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="promotion">
		<div class="card card-login mx-auto mt-5">
			<div class="card-header">New Promotion</div>
			<div class="card-body">
				<form action="index.php" method="post">
					<div class="form-group">
						<label>Product Name</label> <select name="name"><?foreach($_SESSION['products'] as $v) echo '<option value="'.$v['name'].'">'.$v['name'].'</option>';?></select>
					</div>
					<div class="form-group">
						<label>Product Discount Percentage</label><input class="form-control" name="discount" required="" type="text">
					</div>
					<div class="form-group">
						<label>Promotion Details</label> <input class="form-control" name="details" required="" type="text">
					</div>
					<div class="form-group">
						<label>Quantity</label> <input class="form-control" name="quantity" required="" type="text">
					</div>
					<div class="form-group">
						<label>Shop</label>  <select name="vendor"><?foreach($_SESSION['vendors'] as $v) echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';?></select>
					</div>
										<div class="form-group">
						<label>Product Id</label>  <select name="productId"><?foreach($_SESSION['products'] as $v) echo '<option value="'.$v['id'].'">'.$v['id'].'</option>';?></select>
					</div>
					<button class="btn btn-primary" style="float: right" type="submit">Submit</button>
 					<button class="btn btn-primary" onclick="cancel()" style = "float: left" type="button">Cancel</button>
				</form>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="product">
		<div class="card card-login mx-auto mt-5">
			<div class="card-header">New Product</div>
			<div class="card-body">
				<form action="insert_product.php" method="post" enctype="multipart/form-data">
				    
					<div class="form-group">
						<label>Product Name</label> <input class="form-control" name="name" required="" type="text">
					</div>
					<div class="form-group">
						<label>Product Cost</label><input class="form-control" name="cost" required="" type="text">
					</div>
					<div class="form-group">
						<label>Product Details</label> <input class="form-control" name="details" required="" type="text">
					</div>
					<div class="form-group">
						<label>Product Picture</label> <input class="form-control" name="picture" required="" type="file">
					</div>
					<div class="form-group">
						<label>Product Shop</label><select name="vendor"><?foreach($_SESSION['vendors'] as $v) echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';?></select>
					</div>
					<button class="btn btn-primary" style="float: right" type="submit">Submit</button>
 					<button class="btn btn-primary" onclick="cancel()" style = "float: left" type="button">Cancel</button>
				</form>
			</div>
		</div>
	</div>

	<!--end "off-camera" forms, aka sliders--><script>
var update; //global object literal used to build a postString for ajax updates to table fields/data
function asyncUpdate(confirm) {
    if (confirm === 0) update = null;
    if (!update) {$('form').remove(); window.location.reload();}
    update.value = $('#value').val();
    var ps = 'table='+'<?=$view?>'+'&where='+update.where+'&field='+update.field+'&value='+update.value;
    $('form').remove(); update = {};
    $.ajax({
        url: 'index.php', type: 'POST', data: ps,
        success: function(result) {window.location.reload();},
        failure: function(data, status, error) {console.log(data, error.stack); alert(status)},
        complete: function(data, status) {console.log(data, status);}
    });
}

//td as in table cell. this is the listener that creates the update form when clicked on. very cool!
$('td').click(function(pos) {
    if (!update) {
        console.log(update);
        let p = pos.target.parentNode;
    	let id = p.cells[0].innerHTML;
    	let c = pos.target.firstChild;
    	let value = c ? c.data : '';
    	let field = pos.target.id;
        update = {table: '<?=$view?>', field: field, value: value, where: id};
     	pos.target.innerHTML = '<form><input hidden type="text" name="'+update.table+
        '" value="'+update.where+'"><input hidden type="text" name="field" value="'+update.field+
        '"><input id="value" type="text" name="value" value="'+update.value+
        '"><br><button type="button" onclick="asyncUpdate(0)" style="float:left">CANCEL</button>'+
        '<button id="update" onclick="asyncUpdate(1)" type="button">UPDATE</button></form>';
    }
});

//i gave up writing a universal version of this because it involves too many specific conditions.
//the end result is: forms slide in and out when summoned, slide out when another is clicked,
//or when the cancel button is hit, or when escape is hit. it's ugly, but it works like a charm.

var employeeUpdateFormUp = false;
$("#employees").click(function() {
    if (employeeUpdateFormUp) {
        $('#employee').animate({left: "420vw"});
        $('#em').html('Add Employee');
        employeeUpdateFormUp = false;
        return;
    }
    $('#em').html('Cancel');
    $('#ve').html('Add Vendor');
    $('#pr').html('Add Product');
    $('#in').html('Add Promotion');
    $('#employee').animate({left: "1vw"});
    $('#vendor').animate({left: "420vw"});
    $('#product').animate({left: "420vw"});
    $('#promotion').animate({left: "420vw"});
    employeeUpdateFormUp = true;
});
var vendorUpdateFormUp = false;
$("#vendors").click(function() {
    if (vendorUpdateFormUp) {
        $('#vendor').animate({left: "420vw"});
        $('#ve').html('Add Vendor');
        vendorUpdateFormUp = false;
        return;
    }
    $('#em').html('Add Employee');
    $('#ve').html('Cancel');
    $('#pr').html('Add Product');
    $('#in').html('Add Promotion');
    $('#vendor').animate({left: "1vw"});
    $('#employee').animate({left: "420vw"});
    $('#product').animate({left: "420vw"});
    $('#promotion').animate({left: "420vw"});
    vendorUpdateFormUp = true;
});
var productUpdateFormUp = false;
$("#products").click(function() {
    if (productUpdateFormUp) {
        $('#product').animate({left: "420vw"});
        $('#pr').html('Add Product');
        productUpdateFormUp = false;
        return;
    }
    $('#em').html('Add Employee');
    $('#ve').html('Add Vendor');
    $('#in').html('Add Promotion');
    $('#pr').html('Cancel');
    $('#product').animate({left: "1vw"});
    $('#employee').animate({left: "420vw"});
    $('#vendor').animate({left: "420vw"});
    $('#promotion').animate({left: "420vw"});
    productUpdateFormUp = true;
});
var promotionUpdateFormUp = false;
$("#promotions").click(function() {
    if (promotionUpdateFormUp) {
        $('#promotion').animate({left: "420vw"});
        $('#in').html('Add Promotion');
        promotionUpdateFormUp = false;
        return;
    }
    $('#em').html('Add Employee');
    $('#ve').html('Add Vendor');
    $('#pr').html('Add Product');
    $('#in').html('Cancel');
    $('#promotion').animate({left: "1vw"});
    $('#employee').animate({left: "420vw"});
    $('#vendor').animate({left: "420vw"});
    $('#product').animate({left: "420vw"});
    promotionUpdateFormUp = true;
});
function cancel() {
    $('#em').html('Add Employee');
    $('#ve').html('Add Vendor');
    $('#pr').html('Add Product');
    $('#in').html('Add Promotion');
    $('#employee').animate({left: "420vw"});
    $('#vendor').animate({left: "420vw"});
    $('#product').animate({left: "420vw"});
    $('#promotion').animate({left: "420vw"});
}
$(document).keyup(function(e) {
     if (e.key === "Escape") {cancel();}
});

	$(document).ready(function() {
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        hover: true,
        responsive: true,
        select: true
    });
});</script>


    <!-- Bootstrap core JavaScript -->

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
	<footer class="py-5 bg-dark">
      <div class="container"left = "0" >
        <p class="m-0 text-center text-white">Copyright &copy; iSnack 2018</p>
      </div>
      <!-- /.container -->
    </footer>
</html>
