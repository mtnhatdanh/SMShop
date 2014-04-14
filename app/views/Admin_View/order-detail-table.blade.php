<div class="row">
	<div class="col-sm-12">
		<table class="table table-responsive table-condensed table-striped">
			<tr>
                <td>No</td>
                <td>Hình</td>
                <td>Item</td>
                <td class="text-center">Size</td>
                <td class="text-center">Số lượng</td>
                <td class="text-right">Giá</td>
                <td class="text-right">Thành tiền</td>
            </tr>
            <?php 
			$no          = 0;
			$sumVND      = 0;
			$sumQuantity = 0;
            ?>
            @foreach ($order->orderDetails as $orderDetail)
            <?php 
            $item = $orderDetail->item;
            if ($item->onsale) {
                $price = $item->sale_price;
            } else $price = $item->price;
            $sumVND      += $price*$orderDetail->qty;
            $sumQuantity += $orderDetail->qty;
            ?>
            <tr>
            	<td>{{++$no}}</td>
            	<td><img src="{{asset('assets/img/products/'.$item->urlPic1)}}" class="img-responsive" alt="Image" style="height: 5em;"></td>
            	<td>{{ucfirst($item->name)}}</td>
                <td class="text-center">{{$orderDetail->size}}</td>
                <td class="text-center">{{$orderDetail->qty}}</td>
                <td class="text-right">{{number_format($price, 0, '.', ',')}}</td>
                <td class="text-right"><strong>{{number_format($price*$orderDetail->qty, 0, '.', ',')}}</strong></td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-center">Tổng cộng</td>
                <td class="text-center"><strong>{{$sumQuantity}}</strong></td>
                <td></td>
                <td class="text-right"><strong>{{number_format($sumVND, 0, '.', ',')}}</strong></td>
            </tr>
		</table>
	</div>
</div>