<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Mail to customer</title>

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
    
    <style>
        table#mail-table img {
            height: 5em;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>SMShop <small>-- Confirm order --</small></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p>
                    <span style="color:#428bca">S&M Shop</span> đã nhận được đơn hàng của quý khách.<br/>
                    Chúng tôi đang kiểm hàng, và sẽ tiến hành giao hàng cho quý khách trong vòng 24 giờ.
                </p>
                <em>Chi tiết đơn hàng:</em><br/>
                <table class="table table-responsive" id="mail-table">
                    <tr>
                        <td>No</td>
                        <td>Hình</td>
                        <td>Item</td>
                        <td class="text-center">Size</td>
                        <td class="text-center">Số lượng</td>
                        <td class="text-right">Giá</td>
                        <td class="text-right">Thành tiền</td>
                    </tr>
                    <?php 
                    $no          = 0; 
                    $sumVND      = 0;
                    $sumQuantity = 0;
                    ?>
                    @foreach ($cart as $key=>$itemCart)
                    <?php
                    $item = Item::find($itemCart->item_id);
                    if ($item->onsale) {
                        $price = $item->sale_price;
                    } else $price = $item->price;
                    $sumVND      += $price*$itemCart->quantity;
                    $sumQuantity += $itemCart->quantity;
                    ?>
                    <tr>
                        <td>{{++$no}}</td>
                        <td><img src="{{asset('assets/img/products/'.$item->urlPic1)}}" class="img-responsive" alt="Image"></td>
                        <td>{{ucfirst($item->name)}}</td>
                        <td class="text-center">{{$itemCart->size}}</td>
                        <td class="text-center">{{$itemCart->quantity}}</td>
                        <td class="text-right">{{number_format($price, 0, '.', ',')}}</td>
                        <td class="text-right"><strong>{{number_format($price*$itemCart->quantity, 0, '.', ',')}}</strong></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-center">Tổng cộng</td>
                        <td class="text-center"><strong>{{$sumQuantity}}</strong></td>
                        <td></td>
                        <td class="text-right"><strong>{{number_format($sumVND, 0, '.', ',')}}</strong></td>
                    </tr>
                </table>
                <p>
                    <em>Ghi chú của bạn:</em> {{$note}}
                </p>
                <p>
                    <span style="color:#428bca">S&M Shop</span> xin cảm ơn.<br/>
                    212B/D8 Nguyễn Trãi, F.Nguyễn Cư Trinh, Q.1, TP.HCM.<br/>
                    Để liên hệ bộ phận dịch vụ khách hàng, vui lòng gọi 08-38361962.<br/>
                    <a href="www.hanghieuchobeyeu.com" style="color:#c0392b">www.hanghieuchobeyeu.com</a>
                </p>
            </div>
        </div>
    </div>


</body>
</html>