<?php
session_start();

$name= $_SESSION['first_name'];
?>

<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
 <meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="../assets/img/favicon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title>New Courier</title>

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
      
			<a class="navbar-brand" href="#pablo">Create A courier Package</a>
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
    <h4 class="card-title">Receivers Details</h4>
    </div>
    
    <div class="card-body ">
        

        

        

        
                                <label>First Name</label>
                                <div class="form-group">
                                    <input id="receiver_first_name" type="text" class="form-control">
                                </div>
                                <label>Last Name</label>
                                <div class="form-group">
                                    <input id="receiver_last_name" type="text" class="form-control">
                                </div>
    
                                <label>Address</label>
                                <div class="form-group">
                                    <input id="receiver_address" type="text" class="form-control">
                                </div>
                                <label>Email</label>
                                <div class="form-group">
                                    <input id="receiver_email" type="email" class="form-control">
                                </div>
                                
                                <label>Phone Number</label>
                                <div class="form-group">
                                    <input id="receiver_number" type="text" class="form-control">
                                </div>
                                
                                <label>Country</label>
                                <div class="form-group">
                                    <input id="receiver_country" type="text" class="form-control">
                                </div>
        

        
    </div>
    
    
</div>



<!-- senders details -->

<div class="col-md-6">

    <div class="card-header ">
    <h4 class="card-title">Shippers Details</h4>
    </div>
    
    <div class="card-body ">
            
                                 <label>First Name</label>
                                <div class="form-group">
                                    <input id="shipper_first_name" type="text" class="form-control">
                                </div>
                                <label>Last Name</label>
                                <div class="form-group">
                                    <input id="shipper_last_name" type="text" class="form-control">
                                </div>
    
                                <label>Address</label>
                                <div class="form-group">
                                    <input id="shipper_address" type="text" class="form-control">
                                </div>
                                <label>Email</label>
                                <div class="form-group">
                                    <input id="shipper_email" type="email" class="form-control">
                                </div>
                                
                                <label>Phone Number</label>
                                <div class="form-group">
                                    <input id="shipper_number" type="text" class="form-control">
                                </div>
                                   
                                <label>Country</label>
                                <div class="form-group">
                                    <input id="shipper_country" type="text" class="form-control">
                                </div>
    </div>
    
    
</div>

<div id="error_messages" style="color:red;font-size:20px">

</div>

<div id="success_messages" style="color:teal">

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
<script src="../assets/js/core/bootstrap.min.js" ></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js" ></script>
<script src="../assets/js/now-ui-dashboard.min290d.js?v=1.4.1" type="text/javascript"></script>

<script>

let messageContainer = document.getElementById('error_messages')
  let successContainer = document.getElementById('success_messages')

  const courier_btn = document.getElementById('create_co')
courier_btn.addEventListener('click',createCourier)

function createCourier(){
    console.log('Clicked!')

    courier_btn.innerHTML= 'please wait...'
    messageContainer.innerHTML = '';


 data = {
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

console.log(data)
// return;

for (const key in data) {
    if (data.hasOwnProperty(key)) {
        const element = data[key];
        if((element.trim()).length <= 0){
            window.scrollTo(0,0)
          messageContainer.innerHTML = `${key} was left empty`
            console.log(`${key} was left empty`)
    courier_btn.innerHTML= 'create'

            return false;
        }
    }
}

const url = '/api/courier/create.php';
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
        console.log(res.message)
    }else  if(res.status_code == 200){
     courier_btn.innerHTML= 'Great!..'
     successContainer.innerText = 'Courier created with tracking ID '+res.data.t_id+' please wait'

     setTimeout(() => {
        window.location.replace(`/admin/pages/completePackageInformation.php?tracking_id=${res.data.t_id}&t=4242045958761391661397653`)
         
     }, 3000);

    }

    console.log(res)}

).catch(err =>
{
console.log(err)
messageContainer.innerHTML = err.JSONResponse.message
courier_btn.innerHTML= 'Try again.'

})
}
</script>


    </body>
</html>
