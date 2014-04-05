@extends("theme")

@section('title')
test
@endsection

@section("content")

<?php
$item = Item::find(50);
?>

<div class="row">
	<div class="col-sm-12" style="margin-bottom:1em; margin-top:20em; margin-left:2em;">
		<div id="loading"></div>
		<div id="slideshow"></div>
		<!-- <div id="caption"></div> -->
	</div>
</div>
<div class="row">
	<div id="thumbs">
	    <ul class="thumbs noscript list-unstyled">
	
	    	<li class="col-sm-6">
	            <a class="thumb" name="optionalCustomIdentifier" href="{{Asset('assets/img/products/'.$item->urlPic1)}}" title="your image title">
	                <img class="img-responsive" src="{{Asset('assets/img/products/'.$item->urlPic1)}}" alt="your image title again for graceful degradation" />
	            </a>
	        </li>
	        <li class="col-sm-6">
	            <a class="thumb" name="optionalCustomIdentifier" href="{{Asset('assets/img/products/'.$item->urlPic2)}}" title="your image title">
	                <img class="img-responsive" src="{{Asset('assets/img/products/'.$item->urlPic2)}}" alt="your image title again for graceful degradation" />
	            </a>

	        </li>
	
	    </ul>
	</div>
</div>
<ul>
	<li>test</li>
	<li>test</li>
	<li>test</li>
</ul>

<script>
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
	        defaultTransitionDuration: 1000, // If using the default transitions, specifies the duration of the transitions
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



@endsection