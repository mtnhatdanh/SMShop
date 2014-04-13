@extends("theme")

@section('title')
SM Shop - Mainpage
@endsection

@section("content")

<div id="content">
	<div id="mainpage">
		<div class="row">
			<div class="col-sm-12">
				<img id="main-pic" src="{{Asset('assets/img/2LF_Page_01.jpg')}}" class="img-responsive" alt="Image">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<img class="main-small-img" src="{{Asset('assets/img/mainpage/main1.jpeg')}}" class="img-responsive" alt="Image">
			</div>
			<div class="col-sm-3">
				<img class="main-small-img" src="{{Asset('assets/img/mainpage/main2.jpeg')}}" class="img-responsive" alt="Image">
			</div>
			<div class="col-sm-3">
				<img class="main-small-img" src="{{Asset('assets/img/mainpage/main3.jpeg')}}" class="img-responsive" alt="Image">
			</div>
			<div class="col-sm-3">
				<img class="main-small-img" src="{{Asset('assets/img/mainpage/main4.jpeg')}}" class="img-responsive" alt="Image">
			</div>
			<div class="col-sm-3">
				<img class="main-small-img" src="{{Asset('assets/img/mainpage/main5.jpeg')}}" class="img-responsive" alt="Image">
			</div>
			<div class="col-sm-3">
				<img class="main-small-img" src="{{Asset('assets/img/mainpage/main6.jpeg')}}" class="img-responsive" alt="Image">
			</div>
			<div class="col-sm-3">
				<img class="main-small-img" src="{{Asset('assets/img/mainpage/main7.jpeg')}}" class="img-responsive" alt="Image">
			</div>
			<div class="col-sm-3">
				<img class="main-small-img" src="{{Asset('assets/img/mainpage/main8.jpeg')}}" class="img-responsive" alt="Image">
			</div>
		</div>
		@include('footer')
	</div>
</div>

@endsection