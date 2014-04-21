@extends("theme")

@section('title')
Check out - finish
@endsection

@section("content")
<div class="container" id="content">
    <div class="row">
    	<div class="col-sm-12 text-center">
    	    <h3>CHECK OUT</h3>
    	    SMShop/<span style="color:gray">Check out</span>
            <hr>
    	</div>
    </div>
    <div class="row" style="margin: 1em 0.7em 0em 0.7em; min-height: 30em">
	    <div class="col-sm-12 text-center" style="margin-top: 3em;">
	    	<p>Cảm ơn quý khách đã lựa chọn sản phẩm của S&M Shop.<br/>
            Chúng tôi đã nhận đơn hàng của quý khách, sẽ tiến hành xác nhận và giao hàng trong vòng 24 giờ.</p>
            <a href="{{asset('/')}}"><button class="btn btn-default">TRỞ VỀ TRANG CHỦ</button></a>
	    </div>
	</div>
    @include('footer')
</div>


@endsection