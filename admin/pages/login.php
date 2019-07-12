<?php session_start();
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
if ($email) {
    header('Location:../dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="../assets/img/favicon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title>Login  :: Courier</title>

<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />


<!-- Extra details for Live View on GitHub Pages -->
<!-- Canonical SEO -->



<!--     Fonts and icons     -->

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

<link rel="stylesheet" href="../assets/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- CSS Files -->

<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />




<link href="../assets/css/now-ui-dashboard.min290d.css?v=1.4.1" rel="stylesheet" />





<!-- CSS Just for demo purpose, don't include it in your project -->
<link href="../assets/demo/demo.css" rel="stylesheet" />


    </head>

    <body class="login-page sidebar-mini ">



        <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
	<div class="container-fluid">
    <div class="navbar-wrapper">

			<a class="navbar-brand" href="#pablo">Login Page</a>
		</div>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-bar navbar-kebab"></span>
			<span class="navbar-toggler-bar navbar-kebab"></span>
			<span class="navbar-toggler-bar navbar-kebab"></span>
		</button>

	    <div class="collapse navbar-collapse justify-content-end" id="navigation">


          <ul class="navbar-nav">
    <li class= "nav-item ">
        <a href="register.html" class="nav-link">
            <i class="now-ui-icons tech_mobile"></i>
            Register
        </a>
    </li>
</ul>





	    </div>
	</div>
</nav>
<!-- End Navbar -->



        <div class="wrapper wrapper-full-page ">

















    <div class="full-page login-page section-image" filter-color="black" data-image="../assets/img/bg14.jpg">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="content">
            <div class="container">
                <div class="col-md-4 ml-auto mr-auto">
                    <form class="form" method="" action="#">







<div class="card card-login card-plain">

    <div class="card-header ">
    <div class="logo-container">
                            <img src="../../assets/img/now-logo.png" alt="">
                        </div>
    </div>

    <div class="card-body ">



  

<form>


<div id="error_messages" style="color:red">

</div>
  
<div id="success_messages" style="color:#4eaf78">

</div>

<div class="input-group no-border form-control-lg">
                                <span class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="now-ui-icons users_circle-08"></i>
                                  </div>
                                </span>
                                <input type="email" id="email" class="form-control" placeholder="Email">
                              </div>

                              <div class="input-group no-border form-control-lg">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="now-ui-icons objects_key-25"></i>
                                  </div>
                                </div>
                                <input type="password" id="password" placeholder="Secret password"class="form-control">
                              </div>
                              <div class="card-footer ">
        <button type="button" class="btn btn-success btn-round btn-lg" id="submit_btn">Login</button>
    </div>
    

</form>



    </div>



    <div class="card-footer ">
                        <div class="pull-left">
                            <h6><a href="#pablo" class="link footer-link">Create Account</a></h6>
                        </div>

                        <div class="pull-right">
                           <h6><a href="https://twitter.com/codemon_" target="_blank" class="link footer-link">Need Help?</a></h6>
                        </div>
    </div>

</div>

                    </form>
                </div>
            </div>
        </div>
        <footer class="footer" >

    <div class=" container-fluid ">

        <div class="copyright" id="copyright">
            &copy; <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>, Coded by <a href="https://www.codemon.io/" target="_blank">codemon</a>.
        </div>
    </div>



</footer>

    </div>


        </div>


<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.min.js" ></script>


<script>

  let messageContainer = document.getElementById('error_messages')
  let successContainer = document.getElementById('success_messages')

const submit_button = document.getElementById('submit_btn')
submit_button.addEventListener('click',registerInit)

function registerInit(ele){
    submit_button.innerHTML= 'please wait'
    messageContainer.innerHTML = '';
const password = document.getElementById('password').value
const email = document.getElementById('email').value


let data = {
email,
password
}

for (const key in data) {
    if (data.hasOwnProperty(key)) {
        const element = data[key];
        if((element.trim()).length <= 0){
          messageContainer.innerHTML = `${key} was left empty`
            console.log(`${key} was left empty`)
    submit_button.innerHTML= 'Login'

            return false;
        }
    }
}

const url = '/api/courier/admin/login.php';
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
    submit_button.innerHTML= 'Login'

        console.log(res.message)
    }else  if(res.status_code == 200){
        submit_button.innerHTML= 'Logged In!..'
     successContainer.innerText = 'Logged in Successful'
     setTimeout(() => {
        window.location.replace('/admin/dashboard.php?reg=true&admin_id='+res.message.data[0].admin_id+'&first_name='+res.message.data[0].first_name)
         
     }, 1500);
     
    }

    console.log(res)}

).catch(err =>
{
console.log(err)

if(err.responseText == ''){
messageContainer.innerHTML = 'Are  you registered yet?'
}
submit_button.innerHTML= 'Login'

})

}



</script>
<script src="../assets/js/core/popper.min.js" ></script>


<script src="../assets/js/core/bootstrap.min.js" ></script>


<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js" ></script>

<script src="../assets/js/plugins/moment.min.js"></script>



<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>

<!--  Plugin for Sweet Alert -->
<script src="../assets/js/plugins/sweetalert2.min.js"></script>

<!-- Forms Validations Plugin -->
<script src="../assets/js/plugins/jquery.validate.min.js"></script>

<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="../assets/js/plugins/bootstrap-selectpicker.js" ></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="../assets/js/plugins/bootstrap-datetimepicker.js"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="../assets/js/plugins/jquery.dataTables.min.js"></script>

<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="../assets/js/plugins/fullcalendar.min.js"></script>

<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="../assets/js/plugins/jquery-jvectormap.js"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="../assets/js/plugins/nouislider.min.js" ></script>


<!-- Chart JS -->
<script src="../assets/js/plugins/chartjs.min.js"></script>

<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>



<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc --><script src="./assets/js/now-ui-dashboard.min290d.js?v=1.4.1" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/demo/demo.js"></script>



  <script>
  $(document).ready(function(){
    demo.checkFullPageBackgroundImage();
  });
</script>
    </body>
</html>
