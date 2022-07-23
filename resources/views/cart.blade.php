@if(isset($newCart))

<div class="select-items">
    <table>
        <tbody>
            @foreach($newCart->products as $item)
            <tr>
                <td class="si-pic"><img src="assets/img/select-product-1.jpg" alt=""></td>
                <td class="si-text">
                    <div class="product-selected">
                        <p>{{$item->price}}vnd x {{$item['quanty']}}</p>
                        <h6>Kabino Bedside Table</h6>
                    </div>
                </td>
                <td class="si-close">
                    <i class="ti-close"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="select-total">
    <span>total:</span>
    <h5>{{number_format($newCart->totalPrice)}}</h5>
</div>
@endif