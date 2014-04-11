<style>
	div#manage-item-table img {
		width: 3em;
	}
	div#manage-item-table table th {
		text-align: center;
	}
</style>

<div class="container" id="manage-item-table">
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-condensed table-responsive table-bordered">
				<tr>
					<th colspan="9" class="text-center">{{$itemAtt->itemType->category->name}} - {{$itemAtt->itemType->name}} - {{$itemAtt->name}}</th>
				</tr>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Pic1</th>
					<th>Pic2</th>
					<th>Price</th>
					<th>Size Avaiable</th>
					<th>OnSale</th>
					<th>Sale_price</th>
					<th>Action</th>
				</tr>
				<?php $no = 0; ?>
				@foreach ($itemAtt->items as $item)
				<tr>
					<td>{{++$no}}</td>
					<td>{{$item->name}}</td>
					<td><img src="{{Asset('assets/img/products/'.$item->urlPic1)}}" class="img-responsive" alt="pic1"></td>
					<td><img src="{{Asset('assets/img/products/'.$item->urlPic2)}}" class="img-responsive" alt="pic2"></td>
					<td>{{number_format($item->price, 0, '.', ',')}}</td>
					<td class="text-center">{{$item->size_available}}</td>
					<td class="text-center">@if ($item->onsale == 0) No @else Yes @endif</td>
					<td>{{number_format($item->sale_price, 0, '.', ',')}}</td>
					<td class="text-center">
						<button id="{{$item->id}}" type="button" class="btn btn-link del-button">Del</button>
						<button id="{{$item->id}}" type="button" class="btn btn-link modify-button" data-toggle="modal" data-target="#modifyModal">Modify</button>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>

<!-- Modal modify -->
<div class="modal fade bs-example-modal-lg" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{Asset('admin/modify-item-confirm')}}" method="post" enctype="multipart/form-data" id="form-modify-item">
      	<div class="modal-header">
      	  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      	  <h4 class="modal-title" id="myModalLabel">Modify item</h4>
      	</div>
      	<div class="modal-body">
      	  <div id="modify-modal"></div>
      	</div>
      	<div class="modal-footer">
      	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      	  <button type="submit" class="btn btn-primary">Save changes</button>
      	</div>
      </form>
    </div>
  </div>
</div>

<script>

	$('#form-modify-item').validate({
		rules: {
			name: {
				required: true,
				minlength: 3
			},
			price: {
				min:1,
			}
		}
	});

	$('button.del-button').click(function() {
		item_id = $(this).attr('id');
		$.ajax({
				url: '{{Asset('admin/delete-item')}}',
				type: 'post',
				data: {item_id: item_id, itemAtt_id: {{$itemAtt->id}}},
				success: function (data) {
					$('#result').html(data);
				}
			});
	});

	$('button.modify-button').click(function() {
		item_id = $(this).attr('id');
		$.ajax({
				url: '{{Asset('admin/modify-item')}}',
				type: 'post',
				data: {item_id: item_id},
				success: function (data) {
					$('#modify-modal').html(data);
				}
			});
	});

</script>