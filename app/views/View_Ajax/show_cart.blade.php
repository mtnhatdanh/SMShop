<section id="cart-array">
	<?php $sumVND = 0;?>
	@foreach ($cart as $key=>$itemCart)
	<?php
	$item = Item::find($itemCart->item_id);
	?>
	<div class="cart-div row" style="padding:0em 0.7em 0 0.7em">
		<div class="cart_container col-sm-12">
			<div class="row">
				<div class="col-sm-3 picture-container">
					<img src="{{Asset('assets/img/products/'.$item->urlPic1)}}" class="img-responsive" alt="Image">
				</div>
				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-12 cart_header">
							<h4>{{ucfirst($item->name)}}</h4>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<p>
								<span>Size:</span><br/>
								<span>Giá:</span><br/>
								<span>Số lượng:</span>
							</p>
						</div>
						<div class="col-sm-9">
							<p>
								<strong>{{$itemCart->size}}</strong><br/>
								<?php 
								if ($item->onsale == 1) {
									$price = $item->sale_price;
								} else $price = $item->price;
								?>
								<span>{{number_format($price, 0, '.', ',')}} VND</span><br/>
								<span><input class="itemCartQty" id="{{$key}}" type="text" value="{{$itemCart->quantity}}" size="2" style="text-align:center"></span>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<span><strong>Thành tiền: </strong></span>
						</div>
						<div class="col-sm-5">
							<span>{{number_format($price*$itemCart->quantity, 0, '.', ',')}} VND</span>
						</div>
						<div class="col-sm-4">
							<div class="cartRemove">
								<a class="del-itemCart" id="{{$key}}" href="javascript:{}">Hủy</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $sumVND +=  $price*$itemCart->quantity;?>
	@endforeach
	<div class="row" style="padding:0em 0.7em 0 0.7em">
		<div class="col-sm-12 text-center">
			<strong>Tổng cộng: </strong><h4 style="display: block; color:#2980b9">{{number_format($sumVND, 0, '.', ',')}} VND</h4>
		</div>
	</div>
</section>

<script>
	$(document).ready(function(){

		// Delete item cart jquery
		$('a.del-itemCart').click(function(){
			var $itemCart = $(this).parents('div.cart-div');
			$itemCart.toggle('blind');
			key = $(this).attr('id');
			$.ajax({
					url: '{{Asset('cart-handle')}}',
					type: 'post',
					data: {type: 2, key: key},
					success: function (data) {
						
						$('#cartSum').html(data);

						$.ajax({
				            url: '{{Asset('show-cart')}}',
				            type: 'get',
				            data: {},
				            success: function (data) {
				              $('#div-cart').html(data);
				            },
				            global: false
				        });
					},
					global: false
				});
		});

		// Modify qty cart jquery
		$('input.itemCartQty').blur(function(){
			key      = $(this).attr('id');
			quantity = $(this).val();
			$.ajax({
					url: '{{Asset('cart-handle')}}',
					type: 'post',
					data: {type: 3, key: key, quantity: quantity},
					success: function (data) {
						
						$('#cartSum').html(data);

						$.ajax({
				            url: '{{Asset('show-cart')}}',
				            type: 'get',
				            data: {},
				            success: function (data) {
				              $('#div-cart').html(data);
				            },
				            global: false
				        });
					},
					global: false
				});
		});
	});
</script>