<?php
if ($typeLink != 'view-all' && $typeLink != 'new-arrivals') {
	$typeLink_id = ItemType::where('name', '=', $typeLink)->first()->id;
}
?>
<section id="products_header" style="margin-bottom:1em;padding-left:1em;">
    <h3>Khuyến mãi</h3>
    <span style="text-decoration: underline;">SM Shop</span> / 
    <span>
	    {{ucfirst($category->name)}} 
	    @if ($typeLink != 'view-all') / {{ucfirst($typeLink)}} @endif
	    @if (isset($attLink)) / {{ucfirst($attLink)}} @endif
    </span>
</section>
<div class="row" id="products_container">
	@foreach ($items as $item)
	<div class="col-sm-3">
	    <div class="products">
	        <a class="item-ajax-a" href="{{Asset('item/'.$item->id)}}"><img src="{{Asset('assets/img/products/'.$item->urlPic1)}}" class="img-responsive" alt="Image"></a>
	        <br/>
	        <div style="margin-bottom:0.5em">
	            {{ucfirst($item->name)}}<br/>
	            <small style="color:gray; text-decoration:line-through">VND {{number_format($item->price, 0, '.', ',')}}</small><br/>
	            <span>VND {{number_format($item->sale_price, 0, '.', ',')}}</span>
	        </div>
	    </div>
	</div>
	@endforeach
	
</div>
<div class="row">
	<div class="col-sm-12">
		<div style="padding-left:1em; margin-top:-0.5em">{{$items->links()}}</div>
	</div>
</div>

<script>
	// link pagination for ajax
    $('ul.pagination li a').on('click', function(event){
        event.preventDefault();
        if ($(this).attr('href') != '#') {
            $('html, body').animate({ scrollTop: 0}, 'fast');
            $('#div-content').load($(this).attr('href'));
        }
    });

    // link a ajax
    $('.item-ajax-a').click(function(){
        url = $(this).attr('href');
        $.get(url, function(data){
            $('#div-content').html(data);
        });
        return false;
    });


</script>

