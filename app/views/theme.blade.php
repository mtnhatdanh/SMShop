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
    {{HTML::script('assets/js/jquery-ui-1.10.4.custom.min.js')}}
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
            <li><a href="#">Check out</a></li>
            <li  id="cart">
              <a href="javascript:{}" onclick="showCart()">
                <span class="glyphicon glyphicon-shopping-cart"></span>Cart<span id="cartSum"><?php
                   if (!Cache::has('cart')) {
                     echo ('(0)');
                   } else {
                    $cart = (Cache::get('cart'));
                    $sumQuantity = 0;
                    foreach ($cart as $itemCart) {
                      $sumQuantity += $itemCart->quantity;
                    }
                    echo ('('.$sumQuantity.')');
                   }
                  ?>
                </span>
              </a>
            </li>
            <li>
              @if (!Session::has('user'))
              <a href="javascript:{}" onclick="showLogin()">Log In</a>
              @endif
            </li>
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

    <!-- Modal Cart -->
    <div class="modal fade" id="myCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Giỏ hàng</h4>
          </div>
          <div class="modal-body">
            <div id="div-cart"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">CHECK OUT</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Login -->
    <div class="modal fade" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Đăng nhập</h4>
          </div>
          <div class="modal-body">
            <section id="login-section">
              <form action="" method="post" id="form-login">
                <div class="row">
                  <div class="col-sm-8 col-sm-offset-2 form-group">
                    <label for="inputEmail">Email</label>
                    <input type="text" name="email" id="inputEmail" class="form-control" required="required" placeholder="Your email..">
                  </div>
                  <div class="col-sm-8 col-sm-offset-2 form-group">
                    <label for="inputPassword" class="control-label">Password</label>
                    <input type="text" name="password" id="inputPassword" class="form-control" required="required" placeholder="Your password..">
                  </div>
                </div>
              </form>
            </section>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-sm-4 col-sm-offset-2">
                <button type="button" class="btn btn-primary btn-block">Log in</button>
              </div>
              <div class="col-sm-3">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>

      function showCart(){
        $('#myCart').modal('show');
        $.ajax({
            url: '{{Asset('show-cart')}}',
            type: 'get',
            data: {},
            success: function (data) {
              $('#div-cart').html(data);
            },
            global: false
          });
      }

      function showLogin(){
        $('#myLogin').modal('show');
        $.ajax({
            url: '{{Asset('log-in')}}',
            type: 'get',
            data: {},
            success: function (data) {
              $('#div-login').html(data);
            },
            global: false
          });
      }

    </script>
    
  </body>
</html>