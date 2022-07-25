@if(!empty(session('Cart')))
<div class="select-items">
    <table>
        <tbody>
            @foreach(session('Cart')->products as $item)
            <tr>
                <td class="si-pic"><img src="assets/img/products/{{$item['productInfo']->img}} " alt=""></td>
                <td class="si-text">
                    <div class="product-selected">
                        <p>{{number_format($item['productInfo']->price)}}$ x {{$item['quanty']}}</p>
                        <h6>{{$item['productInfo']->name}}</h6>
                    </div>
                </td>
                <td class="si-close">
                    <i class="ti-close" data-idCart="{{$item['productInfo']->id}}"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="select-total">
    <div class="box">
        <span>Total price :</span>
        <h5>{{number_format(session('Cart')->totalPrice)}}</h5>
        <!-- #total-quantyCart -->
        <input hidden type="number" name="" id="total-quantyCart" value="{{number_format(session('Cart')->totalQuanty)}}">
    </div>
</div>
@endif