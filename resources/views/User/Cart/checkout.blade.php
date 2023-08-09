@extends('Layout_user')
@section('content')
    @include('User.sample')
    @if ($info)
        @php
            $string = $info->info_order_name;
            parse_str($string,$output);
        @endphp
    @endif
    <!-- Checkout Start -->
    <div class="container-fluid">
        <form id="submit_checkout" method="POST">
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing
                            Address</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Fist Name<sup class="text-danger">*</sup></label>
                                <input class="form-control" id="firstname" name="firstname" type="text"
                                    placeholder="Fist Name" required value="{{ $info ? ''.$output['firstname'].'' : '' }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Last Name<sup class="text-danger">*</sup></label>
                                <input class="form-control" id="lastname" name="lastname" type="text"
                                    placeholder="Last Name" required value="{{ $info ? ''.$output['lastname'].'' : '' }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail<sup class="text-danger">*</sup></label>
                                <input class="form-control" type="email" id="email" name="email"
                                    placeholder="example@email.com" required value="{{ $info ? ''.$info->info_order_email.'' : '' }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Phone<sup class="text-danger">*</sup></label>
                                <input class="form-control" type="tel" id="phone" data-parsley-pattern="[0-9]{10}"
                                    data-parsley-trigger="keyup" name="phone" placeholder="023 456 7589" required value="{{ $info ? ''.$info->info_order_phone.'' : '' }}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Address<sup class="text-danger">*</sup></label>
                                <textarea id="address" class="form-control" id="address" name="address" rows="4"
                                    required placeholder="Enter Address">{{ $info ? ''.$info->info_order_address.'' : '' }}</textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Note</label>
                                <textarea id="note" class="form-control" id="note" name="note" rows="4" placeholder="Enter Note If Any"></textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="newaccount">
                                    <label class="custom-control-label" for="newaccount">Save Information</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                            Total</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom">
                            @php
                                $subtotal = 0;
                                $total = 0;
                            @endphp
                            <h6 class="mb-3">Products</h6>
                            @foreach ($carts as $cart)
                                @php
                                    if ($cart->product_price_sale != 0) {
                                        $price = $cart->product_price_sale;
                                    } else {
                                        $price = $cart->product_price;
                                    }
                                    $subtotal += $cart->cart_qty * $price;
                                @endphp
                                <div class="d-flex justify-content-between">
                                    <p>{{ Str::title($cart->product_name) }} <small>x {{ $cart->cart_qty }}</small></p>
                                    <p>
                                        @if ($cart->product_price_sale != 0)
                                            {{ number_format($cart->product_price_sale) }}
                                        @else
                                            {{ number_format($cart->product_price) }}
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-bottom pt-3 pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6>{{ number_format($subtotal) }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Discount</h6>
                                <h6 class="font-weight-medium">
                                    @if (Session::get('coupon'))
                                        @foreach(Session::get('coupon') as $coun)
                                            @if($coun['coupon_condition'] == 2)
                                            @php
                                                $subcoupon = $subtotal*$coun['coupon_number']/100;
                                                $total += $subtotal - $subcoupon;
                                            @endphp
                                            {{ $coun['coupon_number'].'%' }}
                                            @else
                                            @php
                                                $total += $subtotal - $coun['coupon_number'];
                                            @endphp
                                            {{ number_format($coun['coupon_number']) }}
                                            @endif
                                        @endforeach
                                    @else
                                        @php
                                            $total = $subtotal;
                                        @endphp
                                        0
                                    @endif
                                </h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5>{{ number_format($total) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span
                                class="bg-secondary pr-3">Payment</span></h5>
                        <div class="bg-light p-30">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input payment" name="payment" id="paypal"
                                        value="1">
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input payment" name="payment" id="directcheck"
                                        value="2" checked>
                                    <label class="custom-control-label" for="directcheck">Direct Check</label>
                                </div>
                            </div>
                            <button type="submit" style="background-color: #ffc439;" class="btn btn-block btn-primary font-weight-bold py-3 submit_a">Place
                                Order</button><br>
                            <div class="btnpaypal display" style="" id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
@section('css')
    <link href="{{ asset('frontend/parsley.css') }}" rel="stylesheet">
    <style>
        .display{
            display: none;
        }
    </style>
@endsection
@section('js')
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AU1aqbLwuw2HGSIQujQRTEMJ-m5aRTR_bKYLggDV8MOcDbR6AEdRKw8WuW5oYsGOMAWoojM-BWZNtu7Q" data-namespace="paypal_sdk"></script>
    <script>
        paypal_sdk.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ round($total * 0.0000441966, 2) }}'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    // alert('Transaction completed by ' + details.payer.name.given_name);
                    var firstname = $('#firstname').val();
                    var lastname = $('#lastname').val();
                    var email = $('#email').val();
                    var phone = $('#phone').val();
                    var address = $('#address').val();
                    var note = $('#note').val();
                    if ($('#paypal').is(':checked')) {
                        var pay = $('#paypal').val();
                    } else {
                        var pay = $('#directcheck').val();
                    }

                    var checked = $('#newaccount').is(':checked');
                    if (checked == true) {
                        var status = 1;
                    } else {
                        var status = 2;
                    }

                    $.ajax({
                        type: 'post',
                        url: '{{ route('checkout.store') }}',
                        data: {
                            firstname: firstname,
                            lastname: lastname,
                            email: email,
                            phone: phone,
                            address: address,
                            note: note,
                            pay: pay,
                            status: status
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            $('.submit_a').attr('disabled',true);
                            $('.submit_a').text('Submitting...');
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                alert(res.message);
                                location.replace(res.url);
                                $('.submit_a').attr('disabled',false);
                            } else {
                                alert(res.message);
                                location.replace(res.url);
                            }
                        }
                    });

                });
            }
        }).render('#paypal-button-container');
        $(document).ready(function() {
            $('#submit_checkout').parsley();
            $('.payment').click(function(){
                var check = $(this).val();
                if(check == 1){
                    $('.btnpaypal').removeClass('display');
                    $('.submit_a').addClass('display');
                }else{
                    $('.btnpaypal').addClass('display');
                    $('.submit_a').removeClass('display');
                }
            });
            $(document).on('submit', '#submit_checkout', function(e) {
                e.preventDefault();
                if ($('#submit_checkout').parsley().isValid()) {
                    var firstname = $('#firstname').val();
                    var lastname = $('#lastname').val();
                    var email = $('#email').val();
                    var phone = $('#phone').val();
                    var address = $('#address').val();
                    var note = $('#note').val();
                    if ($('#paypal').is(':checked')) {
                        var pay = $('#paypal').val();
                    } else {
                        var pay = $('#directcheck').val();
                    }

                    var checked = $('#newaccount').is(':checked');
                    if (checked == true) {
                        var status = 1;
                    } else {
                        var status = 2;
                    }
                    $.ajax({
                        type: 'post',
                        url: '{{ route('checkout.store') }}',
                        data: {
                            firstname: firstname,
                            lastname: lastname,
                            email: email,
                            phone: phone,
                            address: address,
                            note: note,
                            pay: pay,
                            status: status
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            $('.submit_a').attr('disabled',true);
                            $('.submit_a').text('Submitting...');
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                alert(res.message);
                                location.replace(res.url);
                            } else {
                                alert(res.message);
                                location.replace(res.url);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
