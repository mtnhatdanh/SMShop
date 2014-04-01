@foreach ($category->itemTypes as $itemType)
	@foreach ($itemType->itemAtts as $itemAtt)
		@foreach ($itemAtt->items as $item)
			<div class="col-sm-3">
			    <div class="products">
			        <a href="#"><img src="{{Asset('assets/img/products/'.$item->urlPic1)}}" class="img-responsive" alt="Image"></a>
			        <br/>
			        <div style="margin-bottom:0.5em">
			            {{ucfirst($item->name)}}<br/>
			            VND {{number_format($item->price, 0, '.', ',')}}<br/>
			        </div>
			    </div>
			</div>
		@endforeach
	@endforeach
@endforeach