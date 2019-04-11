<?php
require_once'db.php';
?>
<!DOCTYPE html>
 
<html lang="en">
 
<head>
 
<meta charset="utf-8">
 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
<meta name="description" content="">
 
<meta name="author" content="">
 
<title>iSnack Admin </title>
 
<!-- Bootstrap core CSS-->
 
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" rel="stylesheet">
 
<!-- Custom fonts for this template-->
 
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
 
<!-- Custom styles for this template-->
 
<link href="css/sb-admin.css" rel="stylesheet">
<style>
    body { 
    padding-top: 75px; 
}
</style> 
</head>
 
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    
    
 
<!-- Navigation-->
 
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
 
<a class="navbar-brand" href="index.php">iSnack</a>
 
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
 
<span class="navbar-toggler-icon"></span>
 
</button>
 
<div class="collapse navbar-collapse" id="navbarResponsive">
 

 
<ul class="navbar-nav sidenav-toggler">
 
<li class="nav-item">
 
<a class="nav-link text-center" id="sidenavToggler">
 
<i class="fa fa-fw fa-angle-left"></i>
 
</a>
 
</li>
 
</ul>
 
<ul class="navbar-nav ml-auto">

 
<li class="nav-item">
 
<a class="nav-link" data-toggle="modal" data-target="#exampleModal">
 
<i class="fa fa-fw fa-sign-out"></i>Logout</a>
 
</li>
 
</ul>
 
</div>
 
</nav>
 
<div class="content-wrapper">
 
<div class="container-fluid">
 
<!-- Breadcrumbs-->
 
<ol class="breadcrumb">
 
<li class="breadcrumb-item">
 
<a href="admin.php">Dashboard</a>
 
</li>
 
<li class="breadcrumb-item active">Delete Items Page</li>
 
</ol>
 
<div class="row">
 
<div class="col-12">
    
<script>
function alertFunction() {
  alert("Item Deleted");
}
</script>
 

 
</div>
 
<div class="col-md-8">
 
<form action="index.php" method="post">
 
<div class="form-group">
 
<label style="color:white;">Select Promotion  </label></br>
<select name="id"><?foreach($_SESSION['promotions'] as $v) echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';?></select>
 

 
</div>
 
 
<button type="submit" class="btn btn-primary" name="reg_p" onclick="alertFunction()"  >Delete</button>
</form>
<form action="index.php" method="post">
 
<div class="form-group">
 
<label style="color:white;">Select Product </label></br>
 
<select name="productId"><?foreach($_SESSION['products'] as $v) echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';?></select>
 
</div>
 
 
<button type="submit" class="btn btn-primary" name="reg_p" onclick="alertFunction()">Delete</button>
</form>
<form action="index.php" method="post">
 
<div class="form-group">
 
<label style="color:white;">Select Employee </label></br>
 
<select name="empId"><?foreach($_SESSION['employees'] as $v) echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';?></select>
 
</div>

<button type="submit" class="btn btn-primary" name="reg_p" onclick="alertFunction()">Delete</button>
</form>
<form action="index.php" method="post">
 
<div class="form-group">
 
<label style="color:white;">Select Restaurant Location </label></br>
 
<select name="locationId"><?foreach($_SESSION['vendors'] as $v) echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';?></select>
 
</div>
 
 
<button type="submit" class="btn btn-primary" name="reg_p" onclick="alertFunction()">Delete</button>
</form>
 
</div>
 
</div>
 
</div>
 
<!-- /.container-fluid-->
 
<!-- /.content-wrapper-->
 
 
<!-- Scroll to Top Button-->
 
<a class="scroll-to-top rounded" href="#page-top">
 
<i class="fa fa-angle-up"></i>
 
</a>
 
<!-- Logout Modal-->
 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
<div class="modal-dialog" role="document">
 
<div class="modal-content">
 
<div class="modal-header">
 
<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
 
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
 
<span aria-hidden="true">×</span>
 
</button>
 
</div>
 
<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
 
<div class="modal-footer">
 
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
 
<a class="btn btn-primary" href="login.php">Logout</a>
 
</div>
 
</div>
 
</div>
 
</div>
 
<!-- Bootstrap core JavaScript-->
 
<script src="js/jquery.min.js"></script>
 
<script src="js/bootstrap.bundle.min.js"></script>
 
<!-- Core plugin JavaScript-->
 
<script src="js/jquery.easing.min.js"></script>
 
<!-- Custom scripts for all pages-->
 
<script src="js/sb-admin.min.js"></script>
 
</div>
 
</body>
 
</html>