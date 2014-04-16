@extends("theme")

@section('title')
Shoping Guilde
@endsection

@section("content")
<div id="content" class="row">
    <div class="col-sm-2">
        <nav id="nav_header">
            <h3>Hướng dẫn mua hàng</h3>
        </nav>
        <nav id="categories">
            <ul id="left_nav">
                <li class="category_li">
                    <a class="category_a ajax-a" href="{{asset('info/size-reference')}}">Tra size quần áo, giầy dép</a></span>
                </li>
                <li class="category_li">
                    <a class="category_a ajax-a" href="#">Cách mua hàng</a></span>
                </li>
                <li class="category_li">
                    <a class="category_a ajax-a" href="#">Phương thức thanh toán</a></span>
                </li>
                <li class="category_li">
                    <a class="category_a ajax-a" href="#">Chính sách giao nhận, đổi trả hàng</a></span>
                </li>
                <li class="category_li">
                    <a class="category_a ajax-a" href="#">Mua hộ hàng trên Web US</a></span>
                </li>
            </ul>
        </nav>  
    </div>

    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12" id="div-content">
                <div style="margin-bottom:1em;padding-left:1em;">
                    <h3>Hướng dẫn mua hàng</h3>
                    <span style="text-decoration: underline;">SM Shop</span> / <span style="color:gray">Hướng dẫn mua hàng</span>
                </div>
                <div class="row" id="products_container">
                    <div class="col-sm-12">
                        <img src="{{Asset('assets/img/shopping_guide.png')}}" class="img-responsive" alt="Image" style="width:100%">
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
        
                    
        var $trig = $('nav#categories ul');
        $trigger = $trig.find('a.category_a');     
        $trigger.click(function () {
            $current_li = $(this).next('li');
            $('.category_li').removeClass('active');
            $current_li.addClass('active');
        });

        // $triggerA = $trig.find('a.itemType_a');
        // $triggerA.click(function(){
        //     $('.itemType_li').removeClass('active');
        //     $(this).parent('li').addClass('active');
        // });

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