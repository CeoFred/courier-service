<?php
session_start();

if(!isset($_SESSION['codemon_authenticated'])){
    header('Location:pages/login.php?no_auth=true');
    die();
}

$name = $_SESSION['first_name'];

// get database connection
include_once '../api/config/db.php';

// instantiate courier object
include_once '../api/core/index.php';

$database = new Database();
$db = $database->getConnection();

$courier = new Courier($db);

$query = $courier->read();

$res = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="../assets/img/favicon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title>
Admin Dashboard
</title>

<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

<!--     Fonts and icons     -->

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

<link rel="stylesheet" href="./assets/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- CSS Files -->

<link href="./assets/css/bootstrap.min.css" rel="stylesheet" />




<link href="./assets/css/now-ui-dashboard.min290d.css?v=1.4.1" rel="stylesheet" />





<!-- CSS Just for demo purpose, don't include it in your project -->
<link href="./assets/demo/demo.css" rel="stylesheet" />

    
    </head>

    <body class=" sidebar-mini ">
          


        <div class="wrapper ">
          
            <div class="sidebar" data-color="orange">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->

    <div class="logo">
        <a href="#" class="simple-text logo-mini">
    <?=ucfirst($name[0])?>
    <?=ucfirst($name[1])?>
        </a>

        <a href="#" class="simple-text logo-normal">
<?=ucfirst($name)?>
        </a>
        
        <div class="navbar-minimize">
          <button id="minimizeSidebar" class="btn btn-simple btn-icon btn-neutral btn-round">
              <i class="now-ui-icons text_align-center visible-on-sidebar-regular"></i>
              <i class="now-ui-icons design_bullet-list-67 visible-on-sidebar-mini"></i>
          </button>
  	    </div>
        
    </div>

    <div class="sidebar-wrapper" id="sidebar-wrapper">
        
        <div class="user">
            <div class="photo">
                <img src="./assets/img/default-avatar.png" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        <?=$name?>
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="#">
                                <span class="sidebar-mini-icon">MP</span>
                                <span class="sidebar-normal">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="sidebar-mini-icon">EP</span>
                                <span class="sidebar-normal">Edit Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <ul class="nav">
          

          


          
            
              
              <li  class="active" >

                  
                    <a href="dashboard.php">
                      
                        <i class="now-ui-icons design_app"></i>
                      
                      <p>Dashboard</p>
                    </a>
                  
              </li>

              
              <li >

                  
                    <a href="pages/all.php">
                      
                        <i class="now-ui-icons business_chart-pie-36"></i>
                      <p>All Couriers</p>
                    </a>
                  
              </li>
              
              
              
              <li >

                  
                    <a href="./pages/logout.php">
                      
                        <i class="now-ui-icons objects_key-25"></i>
                      
                      <p>Logout</p>
                    </a>
                  
              </li>
              
              
            
          
        </ul>
        
    </div>
</div>


            <div class="main-panel" id="main-panel">
              <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
	<div class="container-fluid">
    <div class="navbar-wrapper">
      
			<div class="navbar-toggle">
				<button type="button" class="navbar-toggler">
					<span class="navbar-toggler-bar bar1"></span>
					<span class="navbar-toggler-bar bar2"></span>
					<span class="navbar-toggler-bar bar3"></span>
				</button>
			</div>
      
			<a class="navbar-brand" href="#pablo">Dashboard</a>
		</div>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-bar navbar-kebab"></span>
			<span class="navbar-toggler-bar navbar-kebab"></span>
			<span class="navbar-toggler-bar navbar-kebab"></span>
		</button>

	    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      
       

<ul class="navbar-nav">

  <li class="nav-item">
    <a class="nav-link" href="#pablo">
      <i class="now-ui-icons users_single-02"></i>
      <p>
        <span class="d-lg-none d-md-block">Account</span>
      </p>
    </a>
  </li>
</ul>

        
      

      
	    </div>
	</div>
</nav>
<!-- End Navbar -->


              

                  <div class="panel-header">
  <div style="text-align:center;font-size:30px;color:#fff">
      Welcome, <?=ucfirst($name)?>
  </div>

</div>


                  <div class="content">
                      















<div class="row">
    <div class="col-md-12">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="statistics">
                            <div class="info">
                                <div class="icon icon-primary">
                                    <i class="now-ui-icons ui-2_chat-round"></i>
                                </div>
                                <h3 class="info-title"><?=count($res)?></h3>
                                <h6 class="stats-title">Couriers</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="statistics">
                            <div class="info">
                                <div class="icon icon-success">
                                    <i class="now-ui-icons objects_support-17"></i>
                                </div>
                                <h3 class="info-title"></h3>
        <a href="pages/addCourier.php" class="btn btn-success btn-round btn-lg" >New Courier</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    <div class="card-footer ">

                        <div class="pull-right">
                           <h6><a href="https://google.com" class="link footer-link">Need Help?</a></h6>
                        </div>
    </div>

        </div>
    </div>
</div>



                  </div>

                  <footer class="footer" >
    
    <div class=" container-fluid ">
       
        <div class="copyright" id="copyright">
            <!-- &copy; <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>, Designed by <a href="https://www.invisionapp.com/" target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com/" target="_blank">Creative Tim</a>. -->
        </div>
    </div>
    


</footer>

               
             </div>
          
        </div>
       
    


<!--   Core JS Files   -->
<script src="./assets/js/core/jquery.min.js" ></script>
<script src="./assets/js/core/popper.min.js" ></script>
<script src="./assets/js/core/bootstrap.min.js" ></script>
<script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js" ></script>
<script src="./assets/js/now-ui-dashboard.min290d.js?v=1.4.1" type="text/javascript"></script>

    </body>
</html>
