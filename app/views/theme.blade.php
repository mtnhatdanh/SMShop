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
            <li>
              <?php
               if (!Cache::has('cart')) {
                 $sumQuantity = 0;
               } else {
                $cart = (Cache::get('cart'));
                $sumQuantity = 0;
                foreach ($cart as $itemCart) {
                  $sumQuantity += $itemCart->quantity;
                }
               }
              ?>
              <a href="{{Asset('check-out')}}">Thanh toán</a>
            </li>
            <li  id="cart">
              <a href="javascript:{}" onclick="showCart()">
                <span class="glyphicon glyphicon-shopping-cart"></span>Giỏ hàng<span id="cartSum">({{$sumQuantity}})
                </span>
              </a>
            </li>
            <li>
              @if (!Session::has('pax'))
              <a href="javascript:{}" onclick="showLogin()">Đăng nhập</a>
              @else
              <a href="javascript:{}" onclick="showPaxInformation()"><span class="glyphicon glyphicon-user"></span>{{Session::get('pax')}}</a>
              @endif
            </li>
          </ul>
        </div>
      </div>
    </div>

    <header>
      <div class="container">
          <div class="row" id="nav_header">
            <div class="col-sm-2 col-sm-offset">
              <a href="{{Asset('main')}}" id="logotype"><img src="{{Asset('assets/img/LogoSM.png')}}" class="img-responsive" alt="Image"></a>
            </div>
            <div class="col-sm-8 text-center">
              <div class="row">
                <ul id="subNav">
                  <li><a href="{{asset('info/store-locator')}}">Địa điểm cửa hàng</a></li>
                  <li><a href="{{asset('info/shopping-guilde')}}">Hướng dẫn mua hàng</a></li>
                  <li><a href="javascript:{}" onclick="showNewAccount()">Đăng ký thành viên</a></li>
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
                  <li><a href="{{Asset('sale')}}">Khuyến mãi</a></li>
                </ul>
              </div>
            </div>
          </div>
      </div>
    </header>

    <div id="main" class="container">
      @yield('content')
    </div>
    <div id="loading_div"></div>

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
            <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
            <a href="{{asset('check-out')}}"><button type="button" class="btn btn-primary">Xác nhận đơn hàng</button></a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal new pax -->
    {{Former::open()->id('form-new-account')}}
    <div class="modal fade" id="myNewAccount">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Tạo tài khoản</h4>
          </div>
          <div class="modal-body">
            <div class="row form-group">
              <div class="col-sm-8 col-sm-offset-2">
                {{Former::text('email')->class('form-control')->placeholder('Nhập vào email..')}}
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-8 col-sm-offset-2">
                {{Former::password('password')->class('form-control')->placeholder('Nhập vào mật khẩu..')->label('Mật khẩu')}}
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-8 col-sm-offset-2">
                {{Former::password('re_password')->class('form-control')->placeholder('Nhập lại mật khẩu..')->label('Nhập lại mật khẩu')}}
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-8 col-sm-offset-2">
                {{Former::text('address')->class('form-control')->placeholder('Nhập địa chỉ giao hàng..')->label('Địa chỉ giao hàng')}}
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-8 col-sm-offset-2">
                {{Former::text('phone')->class('form-control')->placeholder('Nhập số điện thoại..')->label('Điện thoại')}}
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-sm-4 col-sm-offset-2">
                <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
              </div>
              <div class="col-sm-4">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Thoát</button>
              </div>
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{Former::close()}}

    <!-- Modal Login -->
    {{Former::open()->id('form-login')}}
    <div class="modal fade" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Đăng nhập</h4>
          </div>
          <div class="modal-body">
            <section id="login-section">
                <div class="row form-group">
                  <div class="col-sm-8 col-sm-offset-2">
                    {{Former::text('email')->class('form-control')->placeholder('Email..')}}
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-8 col-sm-offset-2">
                    {{Former::password('password')->class('form-control')->placeholder('Your password..')->label('Mật khẩu')}}
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-8 col-sm-offset-2">
                    <span>Nếu chưa là thành viên của S&M Shop, vui lòng đăng ký <a href="javascript:{}" onclick="showNewAccount()">tại đây</a>!!</span>
                  </div>
                </div>
            </section>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-sm-4 col-sm-offset-2">
                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
              </div>
              <div class="col-sm-3">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Thoát</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{Former::close()}}

    <!-- Notification Modal -->
    <div class="modal fade" id="notification-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Thông báo</h4>
          </div>
          <div class="modal-body">
            <div id="div-notification"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal for check out confirm -->
    <div class="modal fade" id="checkout-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Xác nhận</h4>
          </div>
          <div class="modal-body">
            Bạn đã kiểm tra đầy đủ thông tin??
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="checkout-confirm-button">Xác nhận</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Pax Infomation Modal -->
    <div class="modal fade" id="pax-info-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Thông tin tài khoản</h4>
          </div>
          <div class="modal-body">
            @if (Session::has('pax'))
            <?php
            $email = Session::get('pax');
            $pax   = Pax::where('email', '=', $email)->first();
            ?>
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-responsive table-condensed" id="checkout_table" style="margin-top:1em">
                  <tr>
                    <th>Email:</th>
                    <td>{{$pax->email}}</td>
                  </tr>
                  <tr>
                    <th>Địa chỉ:</th>
                    <td>{{$pax->address}}</td>
                  </tr>
                  <tr>
                    <th>Số điện thoại:</th>
                    <td>{{$pax->phone}}</td>
                  </tr>
                </table>
              </div>
            </div>
            @endif
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            <a href="{{asset('log-out')}}"><button type="button" class="btn btn-primary">Đăng xuất</button></a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>

      // Checkout confirm button click
      $('#checkout-confirm-button').click(function(){
        $('#checkout-modal').modal('hide');
        $('body').addClass('loading');
        note = $('#note-textarea').val();
        $.ajax({
            url: '{{asset('check-out-confirm')}}',
            type: 'post',
            data: {note: note},
            success: function (data) {
              window.location.replace("{{asset('check-out-finish')}}");
            }
          });
      });

      // New account form
      $('#form-new-account').validate({
        rules: {
          email: {
            email:true,
            required:true,
            remote:{
              url:"{{Asset('check-email-exist')}}",
              type: 'post'
            }
          },
          address: {
            required: true,
            minlength: 6
          },
          phone: {
            required: true,
            minlength: 9
          },
          password: {
            required: true,
            minlength: 6,
          },
          re_password: {
            required: true,
            equalTo: "#password"
          }
        },
        submitHandler: function(form){
          $('#myNewAccount').modal('hide');
          $.ajax({
              url: '{{Asset('sign-up')}}',
              type: 'post',
              data: $(form).serialize(),
              success: function (data) {
                $('#div-notification').html(data);
                $('#notification-modal').modal('show');
              }
            });
        }
      });

      // login form
      $('#form-login').validate({
        rules: {
          email: {
            required: true,
            email: true,
          }, 
          password: {
            required: true,
          }
        },
        submitHandler: function(form) {
          $.ajax({
              url: '{{Asset('sign-in')}}',
              type: 'post',
              data: $(form).serialize(),
              success: function (data) {
                $('#myLogin').modal('hide');
                $('#div-notification').html(data);
                $('#notification-modal').modal('show');
              }
            });
        }
      });

      function showNewAccount(){
        $('#myLogin').modal('hide');
        $('#myNewAccount').modal('show');
      }

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
        $('#myLogin').modal('show');}

      function showPaxInformation(){
        $('#pax-info-modal').modal('show');
      }

      $('#notification-modal').on('hidden.bs.modal', function(e){
        location.reload();
      })

      // jquery for loading gif
      $abcdef = $('body');

      $(document).on({
          ajaxStart: function() { 
              $abcdef.addClass("loading");
          },
          ajaxStop: function() { 
              $abcdef.removeClass("loading");
          }    
      });    

    </script>
    
  </body>
</html>