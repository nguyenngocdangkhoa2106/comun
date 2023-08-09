@extends('Layout_user')
@section('content')
    @include('User.sample')


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="loadShowCart">

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30 addcoupon" action="{{ route('addcoupon') }}" method="POST">
                    <div class="input-group">
                        <input type="text" id="coupon_code" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary submit_coupon">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5" id="loadShowTotal">

                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('js')
    <script>
        // Load Cart
        function loadCart() {
            $.ajax({
                type: 'get',
                url: '{{ route('cart.index') }}',
                dataType: 'json',
                success: function(data) {
                    $('#loadShowCart').html(data.cart);
                    $('#loadShowTotal').html(data.total);
                }
            });
        }
        $(document).ready(function() {
            loadCart();
            $(document).on('click', '.clickCheckOut', function(e) {
                var href = $(this).data('href');
                location.replace(href);
            });
            // Add Coupon
            $(document).on('submit', '.addcoupon', function(e) {
                e.preventDefault();
                var action = $(this).attr('action');
                var coupon_code = $('#coupon_code').val();

                $.ajax({
                    type: 'post',
                    url: action,
                    data: {
                        coupon_code: coupon_code
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $('.submit_coupon').attr('disabled', 'disabled');
                        $('.submit_coupon').val('Submitting...');
                    },
                    success: function(res) {
                        if (res.message) {
                            loadCart();
                            alert(res.message);
                            $('.coupon_code').val('');
                            $('.submit_coupon').attr('disabled', false);
                            $('.submit_coupon').val('Apply Coupon');
                        } else if (res.error_login) {
                            alert(res.error_login);
                            setTimeout(function() {
                                location.replace(res.url);
                            }, 1000);
                        } else {
                            alert(res.error);
                            $('.submit_coupon').attr('disabled', false);
                            $('.submit_coupon').val('Apply Coupon');
                        }
                    }
                });
            });
            // Update Qty
            $(document).on('change', '.up_qty', function() {
                var id = $(this).data('id');
                var qty = $(this).val();

                $.ajax({
                    type: 'put',
                    url: 'cart/' + id,
                    data: {
                        qty: qty
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 200) {
                            loadCart();
                            alert(res.message);
                        } else {
                            alert(res.message);
                        }
                    }
                });
            });
            // Remove
            $(document).on('click', '.removecart', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    type: 'delete',
                    url: 'cart/' + id,
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 200) {
                            loadCart();
                            countCart();
                        } else {
                            alert(res.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
