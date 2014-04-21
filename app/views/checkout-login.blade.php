@extends("theme")

@section('title')
Login page
@endsection

@section("content")
<div class="container" id="content">
    <div class="row">
    	<div class="col-sm-12 text-center">
    	    <h3>Thanh toán</h3>
    	    SMShop/<span style="color:gray">Thanh toán</span>
            <hr>
    	</div>
    </div>
    <div class="row" style="margin: 1em 0.7em 0em 0.7em; min-height: 30em">
	    <div class="col-sm-12 text-center" style="margin-top: 3em;">
	    	<span>Vui lòng <a href="javascript:{}" onclick="showLogin()" style="color:#428bca">đăng nhập</a> để tiếp tục thanh toán.</span><br/>
            <span>Nếu bạn chưa đăng ký thành viên, vui lòng đăng ký <a href="javascript:{}" onclick="showNewAccount()" style="color:#428bca">TẠI ĐÂY</a>!!</span>
	    </div>
	</div>
    @include('footer')
</div>


@endsection