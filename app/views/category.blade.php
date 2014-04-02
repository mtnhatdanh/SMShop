@extends("theme")

@section('title')
SM Shop - Mainpage
@endsection

@section("content")
<div id="content" class="row">
    <div class="col-sm-2">
        <nav id="nav_header">
            <h3>{{strtoupper($category->name)}}</h3>
            <ul class="list-unstyled">
                <li class="itemAtt_li"><a class="ajax-a" href="{{Asset('category/'.$category->name.'/view-all')}}">View All</a></span></li>
                <li class="itemAtt_li"><a href="#">New Arrivals</a></li>
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
                <div id="loadingDiv">
                    <img src="{{Asset('assets/img/ajax-loader.gif')}}" class="img-responsive" alt="Image">
                </div>
                <div style="margin-bottom:1em;padding-left:1em;">
                    <h3>KIDS</h3>
                    <span style="text-decoration: underline;">SM Shop</span> / <span style="color:gray">KIDS</span>
                </div>
                <div class="row" id="products_container">
                    <div class="col-sm-12">
                        <a href="#"><img src="{{Asset('assets/img/2LF_Page_01.jpg')}}" class="img-responsive" alt="Image"></a>
                    </div>
                </div>
            </div > 
        </div>
        <div class="row">
            <div class="col-sm-12"  style="padding: 1em">
                <footer> 
                    <div class="row">
                        <div class="col-sm-6">
                            <span>Copyright © 2014, design by: Minh Giang</span>
                        </div>
                        <div class="col-sm-6 text-right">
                            <ul class="social-links clearfix list-unstyled">
                                <li><a href="#" class="facebook"></a></li>
                                <li><a href="#" class="skype"></a></li>
                                <li><a href="#" class="yahoo"></a></li>
                            </ul>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</div>

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

        
        
    })
</script>

@endsection