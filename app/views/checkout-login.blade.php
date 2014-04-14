@extends("theme")

@section('title')
Login page
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
	    	<span>You did not log in. Please <a href="javascript:{}" onclick="showLogin()" style="color:#428bca">LOG IN</a> first.</span><br/>
            <span>If you don't have an account, <a href="javascript:{}" onclick="showNewAccount()" style="color:#428bca">SIGN UP</a> here!!</span>
	    </div>
	</div>
    @include('footer')
</div>


@endsection