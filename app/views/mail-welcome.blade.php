<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Welcome email</title>

    <!-- Bootstrap core CSS -->
    {{HTML::style('assets/css/bootstrap.css')}}

    <!-- Custom styles for this template -->
    

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>SMShop <small>-- Welcome email --</small></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p>Xin chào <span style="color:#c0392b">{{$email}}</span>!</p>
                <p>
                    Chúc mừng bạn đã đến với <strong><span style="color:#428bca">S&M Shop</span></strong>, bạn đã đang ký thành công tài khoản trên <strong><span style="color:#428bca">S&M Shop</span></strong> website.<br/>
                    Chúng tôi sẽ liên tục cập nhật đến bạn tất cả các sản phẩm và chương trình khuyến mại HOT nhất của <strong><span style="color:#428bca">S&M Fashion</span></strong>.
                </p>
                <p>
                    Bạn đã sỡ hữu phiếu giảm giá 20% cho bất kỳ sản phẩm nào của <strong><span style="color:#428bca">S&M Shop</span></strong>.<br/>
                    Nếu bạn mua nhiều sản phẩm trên cùng 1 đơn hàng, sản phẩm có giá trị cao nhất sẽ được áp dụng giảm giá.<br/>
                    Phiếu quà tặng này có giá trị 15 ngày kể từ ngày bạn nhận được email này.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <a href="www.hanghieuchobeyeu.com">SHOP NOW</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p><a href="www.hanghieuchobeyeu.com" style="color:#c0392b">www.hanghieuchobeyeu.com</a><br/>
                <em><strong><span style="color:#428bca">S&M Shop</span></strong> chân thành cảm ơn.</em></p>
            </div>
        </div>
    </div>


</body>
</html>