<?php
$category_name = $item->itemAtt->itemType->category->name;
$typeLink      = $item->itemAtt->itemType->name;
$attLink       = $item->itemAtt->name;
?>

<div class="row">
	<div class="col-sm-12">
		<section id="products_header" style="margin-bottom:1em;padding-left:1em;">
		    <h3>{{strtoupper($category_name)}}</h3>
		    <span style="text-decoration: underline;">SM Shop</span> / 
		    <span style="color:gray">
			    <a class="item-ajax-a" href="{{Asset('category/'.$category_name.'/view-all')}}">{{ucfirst($category_name)}}</a> 
			    @if ($typeLink != 'view-all') / <a href="">{{ucfirst($typeLink)}}</a> @endif
			    @if (isset($attLink)) / <a href="">{{ucfirst($attLink)}}</a> @endif
		    </span>
		</section>
	</div>
</div>
<div class="row" id="item_detail" style="padding-left:1em">
	<div class="col-sm-7">
		<div class="row">
			<div class="col-sm-9" style="margin-bottom:1em;">
				<div id="loading"></div>
				<div id="slideshow"></div>
				<!-- <div id="caption"></div> -->
			</div>
			<div id="thumbs">
			    <ul class="thumbs noscript list-unstyled">
			
			    	<li class="col-sm-3">
			            <a class="thumb" name="optionalCustomIdentifier" href="{{Asset('assets/img/products/'.$item->urlPic1)}}" title="your image title">
			                <img class="img-responsive" src="{{Asset('assets/img/products/'.$item->urlPic1)}}" alt="product pircture" />
			            </a>
			        </li>
			        <li class="col-sm-3">
			            <a class="thumb" name="optionalCustomIdentifier" href="{{Asset('assets/img/products/'.$item->urlPic2)}}" title="your image title">
			                <img class="img-responsive" src="{{Asset('assets/img/products/'.$item->urlPic2)}}" alt="product pircture" />
			            </a>

			        </li>
			
			    </ul>
			</div>
		</div>
	</div>
	<div class="col-sm-5">
		<p>
			<h3>{{ucfirst($item->name)}}</h3>
			@if ($item->onsale)
			<small style="color:gray; text-decoration: line-through">Giá: {{number_format($item->price, 0, '.', ',')}} VND</small><br/>
			@else
			<span>Giá: {{number_format($item->price, 0, '.', ',')}} VND</span>
			@endif
			@if ($item->onsale)
			<span>Giá: {{number_format($item->sale_price, 0, '.', ',')}} VND</span>
			@endif
			<br/>
		</p>
		<p>
			<strong>Description</strong><br/>
			{{$item->description}}
		</p>
		<p>
			<?php 
				$first = 0;
				$sizeAvail = $item->size_available;
				$sizeAvail = (explode(' ', $sizeAvail));
				?>
			<strong>Size: </strong><span id="size-span">{{$sizeAvail[0]}}</span><br/>
			<ul class="list-unstyled" id="size-ul">
				@foreach ($sizeAvail as $size)
				<li><span class="badge @if ($first == 0) active @endif">{{$size}}</span></li>
				<?php $first = 1?>
				@endforeach
				
			</ul>
		</p>
		<p style="margin-top:1em">
			<button type="button" class="btn btn-default add-to-cart">Add to cart</button>
		</p>
	</div>
</div>



<script>
	// Add to cart jQuery
	$('.add-to-cart').on('click', function () {
        var cart = $('#cart');
        var imgtodrag = $("a.advance-link img").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '300px',
                    'width': '300px',
                    'z-index': '100'
            })
                .appendTo($('body'))
                .animate({
                'top': cart.offset().top + 10,
                    'left': cart.offset().left + 10,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo');
            
            setTimeout(function () {
				item_id = {{$item->id}};
				size    = $('#size-span').text();
                $.ajax({
                		url: '{{Asset('cart-handle')}}',
                		type: 'post',
                		data: {item_id: item_id, size: size, type: 1},
                		success: function (data) {
                			$('#cartSum').html(data);
                		},
                		global: false
                	});
            }, 1500);

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
        }
    });
	

	// Pick Size
	$('span.badge').click(function(){
		$('.badge').removeClass('active');
		$(this).addClass('active');
		$('#size-span').text($(this).text());
	});

	// Slide show picture
	jQuery(document).ready(function($) {
	    var gallery = $('#thumbs').galleriffic({
	        delay:                     3000, // in milliseconds
	        numThumbs:                 20, // The number of thumbnails to show page
	        preloadAhead:              40, // Set to -1 to preload all images
	        enableTopPager:            false,
	        enableBottomPager:         false,
	        maxPagesToShow:            7,  // The maximum number of pages to display in either the top or bottom pager
	        imageContainerSel:         '#slideshow', // The CSS selector for the element within which the main slideshow image should be rendered
	        controlsContainerSel:      '#controls', // The CSS selector for the element within which the slideshow controls should be rendered
	        captionContainerSel:       '#caption', // The CSS selector for the element within which the captions should be rendered
	        loadingContainerSel:       '#loading', // The CSS selector for the element within which should be shown when an image is loading
	        renderSSControls:          true, // Specifies whether the slideshow's Play and Pause links should be rendered
	        renderNavControls:         true, // Specifies whether the slideshow's Next and Previous links should be rendered
	        playLinkText:              'Play',
	        pauseLinkText:             'Pause',
	        prevLinkText:              'Previous',
	        nextLinkText:              'Next',
	        nextPageLinkText:          'Next &rsaquo;',
	        prevPageLinkText:          '&lsaquo; Prev',
	        enableHistory:             false, // Specifies whether the url's hash and the browser's history cache should update when the current slideshow image changes
	        enableKeyboardNavigation:  true, // Specifies whether keyboard navigation is enabled
	        autoStart:                 false, // Specifies whether the slideshow should be playing or paused when the page first loads
	        syncTransitions:           false, // Specifies whether the out and in transitions occur simultaneously or distinctly
	        defaultTransitionDuration: 500, // If using the default transitions, specifies the duration of the transitions
	        onSlideChange:             undefined, // accepts a delegate like such: function(prevIndex, nextIndex) { ... }
	        onTransitionOut:           undefined, // accepts a delegate like such: function(slide, caption, isSync, callback) { ... }
	        onTransitionIn:            undefined, // accepts a delegate like such: function(slide, caption, isSync) { ... }
	        onPageTransitionOut:       undefined, // accepts a delegate like such: function(callback) { ... }
	        onPageTransitionIn:        undefined, // accepts a delegate like such: function() { ... }
	        onImageAdded:              undefined, // accepts a delegate like such: function(imageData, $li) { ... }
	        onImageRemoved:            undefined  // accepts a delegate like such: function(imageData, $li) { ... }
	    });
	});
</script>

