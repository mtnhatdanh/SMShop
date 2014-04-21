@extends("theme")

@section('title')
Welcome to SM Shop - Sale
@endsection

@section("content")
<div id="content" class="row">
    <div class="col-sm-2">
        <nav id="nav_header">
            <h3>Khuyến mãi</h3>
        </nav>
        <nav id="categories">
            <ul id="left_nav">
                @foreach (Category::get() as $category)
                <li class="category_li">
                    <a class="category_a ajax-a" href="{{Asset('sale/'.$category->name)}}"><strong>{{ucfirst($category->name)}}</strong></a></span>
                    <ul>
                        <li class="itemType_li"><a class="itemType_a ajax-a" href="{{Asset('sale/'.$category->name)}}">View all</a></li>
                        @foreach ($category->itemTypes()->where('enable', '=', 1)->get() as $itemType)
                        <li class="itemType_li">
                            <a href="{{Asset('sale/'.$category->name.'/'.$itemType->id)}}" class="ajax-a itemType_a">{{ucfirst($itemType->name)}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </nav>  
    </div>

    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12" id="div-content">
                <div style="margin-bottom:1em;padding-left:1em;">
                    <h3>Khuyến mãi</h3>
                    <span style="text-decoration: underline;">SM Shop</span> / <span style="color:gray">Khuyến mãi</span>
                </div>
                <div class="row" id="products_container">
                    <div class="col-sm-12">
                        <img src="{{Asset('assets/img/SALE.jpg')}}" class="img-responsive" alt="Image" style="width:100%">
                    </div>
                </div>
            </div > 
        </div>
        @include('footer')
    </div>
</div>
<div id="loading_div"></div>

<script>
    $(document).ready(function(){
        // left nav jquery
        var $unstyleUl = $('nav#categories ul');
        $unstyleUl.addClass('list-unstyled');
        
        var $dropDown = $('nav#categories ul li ul');
        $dropDown.addClass("drop"); 
            
        var $trig = $('nav#categories ul');
        $trigger = $trig.find('a.category_a');     
        $trigger.click(function () {
            $dropDown.hide();
            $current_ul = $(this).next('ul');
            $current_ul.show();
            $('.itemType_li').removeClass('active');
            $first_li = $current_ul.children('li:first');
            $first_li.addClass('active');
        });

        $triggerA = $trig.find('a.itemType_a');
        $triggerA.click(function(){
            $('.itemType_li').removeClass('active');
            $(this).parent('li').addClass('active');
        });

        // link a ajax
        $('.ajax-a').click(function(){
            url = $(this).attr('href');
            $.get(url, function(data){
                $('#div-content').html(data);
            });
            return false;
        });

        // jquery for loading gif
        $abcdef = $('body');

        $(document).on({
            ajaxStart: function() { 
                $abcdef.addClass("loading");
            },
            ajaxStop: function() { 
                $abcdef.removeClass("loading");
            }    
        });

        
        
    })
</script>

@endsection