<?php

$tracking_id =  $_GET['tracking_id'];

if(!isset($_GET['tracking_id'])){
    header('Location: index.html');
    exit();
}
require './api/config/db.php';
require './api/core/index.php';

$db = new Database();
$conn = $db->getConnection();

$courier = new Courier($conn);

$data = $courier->search($tracking_id)->fetchAll(PDO::FETCH_ASSOC);
// var_dump($data);
extract($data[0])
?>

<!DOCTYPE html>
<html lang="zxx">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>Shipment Details :: FedEx</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/owl.theme.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css" media="screen" property="" />
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">
</head>

<body>
<body>
    <div class="mian-content inner-page">
        <div class="header-top-w3layouts">
            <div class="container">

                <header>
                    <div class="top-head-w3-agile text-left">
                        <div class="row top-content-info-wthree">
                            <div class="col-lg-5 top-content-left">
                                <!-- <h6>Have any Quastions?</h6> -->
                            </div>
                            <div class="col-lg-7 top-content-right">
                                <div class="row">
                                    <div class="col-md-6 callnumber text-left">
                                        <!-- <h6>Call Us : <span>1234567890</span></h6> -->
                                    </div>
                                    <div class="col-md-6 top-social-icons p-0">
                                        <ul class="social-icons d-flex justify-content-end">
                                            <li class="mr-1"><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                            <li class="mx-1"><a href="#"><span class="fab fa-twitter"></span></a></li>
                                            <li class="mx-1"><a href="#"><span class="fab fa-google-plus-g"></span></a></li>
                                            <li class="mx-1"><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="logo text-left">
                            <h1>
                                <a class="navbar-brand" href="index.html">
                            <img src="images/logo.png" height="50"/>
                            </a>
                            </h1>
                        </div>

                    </nav>
                </header>
            </div>
        </div>

    </div>
    <!--//banner-->
    <!-- /breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active"><?=$_GET['tracking_id']?></li>
    </ol>
    <!-- //breadcrumb -->
    <!--/pricing -->
    <section class="pricing py-md-5 py-3">
        <div class="container">
            <!---728x90--->

            <div class="inner-sec-w3layouts py-md-5 py-3">
                <!--/row-one-->
                <div class="row">
                    <div class="col-lg-3 price-left mt-lg-5 mt-2">
                        <h2 class="tittle text-left mb-md-5 mb-4">Details For <?=$_GET['tracking_id']?></h2>
                        <!-- <p>Lorem ipsum dolor sit amet Neque porro quisquam est qui dolorem Lorem int ipsum dolor sit amet when an unknown printer took a galley of type.Vivamus id tempor felis.ivamus id tempor felis. </p> -->
                        <div id="bar_code">
                        <img src="http://www.barcodes4.me/barcode/c128b/AnyValueYouWish.gif" alt="barcode" height="50">
                        </div>

                    </div>
                    <div class="col-lg-9 price-right">

                        <div class="tabs">
                            
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="menu-grids mt-4">
                                        <div class="row t-in">
                                            <div class="col-md-6 price-main-info text-center">
                                                <div class="price-inner card box-shadow">

                                                    <div class="card-body">
                                                        <h4 class="text-uppercase mb-3">Senders Details</h4>
                                                        <h5 class="card-title pricing-card-title">
                                                            <!-- <span class="align-top">$</span>30 -->

                                                        </h5>
                                                        <ul class="list-unstyled mt-3 mb-4">
                                                        <!-- loop senders detials here -->
                                                            
                                                         <li>   <?='First-Name: '.$shipper_first_name?></li>
                                                          <li>  <?='Last-Name: '.$shipper_last_name?></li>
                                                          <li>  <?='Address: '.$shipper_address?></li>
                                                          <li>  <?='Telephone: '.$shipper_number?></li>
                                                           <li> <?='Email: '.$shipper_email?></li>
                                                           <li> <?='Country: '.$shipper_country?></li>



                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 price-main-info text-center">
                                                <div class="price-inner card box-shadow">

                                                    <div class="card-body">
                                                        <h4 class="text-uppercase mb-3">Receievers Details</h4>
                                                        <h5 class="card-title pricing-card-title">
                                                            <!-- <span class="align-top">$</span>90 -->

                                                        </h5>
                                                        <ul class="list-unstyled mt-3 mb-4">
                                                                                                                       
                                                         <li>   <?='First-Name: '.$receiver_first_name?></li>
                                                          <li>  <?='Last-Name: '.$receiver_last_name?></li>
                                                          <li>  <?='Address: '.$receiver_address?></li>
                                                          <li>  <?='Telephone: '.$receiver_number?></li>
                                                           <li> <?='Email: '.$receiver_email?></li>
                                                           <li> <?='Country: '.$receiver_country?></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--//row-one-->
              
                <!--row-two-->
                <div class="row mt-lg-5 mt-3">

                    <div class="col-lg-12 price-right">

                        <div class="tabs">
                        
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home1" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="menu-grids mt-4">
                                        <div class="row t-in">
                                            <div class="col-md-12 price-main-info">
                                                <div class="price-inner card box-shadow">

                                                    <div class="card-body">
                                                        <h4 class="text-uppercase mb-3">Package Information</h4>
                                                     

                                                        <ul class="list-unstyled mt-3 mb-4">
                                                                                                                                                                                   
                                                         <li>   <?='Number of Items: '.$no_of_pakages?></li>
                                                          <li>  <?='Destination : '.$package_destination?></li>
                                                          <li>  <?='FedEx: '.$package_carrier?></li>
                                                          <li>  <?='Shipment Mode: '.$shipment_mode?></li>
                                                           <li> <?='Weight: '.$package_weight?></li>
                                                           <li> <?='Reference Number: '.$package_reference_no?></li>

                                                           <li>  <?='Contents : '.$items_specified?></li>
                                                          <li>  <?='Payment Method: '.$payment_mode?></li>
                                                          <li>  <?='Delivery Date: '.$expected_delivery_date?></li>
                                                           <li> <?='Time of Departure: '.$departure_time?></li>
                                                           <li> <?='Date of Departure: '.$departure_date?></li>

                                                           <li> <?='Delivery Date: '.$pick_up_date?></li>
                                                           <li> <?='Extra Comments: '.$comments?></li>
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                    </div>
                  
                </div>
                <!--//row-two-->
            </div>
        </div>
    </section>
    <!-- //pricing -->
    <!---728x90--->

<!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".dropdown").hover(
                function() {
                    $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                    $(this).toggleClass('open');
                },
                function() {
                    $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                    $(this).toggleClass('open');
                }
            );
        });
    </script>

    <!--/ start-smoth-scrolling -->
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 900);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            /*
            						var defaults = {
            							  containerID: 'toTop', // fading element id
            							containerHoverID: 'toTopHover', // fading element hover id
            							scrollSpeed: 1200,
            							easingType: 'linear' 
            						 };
            						*/

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <!--// end-smoth-scrolling -->
    <!-- jQuery-Photo-filter-lightbox-Gallery-plugin -->
    <!-- /js -->
    <script src="js/bootstrap.js"></script>
    <!-- //js -->
</body>
</html>