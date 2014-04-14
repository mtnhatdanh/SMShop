<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-responsive table-condensed table-striped">
				<tr>
					<th>No</th>
					<th>Date</th>
					<th>Passenger</th>
					<th>Status</th>
					<th class="text-center">Detail</th>
				</tr>
				<?php 
				$no = 0;
				?>
				@foreach ($orders as $order)
				<tr>
					<td>{{++$no}}</td>
					<td>{{date('m/d/Y', strtotime($order->date))}}</td>
					<td>{{$order->pax->email}}</td>
					<td>
						<select name="status" id="{{$order->id}}" class="order_select">
							<option value="0" @if ($order->status == 0) selected @endif>Waiting</option>
							<option value="1" @if ($order->status == 1) selected @endif>Finished</option>
						</select>
					</td>
					<td class="text-center">
						<button id="{{$order->id}}" class="btn btn-link detail_button" data-toggle="modal" href='#detail-modal'>Detail</button>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="detail-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Order Detail</h4>
			</div>
			<div class="modal-body">
				<div id="result_div"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	$('select.order_select').change(function(){
		status = $(this).val();
		order_id = $(this).attr('id');
		$.ajax({
				url: '{{asset('admin/order-change-status')}}',
				type: 'post',
				data: {order_id: order_id, status: status},
				success: function (data) {
					console.log();
				}
			});
	});

	$('.detail_button').click(function(){
		order_id = $(this).attr('id');
		$.ajax({
				url: '{{asset('admin/order-detail')}}',
				type: 'post',
				data: {order_id: order_id},
				success: function (data) {
					$('#result_div').html(data);
				}
			});
	});


</script>