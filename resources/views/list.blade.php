@extends('layouts.laravel_cart')
@section('content')
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                    <a href="{{url('/')}}">Shop</a>
                    <span>Shopping Cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="list-cart">
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
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th id="edit-all" class="close-td first-row">
                                        <i style="cursor:pointer ;" class="ti-save"></i>
                                    </th>
                                    <th id="delete-all" class="close-td first-row">
                                        <i style="cursor:pointer ;" class="ti-close"></i>
                                    </th>
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
                                                <input data-id="{{$item['productInfo']->id}}" id="quanty-item-{{$item['productInfo']->id}}" type="number" value="{{$item['quanty']}}" min=1>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price first-row">{{number_format($item['price'])}} $</td>
                                    <td class="close-td first-row">
                                        <i class="ti-save" onclick="saveItemListCart(<?php echo $item['productInfo']->id ?>)"></i>
                                    </td>
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
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

<!-- Footer Section Begin -->
<footer class="footer-section">
    <div class="copyright-reserved">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                    <div class="payment-pic">
                        <img src="{{asset('assets/img/payment-method.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
@endsection
@section('include-the-script')
<script>
    function renderListCart(response) {
        // console.log(response);
        $('#list-cart').empty();
        $('#list-cart').html(response);
    }

    function deleteItemListCart($id) {
        $.ajax({
            url: 'listCart/delete/' + $id,
            type: 'GET',
        }).done(function(response) {
            renderListCart(response);
            alertify.success('Đã xoá sản phẩm');
        });
    }

    function saveItemListCart($id) {
        $.ajax({
            url: 'listCart/save/' + $id + '/' + $('#quanty-item-' + $id).val(),
            type: 'GET',
        }).done(function(response) {
            renderListCart(response);
            $('#quanty-item-' + $id).val();
            alertify.success('Đã lưu sản phẩm');
        });
    }


    // saveAllListCart 
    $('#edit-all').on('click', function() {
        var list = [];
        $('.cart-table tr td').each(function() {
            $(this).find('input').each(function() {
                var element = {
                    key: $(this).attr('data-id'),
                    value: $(this).val()
                };
                list.push(element);
            });
        });
        $.ajax({
            url: 'listCart/saveAll',
            type: 'POST',
            data: {
                '_token': "{{csrf_token()}}",
                'data': list,
            }
        }).done(function(response) {
            location.reload();
        });
    });

    // deleteAllListCart
    $('#delete-all').on('click', function() {
        $.ajax({
            url: 'listCart/deleteAll',
            type: 'GET',
        }).done(function(response) {
            renderListCart(response);
            alertify.success('Đã xoá tất cả sản phẩm');
        });
    });
</script>
@endsection