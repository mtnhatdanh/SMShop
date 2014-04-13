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
	    	<p>Thank you for buying SMShop's products.<br/>
            Your order has been received and will be processed on 24 hourse.</p>
	    </div>
	</div>
    @include('footer')
</div>


@endsection