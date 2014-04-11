@extends("admin_theme")

@section('title')
Manage Items
@endsection

@section("content")

<div class="container">
	<div class="row">
		<div class="page-header">
			<h1>Item Manages</h1>
		</div>
		@include('notification')
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-3 form-group">
			<label for="selectCategory_id" class="control-label">Category</label>
			<select name="category_id" id="selectCategory_id" class="form-control" required="required">
				<option value="-1">-- Select category --</option>
				@foreach (Category::get() as $category)
				<option value="{{$category->id}}">{{ucfirst($category->name)}}</option>
				@endforeach

			</select>
		</div>
		<div class="col-sm-3 form-group">
			<label for="selectItemType_id" class="control-label">Item Type</label>
			<select name="itemType_id" id="selectItemType_id" class="form-control" required="required">
				<option value="-1">-- Select Item Type --</option>
			</select>
		</div>
		<div class="col-sm-3 form-group">
			<label for="selectItemAtt_id" class="control-label">Item Attribute</label>
			<select name="itemAtt_id" id="selectItemAtt_id" class="form-control" required="required">
				<option value="-1">-- Select Item Attribute --</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-2" btn-block>
			<button type="button" class="btn btn-default btn-block" id="filter-button">Filter</button>
		</div>
	</div>
</div>
<br/>
<div id="result"></div>

<script>
	$(document).ready(function(){
		$('#selectCategory_id').change(function() {
			category_name = $('#selectCategory_id option:selected').text();
			category_id = $(this).val();
			$.ajax({
					url: '{{Asset('ajax/pick-category')}}',
					type: 'post',
					data: {category_id: category_id},
					success: function (data) {
						$('#selectItemType_id').html(data);
					}
				});
		});

		$('#selectItemType_id').change(function() {
			itemType_id = $(this).val();
			itemType_name = $('#selectItemType_id option:selected').text();
			$.ajax({
					url: '{{Asset('ajax/pick-itemType')}}',
					type: 'post',
					data: {itemType_id: itemType_id},
					success: function (data) {
						$('#selectItemAtt_id').html(data);
					}
				});
		});

		$('#filter-button').click(function(){
			if ($('#selectItemAtt_id').val()<0) {
				alert('Please select item attribute')
				return false;
			} else {
				itemAtt_id = $('#selectItemAtt_id').val();
				$.ajax({
						url: '{{Asset('admin/manage-items')}}',
						type: 'post',
						data: {itemAtt_id: itemAtt_id},
						success: function (data) {
							$('#result').html(data);
						}
					});
			}

		});


	});
</script>
@endsection