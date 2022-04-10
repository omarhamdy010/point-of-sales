<table class="table table-hover table mb-0" id="print-area">
    <thead>
    <tr>
        <th>#</th>
        <th>{{__('site.name')}}</th>
        <th>{{__('site.quantity')}}</th>
        <th>{{__('site.price')}}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($products as $index=>$product)
        <tr>
            <td class="text-bold-500">{{$index+1}}</td>
            <td class="text-bold-500">{{$product->name}}</td>
            <td class="text-bold-500">{{$product->pivot->quantity}}</td>
            <td class="text-bold-500">{{number_format($product->pivot->quantity * $product->selling_price,2)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="row">
    <h5>{{__('site.total')}} <span> {{number_format($order->total_price, 2)}}</span></h5>
</div>

<div>
    <button class="btn btn-block btn-primary print-btn">{{__('site.print')}}</button>
</div>
