@if(!empty(session('Cart')))
<div class="cart-table">
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th class="p-name">Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            @foreach(session('Cart')->products as $item)
            <tr>
                <td class="cart-pic first-row" style="width: 10%;">
                    <img src="<?php echo (asset('assets/img/products') . '/' . $item['productInfo']->img) ?>" alt="">
                </td>
                <td class="cart-title first-row">
                    <h5>{{$item['productInfo']->name}}</h5>
                </td>
                <td class="p-price first-row">{{number_format($item['productInfo']->price)}} $</td>
                <td class="qua-col first-row">
                    <div class="quantity">
                        <div class="pro-qty">
                            <input type="text" value="{{$item['quanty']}}">
                        </div>
                    </div>
                </td>
                <td class="total-price first-row">{{number_format($item['price'])}} $</td>
                <td class="close-td first-row"><i class="ti-save"></i></td>
                <td class="close-td first-row">
                    <i class="ti-close" onclick="deleteItemListCart(<?php echo $item['productInfo']->id ?>);"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-lg-4 offset-lg-8">
        <div class="proceed-checkout">
            <ul>
                <li class="subtotal">Total quanty <span>{{session('Cart')->totalQuanty}}</span></li>
                <li class="cart-total">Total price<span>{{number_format(session('Cart')->totalPrice)}} $</span></li>
            </ul>
            <a href="#" class="proceed-btn">PROCEED TO CHECK OUT</a>
        </div>
    </div>
</div>
@endif