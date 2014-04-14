@extends("theme")

@section('title')
Check out - Empty Cart.
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
	    	<span>Your cart is empty!! Please pick some items!!</span>
	    </div>
	</div>
    @include('footer')
</div>


@endsection