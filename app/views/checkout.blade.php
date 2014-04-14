@extends("theme")

@section('title')
SMShop - check out
@endsection

@section("content")



<div id="content">
    <div class="row">
    	<div class="col-sm-12 text-center">
    	    <h3>CHECK OUT</h3>
    	    SMShop/<span style="color:gray">Check out</span>
    	    <hr>
    	</div>
    </div>
    <div class="row" style="margin: 1em 0.7em 0em 0.7em;">
	    <div class="col-sm-6">
	    	<section id="cart-array">
				<?php 
				$sumVND      = 0;
				$sumQuantity = 0;
				$cart        = Cache::get('cart');
				?>
				@foreach ($cart as $key=>$itemCart)
				<?php
				$item = Item::find($itemCart->item_id);
				$sumQuantity += $itemCart->quantity;
				?>
				<div class="row" style="padding:0em 0.7em 0 0.7em">
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
									<div class="col-sm-4">
										<p>
											<span>Size:</span><br/>
											<span>Giá:</span><br/>
											<span>Số lượng:</span><br/>
											<span><strong>Thành tiền</strong></span>
										</p>
									</div>
									<div class="col-sm-8">
										<p>
											<strong>{{$itemCart->size}}</strong><br/>
											<?php 
											if ($item->onsale == 1) {
												$price = $item->sale_price;
											} else $price = $item->price;
											?>
											<span>{{number_format($price, 0, '.', ',')}} VND</span><br/>
											<span>{{$itemCart->quantity}}</span><br/>
											<span><strong>{{number_format($price*$itemCart->quantity, 0, '.', ',')}} VND</strong></span>
										</p>
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
	    </div>
	    <div class="col-sm-6">
	    	<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Thông tin</h3>
				</div>
				<?php 
				$email = Session::get('pax');
				$pax   = Pax::where('email', '=', $email)->first();
				?>
				<div class="panel-body">
					<table class="table table-responsive table-condensed" id="checkout_table" style="margin-top:1em">
						<tr>
							<th>Email:</th>
							<td>{{$pax->email}}</td>
						</tr>
						<tr>
							<th>Địa chỉ:</th>
							<td>{{$pax->address}}</td>
						</tr>
						<tr>
							<th>Số điện thoại:</th>
							<td>{{$pax->phone}}</td>
						</tr>
						<tr>
							<th>Tổng số hàng trong giỏ:</th>
							<td>{{$sumQuantity}}</td>
						</tr>
						<tr>
							<th>Tổng số tiền:</th>
							<td>{{number_format($sumVND, 0, '.', ',')}} VND</td>
						</tr>
					</table>
					<label for="note" class="label-control">Ghi chú</label>
					<textarea name="note" id="note-textarea" class="form-control" style="margin-bottom: 1em;"></textarea>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-3 col-sm-offset-3">
							<button type="button" class="btn btn-block btn-primary" data-toggle="modal" href='#checkout-modal'>Xác nhận</button>
						</div>
						<div class="col-sm-3">
							<button type="button" class="btn btn-default btn-block" onclick="goBack()">Trở về</button>
						</div>
					</div>
				</div>
	    	</div>
	    </div>
	</div>
	@include('footer')
</div>

<script>
	function goBack() {
		window.history.back();
	}
</script>

@endsection