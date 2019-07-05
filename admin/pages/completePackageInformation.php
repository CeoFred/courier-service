<?php
session_start();


$admin = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;

if(is_null($admin)){
    header('Location: login.php');
    die();
}
$name = $_SESSION['first_name'];
// get database connection
include_once '../../api/config/db.php';

// instantiate courier object
include_once '../../api/core/index.php';

$database = new Database();
$db = $database->getConnection();

$courier = new Courier($db);


$tracking_id = isset($_GET['tracking_id']) ? $_GET['tracking_id'] : null;

if(is_null($tracking_id)){
    header('Location: addCourier.php');
    die();
}

$query = $courier->search($tracking_id);
$tracking_data = $query->fetchAll(PDO::FETCH_ASSOC)[0];
$p = extract($tracking_data);
?>


<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
 <meta charset="utf-8" />
<!-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="../assets/img/favicon.png"> -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title>Update Courier</title>

<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

<!--     Fonts and icons     -->

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

<link rel="stylesheet" href="../assets/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- CSS Files -->

<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />




<link href="../assets/css/now-ui-dashboard.min290d.css?v=1.4.1" rel="stylesheet" />

<!-- CSS Just for demo purpose, don't include it in your project -->
<link href="../assets/demo/demo.css" rel="stylesheet" />

    
    </head>

    <body class=" sidebar-mini ">
        <div class="wrapper ">
          
            <div class="sidebar" data-color="orange">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->

    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            CT
        </a>

        <a href="#" class="simple-text logo-normal">
          Courier Tracker
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
                <img src="../assets/img/dafault-avatar.png" alt="photo"/>
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
                            <a href="profile.php">
                                <span class="sidebar-mini-icon">MP</span>
                                <span class="sidebar-normal">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="profile.php?edit=true">
                                <span class="sidebar-mini-icon">EP</span>
                                <span class="sidebar-normal">Edit Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <ul class="nav">
                    
              <li >

                  
                    <a href="../dashboard.php">
                      
                        <i class="now-ui-icons design_app"></i>
                      
                      <p>Dashboard</p>
                    </a>
                  
              </li>
              
              <li >

                  
                    <a href="./logout.php">
                      
                        <i class="now-ui-icons media-1_album"></i>
                      
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
      
			<a class="navbar-brand" href="#pablo">Update courier Package <?=$tracking_id?></a>
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


              

                  <div class="panel-header panel-header-sm">
  
  
</div>


                  <div class="content">
                      <div class="row">
        
<div class="card col-md-12">

<div class="col-md-6">

    <div class="card-header ">
    <h4 class="card-title">Package Details</h4>
    </div>
    
    <div class="card-body ">
    <div id="error_messages" style="color:red;font-size:20px">

</div>

<div id="success_messages" style="color:teal">

</div>

        
                                <label>Number of Items In Package</label>
                                <div class="form-group">
                                    <input id="no_of_pakages" type="text" class="form-control">
                                </div>
                                <label>Destination</label>
                                <div class="form-group">
                                    <input id="package_destination" type="text" class="form-control">
                                </div>
    
                                <label>Package Carrier</label>
                                <div class="form-group">
                                    <input id="package_carrier" type="text" class="form-control">
                                </div>
                                <label>Shipment Mode</label>
                                <div class="form-group">
                                    <input id="shipment_mode" type="email" class="form-control">
                                </div>
                                
                                <label>Weight</label>
                                <div class="form-group">
                                    <input id="package_weight" type="text" class="form-control">
                                </div>
                                
                                <label>Specify Package Items</label>
                                <div class="form-group">
                                <textarea name="" id="items_specified" cols="30" class="form-control" rows="10"></textarea>
                                </div>

                                
                                <label>Payment Mode</label>
                                <div class="form-group">
                                    <input id="payment_mode" type="text" class="form-control">
                                </div>
                                
                                <label>Expected Delivery Date</label>
                                <div class="form-group">
                                    <input id="expected_delivery_date" type="date" class="form-control">
                                </div>
                                
                                <label>Departure Date</label>
                                <div class="form-group">
                                    <input id="departure_date" type="date" class="form-control">
                                </div>
                                
                                
                                <label>Departure Time</label>
                                <div class="form-group">
                                    <input id="departure_time" type="time" class="form-control">
                                </div>


                                <label>Pickup Date</label>
                                <div class="form-group">
                                    <input id="pick_up_date" type="date" class="form-control">
                                </div>
                                
                                <label>Pickup Time</label>
                                <div class="form-group">
                                    <input id="pick_up_time" type="time" class="form-control">
                                </div>

                                <label>Comments</label>
                                <div class="form-group">
                                <textarea  id="comments" cols="30" class="form-control"rows="10"></textarea>
                                </div>

        
    </div>
    
    
</div>


<div class="card-footer ">
        <button type="submit" class="btn btn-fill btn-rounded btn-primary" id="create_co">create</button>
    </div>
    
</div>
   

</div>
                  </div>


               
             </div>
          
        </div>
    

<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.min.js" ></script>
<script src="../assets/js/core/popper.min.js" ></script>

<script>

let messageContainer = document.getElementById('error_messages')
  let successContainer = document.getElementById('success_messages')

  const courier_btn = document.getElementById('create_co')
courier_btn.addEventListener('click',createCourier)

function createCourier(){
    // console.log('Clicked!')

    courier_btn.innerHTML= 'please wait...'
    messageContainer.innerHTML = '';


 const data = {
    no_of_pakages:no_of_pakages.value,
    package_destination:package_destination.value,
    package_carrier:package_carrier.value,
    shipment_mode:shipment_mode.value,
    package_weight:package_weight.value,
    items_specified:items_specified.value,
    payment_mode:payment_mode.value,
    expected_delivery_date:expected_delivery_date.value,
    departure_time:departure_time.value,
    departure_date:departure_date.value,
    pick_up_date:pick_up_date.value,
    pick_up_time:pick_up_time.value,
    comments:comments.value,
    tracking_id:"<?=$tracking_id?>"
}

console.log(data)
// return;

for (const key in data) {
    if (data.hasOwnProperty(key)) {
        const element = data[key];
        if(element.trim().length <= 0){
            window.scrollTo(0,0)
          messageContainer.innerHTML = `${key} was left empty`
            console.error(`${key} was left empty`)
    courier_btn.innerHTML= 'create'

            return false;
        }
    }
}

const url = '/api/courier/add_package_info.php';
        var myHeaders = new Headers()
        myHeaders.append('Content-Type','Application/json')

const signupRequest = new Request(url,{
    method:'POST',
    cache:'default',
    headers:myHeaders,
    body:JSON.stringify(data),
    mode:'cors'

})


$.ajax({
    url,
    method:'POST',
    data
}).done(res => 
{
    if(res.status === 'failed'){
      messageContainer.innerHTML = res.message
    }else  if(res.status_code == 200){
        window.scrollTo(0,0)

     courier_btn.innerHTML= 'Great!..'
     successContainer.innerText = 'Courier Successfully Updated,please wait..'

     setTimeout(() => {
        window.location.replace(`/admin/pages/viewCourier.php?tracking_id=<?=$tracking_id?>&updated=true`)
         
     }, 3000);

    }

    }

).catch(err =>
{
    window.scrollTo(0,0)

    console.log(err)
messageContainer.innerHTML = err.responseJSON.message
courier_btn.innerHTML= 'Try again.'

})
}


</script>
    </body>
</html>