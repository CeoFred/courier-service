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
                                <!-- GTranslate: https://gtranslate.io/ -->
<a href="#" onclick="doGTranslate('en|en');return false;" title="English" class="gflag nturl" style="background-position:-0px -0px;"><img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="English" /></a><a href="#" onclick="doGTranslate('en|fr');return false;" title="French" class="gflag nturl" style="background-position:-200px -100px;"><img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="French" /></a><a href="#" onclick="doGTranslate('en|de');return false;" title="German" class="gflag nturl" style="background-position:-300px -100px;"><img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="German" /></a><a href="#" onclick="doGTranslate('en|it');return false;" title="Italian" class="gflag nturl" style="background-position:-600px -100px;"><img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="Italian" /></a><a href="#" onclick="doGTranslate('en|pt');return false;" title="Portuguese" class="gflag nturl" style="background-position:-300px -200px;"><img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="Portuguese" /></a><a href="#" onclick="doGTranslate('en|ru');return false;" title="Russian" class="gflag nturl" style="background-position:-500px -200px;"><img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="Russian" /></a><a href="#" onclick="doGTranslate('en|es');return false;" title="Spanish" class="gflag nturl" style="background-position:-600px -200px;"><img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="Spanish" /></a>

<style type="text/css">
<!--
a.gflag {vertical-align:middle;font-size:24px;padding:1px 0;background-repeat:no-repeat;background-image:url(//gtranslate.net/flags/24.png);}
a.gflag img {border:0;}
a.gflag:hover {background-image:url(//gtranslate.net/flags/24a.png);}
#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}
body {top:0 !important;}
#google_translate_element2 {display:none!important;}
-->
</style>

<br /><select onchange="doGTranslate(this);"><option value="">Select Language</option><option value="en|af">Afrikaans</option><option value="en|sq">Albanian</option><option value="en|ar">Arabic</option><option value="en|hy">Armenian</option><option value="en|az">Azerbaijani</option><option value="en|eu">Basque</option><option value="en|be">Belarusian</option><option value="en|bg">Bulgarian</option><option value="en|ca">Catalan</option><option value="en|zh-CN">Chinese (Simplified)</option><option value="en|zh-TW">Chinese (Traditional)</option><option value="en|hr">Croatian</option><option value="en|cs">Czech</option><option value="en|da">Danish</option><option value="en|nl">Dutch</option><option value="en|en">English</option><option value="en|et">Estonian</option><option value="en|tl">Filipino</option><option value="en|fi">Finnish</option><option value="en|fr">French</option><option value="en|gl">Galician</option><option value="en|ka">Georgian</option><option value="en|de">German</option><option value="en|el">Greek</option><option value="en|ht">Haitian Creole</option><option value="en|iw">Hebrew</option><option value="en|hi">Hindi</option><option value="en|hu">Hungarian</option><option value="en|is">Icelandic</option><option value="en|id">Indonesian</option><option value="en|ga">Irish</option><option value="en|it">Italian</option><option value="en|ja">Japanese</option><option value="en|ko">Korean</option><option value="en|lv">Latvian</option><option value="en|lt">Lithuanian</option><option value="en|mk">Macedonian</option><option value="en|ms">Malay</option><option value="en|mt">Maltese</option><option value="en|no">Norwegian</option><option value="en|fa">Persian</option><option value="en|pl">Polish</option><option value="en|pt">Portuguese</option><option value="en|ro">Romanian</option><option value="en|ru">Russian</option><option value="en|sr">Serbian</option><option value="en|sk">Slovak</option><option value="en|sl">Slovenian</option><option value="en|es">Spanish</option><option value="en|sw">Swahili</option><option value="en|sv">Swedish</option><option value="en|th">Thai</option><option value="en|tr">Turkish</option><option value="en|uk">Ukrainian</option><option value="en|ur">Urdu</option><option value="en|vi">Vietnamese</option><option value="en|cy">Welsh</option><option value="en|yi">Yiddish</option><option value="en|ceb">Cebuano</option><option value="en|eo">Esperanto</option><option value="en|gu">Gujarati</option><option value="en|ig">Igbo</option><option value="en|jw">Javanese</option></select><div id="google_translate_element2"></div>
<script type="text/javascript">
function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'en',autoDisplay: false}, 'google_translate_element2');}
</script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


<script type="text/javascript">
/* <![CDATA[ */
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',43,43,'||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'),0,{}))
/* ]]> */
</script>

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
                        <div id="bar_code">
                        <img src="http://www.barcodes4.me/barcode/c128b/AnyValueYouWish.gif" alt="barcode" height="100" width="100%">
                        </div>
                        
                        <img src="images/protected.png" alt="protected" height="100" srcset="">
                        <img src="images/verified.png" alt="verified" height="100" srcset="">

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

                                                        </h5>
                                                        <ul class="list-unstyled mt-3 mb-4">
                                                            
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
    <footer class="newsletter_right_w3agile bg-dark pymd-5 py-4">
        <div class="container">
            <div class="inner-sec-w3layouts py-md-5 py-3">
                <div class="row footer-bottom-wthree mt-lg-5 mt-3">
                    <div class="col-lg-6 copyright">
                        <h2><a class="navbar-brand" href="index.html">
                                <img src="images/logo.png" height="50"></a>
                            
                        </a></h2>
                        <p class="copy-right mt-3">© Fedex 1995-2019. All Rights Reserved                         </p>
                    </div>
                    <div class="col-lg-6 social-icon footer">
                        <ul class="links-nav d-flex justify-content-end">
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li>
                                <a href="about.html">About</a>
                            </li>

                            <li>
                                <a href="contact.html">Contact</a>
                            </li>
                        </ul>
                        <ul class="social-icons d-flex justify-content-end mt-3">
                            <li class="mr-1"><a href="https://www.facebook.com/fedex"><span class="fab fa-facebook-f"></span></a></li>
                            <li class="mx-1"><a href="https://twitter.com/fedex"><span class="fab fa-twitter"></span></a></li>
                            <li class="mx-1"><a href="http://www.instagram.com/fedex"><span class="fab fa-instagram"></span></a></li>
                            <li class="mx-1"><a href="http://www.linkedin.com/company/fedex"><span class="fab fa-linkedin-in"></span></a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>

                </div>

            </div>
        </div>
    </footer>
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