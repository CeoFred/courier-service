<?php
session_start();
$name = $_SESSION['first_name'];
$tracking_id = isset($_GET['tracking_id']) ? $_GET['tracking_id'] : null;
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

if(is_null($tracking_id)){
    header('Location: addCourier.php');
    die();
}

$query = $courier->search($tracking_id);

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$tracking_data = isset($res) ? $res[0] : null;
if(!$tracking_data){
    die('Nothing Found!');
}
$p = extract($tracking_data);

?>

<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
 <meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="../assets/img/favicon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title>View Courier <?=$tracking_id?></title>

<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

<!--     Fonts and icons     -->

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

<link rel="stylesheet" href="../assets/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- CSS Files -->

<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />




<link href="../assets/css/now-ui-dashboard.min290d.css?v=1.4.1" rel="stylesheet" />

<!-- CSS Just for demo purpose, don't include it in your project -->
<link href="../assets/demo/demo.css" rel="stylesheet" />

<style>
#trackid_ {
  display: none;
}

</style>
    </head>

    <body class=" sidebar-mini ">
        <div class="wrapper ">
          
            <div class="sidebar" data-color="orange">

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
                <img src="./assets/img/dafault-avatar.png" alt="photo"/>
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
            <input type="text" value="<?=$tracking_id?>" id="trackid_">

            <a class="navbar-brand" href="#pablo">Courier Package - <?=$tracking_id?></a>
            
<button onclick="copyToClipboard(<?=$tracking_id?>)" type="button" class="btn btn-fill btn-rounded btn-primary">Copy</button>

		</div>
        <script>
const copyToClipboard = str => {
  const el = document.createElement('textarea');
  el.value = str;
  el.setAttribute('readonly', '');
  el.style.position = 'absolute';
  el.style.left = '-9999px';
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
  alert('copied!')
};

</script>

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

<div class="row">

<div class="col-md-6">
    

    <div class="card-header ">
    <h4 class="card-title">Receivers Details</h4>
    </div>
    
    <div class="card-body ">

                                <label>First Name</label>
                                <div class="form-group">
                                    <input id="receiver_first_name" value=<?=$receiver_first_name?> type="text" class="form-control">
                                </div>
                                <label>Last Name</label>
                                <div class="form-group">
                                    <input id="receiver_last_name" value=<?=$receiver_last_name?> type="text" class="form-control">
                                </div>
    
                                <label>Address</label>
                                <div class="form-group">
                                <textarea id="receiver_address" class="form-control" rows="10"><?=$receiver_address?></textarea>
                                </div>
                                <label>Email</label>
                                <div class="form-group">
                                    <input id="receiver_email" value=<?=$receiver_email?> type="email" class="form-control">
                                </div>
                                
                                <label>Phone Number</label>
                                <div class="form-group">
                                    <input id="receiver_number" value=<?=$receiver_number?> type="text" class="form-control">
                                </div>
                                
                                <label>Country</label>
                                <div class="form-group"> 
                                    <input id="receiver_country" value=<?=$receiver_country?> type="text" class="form-control">
                                </div>
        

        
    </div>
    
    
</div>

<div class="col-md-6">
    

    <div class="card-header ">
    <h4 class="card-title">Shippers Details</h4>
    </div>
    
    <div class="card-body ">

                                <label>First Name</label>
                                <div class="form-group">
                                    <input id="shipper_first_name" value="<?=$shipper_first_name?>" type="text" class="form-control">
                                </div>

                                <label>Last Name</label>
                                <div class="form-group">
                                    <input id="shipper_last_name" value=<?=$shipper_last_name?> type="text" class="form-control">
                                </div>
    
                                <label>Address</label>
                                <div class="form-group">
                                <textarea id="shipper_address" class="form-control" rows="10"><?=$shipper_address?></textarea>
                                </div>

                                <label>Email</label>
                                <div class="form-group">
                                    <input id="shipper_email" value=<?=$shipper_email?> type="email" class="form-control">
                                </div>
                                
                                <label>Phone Number</label>
                                <div class="form-group">
                                    <input id="shipper_number" value=<?=$shipper_number?> type="text" class="form-control">
                                </div>
                                
                                <label>Country</label>
                                <div class="form-group">
                                    <input id="shipper_country" value=<?=$shipper_country?> type="text" class="form-control">
                                </div>
        

        
    </div>
       </div>

</div>

<div class="col-md-12">
    
<div class="card-header ">
    <h4 class="card-title">Package Details</h4>
    </div>
    
    <div class="card-body ">

                                <label>Number Packages</label>
                                <div class="form-group">
                                    <input value="<?=$no_of_pakages?>" id="no_of_pakages" type="text" class="form-control">
                                </div>

                                <label>Destination</label>
                                <div class="form-group">
                                    <input value="<?=$package_destination?>" id="package_destination" type="text" class="form-control">
                                </div>
    
                                <label>Weight</label>
                                <div class="form-group">
                                    <input value="<?=$package_weight?>" id="package_weight" type="text" class="form-control">
                                </div>
                                <label>Shipping Mode</label>
                                <div class="form-group">
                                    <input value="<?=$shipment_mode?>" id="shipment_mode" type="email" class="form-control">
                                </div>
                                
                                <label>Specify Items Here</label>
                                <div class="form-group">
                                    <textarea id="items_specified" class="form-control"><?=$items_specified?></textarea>
                                  </div>
                                
                                <label>Payment Mode</label>
                                <div class="form-group">
                                    <input value="<?=$payment_mode?>" id="payment_mode" type="text" class="form-control">
                                </div>
                                
                                <label>Delivery Date</label>
                                <div class="form-group">
                                    <input value="<?=$expected_delivery_date?>" id="expected_delivery_date" type="date" class="form-control">
                                </div>
                                
                                <label>Departure Date</label>
                                <div class="form-group">
                                    <input value="<?=$departure_date?>" id="departure_date" type="date" class="form-control">
                                </div>

                                <label >Departure Time</label>
                                <div class="form-group">
                                    <input type="time" id="departure_time" value="<?=$departure_time?>" class="form-control" >
                                </div>

                                <label>Pick Up Time</label>
                                <div class="form-group">
                                    <input value="<?=$pick_up_time?>" id="pick_up_time" type="time" class="form-control">
                                </div>

                                <label>Pick Up Date</label>
                                <div class="form-group">
                                    <input value="<?=$pick_up_date?>" id="pick_up_date" type="date" class="form-control">
                                </div>

                                <label>Comments</label>
                                <div class="form-group">
                                    <textarea id="comments" id="comments" class="form-control" rows="10"><?=$comments?></textarea>
                                </div>
                                <div class="form-group">
                                    <input value="<?=$tracking_id?>" id="trackid" type="hidden" class="form-control">
                                </div>


        
    </div>
       </div>
       
<div id="error_messages" style="color:red;font-size:20px">

</div>

<div id="success_messages" style="color:teal">

</div>
       <div class="card-footer ">
        <button type="button" class="btn btn-fill btn-rounded btn-secondary" id="update_corrier">Update</button>
    </button>
    </div>
    
</div>
</div>


</div>
                  </div>


               
             </div>
          
        </div>
       

<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.min.js" ></script>
<script src="../assets/js/core/popper.min.js" ></script>
<script src="../assets/js/core/bootstrap.min.js" ></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js" ></script>
<script src="../assets/js/now-ui-dashboard.min290d.js?v=1.4.1" type="text/javascript"></script>

<script>

let messageContainer = document.getElementById('error_messages')
  let successContainer = document.getElementById('success_messages')

  const updated_btn = document.getElementById('update_corrier')
  updated_btn.addEventListener('click',updateCourier)


// update courier
function updateCourier(){
    updated_btn.innerHTML = 'Working....'
    data = {
    no_of_pakages:no_of_pakages.value,
    package_destination:package_destination.value,
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
    tracking_id:"<?=$tracking_id?>",
    receiver_email:receiver_email.value,
    receiver_address:receiver_address.value,
    receiver_first_name:receiver_first_name.value,
    receiver_last_name:receiver_last_name.value,
    receiver_country:receiver_country.value,
    receiver_number:receiver_number.value,
    shipper_email:shipper_email.value,
    shipper_address:shipper_address.value,
    shipper_first_name:shipper_first_name.value,
    shipper_last_name:shipper_last_name.value,
    shipper_country:shipper_country.value,
    shipper_number:shipper_number.value
    }

// (data)

for (const key in data) {
    if (data.hasOwnProperty(key)) {
        const element = data[key];
        if((element.trim()).length <= 0){
            window.scrollTo(0,0)
          messageContainer.innerHTML = `${key} was left empty`
            updated_btn.innerHTML= 'Retry'

            return false;
        }
    }
}


const url = '/api/courier/update.php';
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
}).done(res => {
    messageContainer.innerHTML = ''
    successContainer.innerHTML = `Package has been Updated! Refreshing please wait..`
    updated_btn.innerHTML= 'Updated!'
    setTimeout(() => {
        window.location.reload();

    }, 2000);

}).fail(err => {
    messageContainer.innerHTML = ''
    messageContainer.innerHTML = err.responseText || err.responseJSON.message
    updated_btn.innerHTML= 'Retry'
})
}

</script>
</body>
</html>
