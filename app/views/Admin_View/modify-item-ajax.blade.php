<input type="hidden" name="item_id" value="{{$item->id}}">
<div class="row">
	<div class="col-sm-3 form-group">
		<label for="inputName" class="control-label">Name</label>
		<input type="text" name="name" value="{{$item->name}}" id="inputName" class="form-control" required="required" placeholder="Name..">
	</div>
	<div class="col-sm-3 form-group">
		<label for="inputPrice" class="control-label">Price</label>
		<input type="number" name="price" value="{{$item->price}}" id="inputPrice" class="form-control" required="required" placeholder="Price..">
	</div>
	<div class="col-sm-6 form-group">
		<label for="inputDescription" class="control-label">Description</label>
		<input type="text" name="description" value="{{$item->description}}" id="inputDescription" class="form-control" required="required" placeholder="Description..">
	</div>
</div>
<div class="row">
	<div class="col-sm-3">
		<img src="{{Asset('assets/img/products/'.$item->urlPic1)}}" class="img-responsive" alt="Image">
	</div>
	<div class="col-sm-3 form-group">
		<label for="inputUrlPic1" class="control-label">Pic1</label>
		<input type="file" id="inputUrlPic1" name="urlPic1">
	</div>
	<div class="col-sm-3">
		<img src="{{Asset('assets/img/products/'.$item->urlPic2)}}" class="img-responsive" alt="Image">
	</div>
	<div class="col-sm-3 form-group">
		<label for="inputUrlPic2" class="control-label">Pic2</label>
		<input type="file" id="inputUrlPic2" name="urlPic2">
	</div>
</div>
<div class="row">
	<div class="col-sm-3 form-group">
		<strong>Size</strong>
		<?php
		$sizeAvail = $item->size_available;
		$sizeAvail = (explode(' ', $sizeAvail));
		?>
		@foreach ($item->itemAtt->itemType->itemSizes as $itemSize)
		<div class='checkbox'>
			<label>
				<input name='size_available[]' value='{{$itemSize->value}}' type='checkbox' @if (in_array($itemSize->value, $sizeAvail)) checked @endif> {{$itemSize->value}}
			</label>
		</div>
		@endforeach
	</div>
	<div class="col-sm-3">
		<div class='checkbox'>
			<label>
				<input name='onsale' value="1" type='checkbox' @if ($item->onsale == 1) checked @endif> <strong>Onsale</strong>
			</label>
		</div>
	</div>
	<div class="col-sm-3 form-group">
		<label for="inputSale_price" class="control-label">Sale Price</label>
		<input type="text" name="sale_price" value="{{$item->sale_price}}" id="inputSale_price" class="form-control" placeholder="Sale price..">
	</div>
</div>