@extends("admin_theme")

@section('title')
Create Item
@endsection

@section("content")

<div class="container">
	<div class="row">
		<div class="page-header">
			<h1>Create new Item</h1>
		</div>
		@include('notification')
	</div>
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
	<form action="{{Asset('admin/create-item')}}" method="post" enctype="multipart/form-data" id="form-newItem">
		<div class="row">
			<div class="col-sm-8 form-group">
				<strong>Category - Type - Attribute selected: </strong><span id="span-category"></span> - <span id="span-type"></span> - <span id="span-attribute"></span>
				<input type="hidden" name="itemAtt_id" value="0" id="inputItemAtt_id">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3 form-group">
				<label for="inputName" class="control-label">Name</label>
				<input type="text" name="name" id="inputName" class="form-control" required="required" placeholder="Name..">
			</div>
			<div class="col-sm-3 form-group">
				<label for="inputPrice" class="control-label">Price</label>
				<input type="number" name="price" id="inputPrice" class="form-control" required="required" placeholder="Price..">
			</div>
			<div class="col-sm-6 form-group">
				<label for="inputDescription" class="control-label">Description</label>
				<input type="text" name="description" id="inputDescription" class="form-control" required="required" placeholder="Description..">
			</div>
			<div class="col-sm-3 form-group">
				<label for="inputUrlPic1" class="control-label">Pic1</label>
				<input type="file" id="inputUrlPic1" required="required" name="urlPic1">
			</div>
			<div class="col-sm-3 form-group">
				<label for="inputUrlPic2" class="control-label">Pic2</label>
				<input type="file" id="inputUrlPic2" required="required" name="urlPic2">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3 form-group">
				<strong>Size</strong>
				<div id="checkboxSize">
				</div>
			</div>
			<div class="col-sm-3">
				<div class='checkbox'>
					<label>
						<input name='onsale' value="1" type='checkbox'> <strong>Onsale</strong>
					</label>
				</div>
			</div>
			<div class="col-sm-3 form-group">
				<label for="inputSale_price" class="control-label">Sale Price</label>
				<input type="text" name="sale_price" id="inputSale_price" class="form-control" placeholder="Sale price..">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">
				<button type="submit" class="btn btn-primary btn-block">New Item</button>
			</div>
		</div>
	</form>
</div>
<script>
	$(document).ready(function(){
		$('#form-newItem').validate({
			rules: {
				name: {
					required: true,
					minlength: 3
				},
				price: {
					min:1,
				}
			},
		});

		$('#selectCategory_id').change(function() {
			category_name = $('#selectCategory_id option:selected').text();
			category_id = $(this).val();
			$('#span-category').html(category_name);
			$.ajax({
					url: '{{Asset('ajax/pick-category')}}',
					type: 'post',
					data: {category_id: category_id},
					success: function (data) {
						$('#selectItemType_id').html(data);
						$('#span-type').html('');
						$('#span-attribute').html('');
						$('#checkboxSize').html('');
					}
				});
		});

		$('#selectItemType_id').change(function() {
			itemType_id = $(this).val();
			itemType_name = $('#selectItemType_id option:selected').text();
			$('#span-type').html(itemType_name);
			$.ajax({
					url: '{{Asset('ajax/pick-itemType')}}',
					type: 'post',
					data: {itemType_id: itemType_id},
					success: function (data) {
						$('#selectItemAtt_id').html(data);
						$('#span-attribute').html('');
						$('#checkboxSize').html('');
					}
				});
		});

		$('#selectItemAtt_id').change(function(){
			itemAtt_name = $('#selectItemAtt_id option:selected').text();
			$('#span-attribute').html(itemAtt_name);
			itemAtt_id = $(this).val();
			$('#inputItemAtt_id').val(itemAtt_id);
			$.ajax({
					url: '{{Asset('ajax/pick-itemAtt')}}',
					type: 'post',
					data: {itemAtt_id: itemAtt_id},
					success: function (data) {
						$('#checkboxSize').html(data);
					}
				});
		});
	});
</script>

@endsection