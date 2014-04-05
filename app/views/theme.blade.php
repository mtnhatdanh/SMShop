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
    {{HTML::style('assets/css/bootstrap.css')}}

    <!-- Custom styles for this template -->
    {{HTML::style('assets/css/screen.css')}}

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    {{HTML::script('assets/js/jquery-1.11.0.min.js')}}
    {{HTML::script('assets/js/bootstrap.min.js')}}

    <!-- Validation Jquery -->
    {{HTML::script('assets/js/jquery-validate/jquery.validate.js')}}

    <!-- Galleriffic thumbnail picture jquery-->
    <!-- {{HTML::style('assets/js/galleriffic-2.0/css/basic.css')}} -->
    <!-- {{HTML::style('assets/js/galleriffic-2.0/css/galleriffic-1.css')}} -->
    {{HTML::script('assets/js/galleriffic-2.0/js/jquery.galleriffic.js')}}
    
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

    <header>
      <div class="container">
          <div class="row" id="nav_header">
            <div class="col-sm-2 col-sm-offset-1">
              <a href="{{Asset('main')}}" id="logotype"><img src="{{Asset('assets/img/LogoSM.png')}}" class="img-responsive" alt="Image"></a>
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
                  @foreach (Category::where('enable', '=', 1)->get() as $cateMainNav)
                  <li><a href="{{Asset('category/'.$cateMainNav->name)}}">{{$cateMainNav->name}}</a></li>
                  @endforeach
                  <li><a href="{{Asset('sale')}}">Sale</a></li>
                </ul>
              </div>
            </div>
          </div>
      </div>
    </header>

    <div id="main" class="container">
      @yield('content')
    </div>
    
  </body>
</html>