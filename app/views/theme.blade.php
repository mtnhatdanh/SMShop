<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{Asset('assets/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{Asset('assets/css/screen.css')}}" rel="stylesheet" >

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="{{Asset('assets/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{Asset('assets/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{Asset('assets/js/jquery-validate/jquery.validate.js')}}"></script>

  <!-- Creative Button js and css -->
  <!-- <link rel="stylesheet" type="text/css" href="{{Asset('assets/CreativeButtons/css/default.css')}}" /> -->
  <!-- <link rel="stylesheet" type="text/css" href="{{Asset('assets/CreativeButtons/css/component.css')}}" /> -->
  
    
  </head>

  <body>

    <div id="bar">
      <div class="container">
        <div class="row">
          <ul>
            <li><a href="#">Contact</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>
            <li><a href="#">Log In</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div id="header">

      <div class="container">
          <div class="row" id="nav_header">
            <div class="col-sm-2 col-sm-offset-1">
              <a href="#" id="logotype"><img src="{{Asset('assets/img/LogoSM.png')}}" class="img-responsive" alt="Image"></a>
            </div>
            <div class="col-sm-6 text-center">
              <div class="row">
                <ul id="subNav">
                  <li><a href="#">Địa điểm cửa hàng</a></li>
                  <li><a href="#">Dịch vụ khách hàng</a></li>
                  <li><a href="#">Đăng ký email</a></li>
                </ul>
                <div style="line-height: 4px; height:4px; padding-left: 4em">
                  <span>....................................................................................................................</span>
                </div>
              </div>
              <div class="row">
                <ul id="nav">
                  <li><a href="#">Kids</a></li>
                  <li><a href="#">Ladies</a></li>
                  <li><a href="#">Man</a></li>
                  <li><a href="#">Others</a></li>
                  <li><a href="#">Sale</a></li>
                </ul>
              </div>
            </div>
          </div>
      </div>
    </div>

    <div id="main" class="container">
      <div id="content" class="row">
        <div class="col-sm-2">
          <div id="nav_header">
            <h3><a href="#">KIDS</a></h3>
            <span><strong><a href="#">View All</a></strong></span><br/>
            <span><strong><a href="#">New Arrivals</a></strong></span>
          </div>
          <div id="categories">
            <ul id="left_nav">
              <li>
                <a href="#">Girls 3-16y</a>
                <ul>
                  <li><a href="#">Top</a></li>
                  <li><a href="#">Bottom</a></li>
                  <li><a href="#">Dress</a></li>
                  <li><a href="#">Accessories</a></li>
                </ul>
              </li>
              <li>
                <a href="#">Boys 3-16y</a>
                <ul>
                  <li><a href="#">Top</a></li>
                  <li><a href="#">Bottom</a></li>
                  <li><a href="#">Accessories</a></li>
                </ul>
              </li>
              <li>
                <a href="#">Baby Girls 0-36m</a>
                <ul>
                  <li><a href="#">Top</a></li>
                  <li><a href="#">Bottom</a></li>
                  <li><a href="#">Accessories</a></li>
                </ul>
              </li>
              <li><a href="#">
                Baby Boys 0-36m</a>
                <ul>
                  <li><a href="#">Top</a></li>
                  <li><a href="#">Bottom</a></li>
                  <li><a href="#">Accessories</a></li>
                </ul>
              </li>
              <li><a href="#">Others</a></li>
            </ul>
          </div>  
        </div>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-12">
              <div style="margin-bottom:1em;padding-left:1em;">
                <h3>KIDS</h3>
                <span style="text-decoration: underline;">SM Shop</span> / <span style="color:gray">KIDS</span>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div style="padding:1em;">
                    <a href="#"><img src="{{Asset('assets/img/2LF_Page_01.jpg')}}" class="img-responsive" alt="Image"></a>
                  </div>
                </div>
              </div>
              <div class="row" id="products_container">
                <?php 
                for ($i=1;$i<=18;$i++) {
                ?>
                <div class="col-sm-3">
                  <div class="products">
                    <a href="#"><img src="{{Asset('assets/img/products/'.$i.'.jpeg')}}" class="img-responsive" alt="Image"></a>
                    <br/>
                    <div style="margin-bottom:0.5em">
                      Quần liền áo<br/>
                      VND 200.000<br/>
                    </div>
                    <button type="button" class="btn btn-default buy_button"><span class="glyphicon glyphicon-shopping-cart"></span> Add to cart</button>
                  </div>
                </div>
                <?php 
                }
                ?>
              </div>
            </div >
            
          </div>
          <div class="row" id="footer">
            <div class="col-sm-6">
              <span>Copyright © 2014, design by: Minh Giang</span>
            </div>
            <div class="col-sm-6 text-right">
              <ul class="social-links clearfix list-unstyled">
                <li><a href="#" class="facebook"></a></li>
                <li><a href="#" class="youtube"></a></li>
                <li><a href="#" class="skype"></a></li>
                <li><a href="#" class="yahoo"></a></li>
              </ul>
            </div>
          </div>

        </div>

      </div>
    </div>
    
    <script>
      $(document).ready(function(){
        var $unstyleUl = $('div#categories ul');
        $unstyleUl.addClass('list-unstyled');
        
        // var $dropDown = $('div#categories ul li ul');
        //   $dropDown.addClass("drop"); 
            
        //   var $trig = $('div#categories ul');
        //   $trigger = $trig.find('a'),     
        //   $trigger.click(function () {
        //      $(this).next('ul').slideToggle();

        //     });
            
        $('.products').hover(function(){
          $(this).children('button.buy_button').animate({
            opacity: 1
          });
        }, function(){
          $(this).children('button.buy_button').animate({
            opacity: 0
          });
        })

      })
    </script>
  </body>
</html>