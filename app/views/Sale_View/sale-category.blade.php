@extends("theme")

@section('title')
Welcome to SM Shop - Sale
@endsection

@section("content")
<div id="content" class="row">
    <div class="col-sm-2">
        <nav id="nav_header">
            <h3>SALE</h3>
            <ul class="list-unstyled">
                <li class="itemAtt_li"><a class="ajax-a" href="{{Asset('category/'.$category->name.'/view-all')}}">View All</a></span></li>
                <li class="itemAtt_li"><a class="ajax-a" href="{{Asset('category/'.$category->name.'/new-arrivals')}}">New Arrivals</a></li>
            </ul>
        </nav>
        <nav id="categories">
            <ul id="left_nav">
                @foreach ($category->itemTypes()->where('enable', '=', 1)->get() as $itemType)
                <li>
                    <a href="{{Asset('category/'.$category->name.'/'.$itemType->id)}}" class="category_a ajax-a">{{ucfirst($itemType->name)}}</a>
                    <ul>
                        <li class="itemAtt_li"><a class="itemAtt_a ajax-a" href="{{Asset('category/'.$category->name.'/'.$itemType->id)}}">View all</a></li>
                        @foreach ($itemType->itemAtts()->where('enable', '=', 1)->get() as $itemAtt)
                        <li class="itemAtt_li"><a class="itemAtt_a ajax-a" href="{{Asset('category/'.$category->name.'/'.$itemType->id.'/att/'.$itemAtt->id)}}">{{ucfirst($itemAtt->name)}}</a></li>
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
                    <h3>{{strtoupper($category->name)}}</h3>
                    <span style="text-decoration: underline;">SM Shop</span> / <span style="color:gray">{{strtoupper($category->name)}}</span>
                </div>
                <div class="row" id="products_container">
                    <div class="col-sm-12">
                        @if ($category->id == 1)
                        <img src="{{Asset('assets/img/2LF_Page_01.jpg')}}" class="img-responsive" alt="Image">
                        @elseif ($category->id == 2)
                        <img src="{{Asset('assets/img/2LF_Page_02.jpg')}}" class="img-responsive" alt="Image">
                        @elseif ($category->id == 3)
                        <img src="{{Asset('assets/img/2LF_Page_03.jpg')}}" class="img-responsive" alt="Image">
                        @elseif ($category->id == 4)
                        <img src="{{Asset('assets/img/2LF_Page_04.jpg')}}" class="img-responsive" alt="Image">
                        @endif
                    </div>
                </div>
            </div > 
        </div>
        <div class="row" style="margin-top:2em;">
            <div class="col-sm-12">
                <div class="row">               
                    <footer style="margin:0em 2em 0em 2em">
                        <div style="width:50%; float:left">
                            <span>Copyright © 2014, design by: Minh Giang</span>
                        </div>
                        <div style="width:50%; float:right">
                            <ul class="social-links clearfix list-unstyled">
                                <li><a href="#" class="facebook"></a></li>
                                <li><a href="#" class="skype"></a></li>
                                <li><a href="#" class="yahoo"></a></li>
                            </ul>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
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
            $('.itemAtt_li').removeClass('active');
            $first_li = $current_ul.children('li:first');
            $first_li.addClass('active');
        });

        $triggerA = $trig.find('a.itemAtt_a');
        $triggerA.click(function(){
            $('.itemAtt_li').removeClass('active');
            $(this).parent('li').addClass('active');
        });

        $triggerB = $('nav#nav_header').find('a');
        $triggerB.click(function(){
            $('.itemAtt_li').removeClass('active');
            $dropDown.hide();
            $(this).parent('li').addClass('active');
        });

        $('#loadingDiv').hide().ajaxStart( function() {
            $(this).show();  // show Loading Div
        } ).ajaxStop ( function(){
            $(this).hide(); // hide loading div
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