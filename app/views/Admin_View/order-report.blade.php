@extends('admin_theme')

@section('title')
SMShop - Order Report
@endsection
@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h1>Order Report</h1>
		</div>
	</div>
	@include('notification')
	<br/>
</div>

<div class="container">
	<div class="row form-inline">
		<div class="col-sm-3 form-group">
			{{Former::date('from_day')->class('form-control')}}
		</div>
		<div class="col-sm-3 form-group">
			{{Former::date('to_day')->class('form-control')}}
		</div>
		<div class="col-sm-3 form-group">
			{{Former::select('status')->options(array('all' => 'All', 0 => 'Waiting', 1 => 'Finished'))->class('form-control')}}
		</div>
		<div class="col-sm-2">
			<button type="button" class="btn btn-default btn-block" onclick="filter()">Filter</button>
		</div>
	</div>
	<br/>
</div>
<div id="order-report-div"></div>

<script>
	function filter(){
		from_day = $('#from_day').val();
		to_day   = $('#to_day').val();
		status   = $('#status').val();
		$.ajax({
				url: '{{asset('admin/order-report')}}',
				type: 'post',
				data: {from_day: from_day, to_day: to_day, status: status},
				success: function (data) {
					$('#order-report-div').html(data);
				}
			});
	}
</script>

@endsection