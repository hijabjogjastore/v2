<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="<?php include("meta_keyword.php"); ?>">
    <meta name="description" content="<?php include("meta_deskripsi.php"); ?>">
    <meta name="author" content="hijabjogjastore">
    <link rel="icon" href="assets/images/favicon.ico">
    <title><?php include "title.php"; ?></title>

    <script>
        var home_base = 'http://www.hijabjogjastore.com/';
        var isQuickCheckout = false;
        var suppressPopup = false;
        var autoRedeemEmail = 'email@gmail.com';
        var autoRedeemCode = '';
        var isAutoRedeem = false;
    </script>

    <script src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/quirksmode.js"></script>
    <!--  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/slidebars.css" rel="stylesheet">
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    <link href="assets/css/owl.carousel.css" rel="stylesheet">
    <link href="assets/css/owl.theme.css?v=0.2.34" rel="stylesheet">
    <link href="assets/css/bootstrap-slider.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/app.css?v=0.2.34" rel="stylesheet">
    <!-- Google Font -->
    <link href='//fonts.googleapis.com/css?family=Marcellus+SC' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,400italic,700' rel='stylesheet' type='text/css'>
    <!-- tabahan -->
    <!-- <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- tambahan end -->
    <script type="text/javascript">
/*        var _kmq = _kmq || [];
        var _kmk = _kmk || '5cf3d9fd9a41cdec5d39b09bb2f8f6364e9e7ce6';*/
    </script>
</head>
<!-- NAVBAR
    ================================================== -->

<body class="row-offcanvas row-offcanvas-left">

   <?php
   include("well_inc/header.php");
   ?>
   <!-- content start -->
   <?php 
  include("well_inc/content.php");
   //include("well_cont/product.php");  //OK
   
  // include("well_cont/product-detail.php"); //OK

   //include("well_cont/cart.php"); //OK
   // include("well_cont/cart-kosong.php");  //OK
   
    //include("well_cont/login.php"); //OK

   //include("well_cont/checkout-address.php"); //OK
   //include("well_cont/checkout-payment.php");
   //include("well_cont/checkout-tanks.php"); //OK

   //include("well_cont/konfirmasi.php");  //OK
   //include("well_cont/checkout-confirm.php"); //OK
   //include("well_cont/form-lacak-pesanan.php"); // OK
   //include("well_cont/hasil-lacak-pesanan.php"); //OK

   ?>
   <!-- content end  -->
    <?php
    include("well_inc/footer.php");
    include("well_inc/slidebar.php");
    ?>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.validate.min.js?v=0.2.34"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/countdown.js"></script>
    <script src="assets/js/slidebars.js?v=0.2.34"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
    <script src="assets/js/app.min.js?v=0.2.34"></script>
</body>
<html>