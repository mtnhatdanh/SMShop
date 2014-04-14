@extends('admin_theme')

@section('title')
SMShop - Passenger List
@endsection
@section('content')

<div class="container">
	<h1>Passenger List</h1>
</div>
<br/>

<div class="container" id="content">
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-striped table-condensed table-responsive">
				<tr>
					<th>No</th>
					<th>Email</th>
					<th>Address</th>
					<th>Phone</th>
				</tr>
				<?php
				$no = 0;
				?>
				@foreach ($paxs as $pax)
				<tr>
					<td>{{++$no}}</td>
					<td>{{$pax->email}}</td>
					<td>{{$pax->address}}</td>
					<td>{{$pax->phone}}</td>
				</tr>
				@endforeach
			</table>
			{{$paxs->links()}}
		</div>
	</div>
</div>

@endsection