@extends('Layout_admin')
@section('title','Order')
@section('contect')
    <div class="page-heading">
        @include('Admin.SampleTitle')

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active clicklist" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">List</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link editclick" id="addproduct-tab" data-bs-toggle="tab"
                            data-bs-target="#addproduct" type="button" role="tab" aria-controls="addproduct"
                            aria-selected="false"></button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card-header">
                            List Datatable
                        </div>
                        <div class="card-body">
                            <table class="table" id="Loadsample">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="addproduct" role="tabpanel" aria-labelledby="addproduct-tab">
                        <div class="row match-height">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="card-header">
                                                <h3 style="text-align: center;">Customer Information</h3>
                                            </div>
                                            <form class="form" id="submit_form" action="post">
                                                <input type="hidden" id="hidden_cate_id">
                                                <input type="hidden" id="code_hidden">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Name</label>
                                                            <input type="text" class="form-control" name="cus_name"
                                                                id="cus_name" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Email</label>
                                                            <input type="text" class="form-control" name="cus_email"
                                                                id="cus_email" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Phone</label>
                                                            <input type="text" class="form-control" name="cus_phone"
                                                                id="cus_phone" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Payment</label>
                                                            <input type="text" class="form-control" name="cus_pay"
                                                                id="cus_pay" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Address</label>
                                                            <textarea class="form-control" name="cus_address"
                                                                id="cus_address" rows="4" disabled></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12 dis_note display">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Note</label>
                                                            <textarea class="form-control" name="cus_note" id="cus_note"
                                                                rows="4" disabled></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="card-header">
                                                        <h3 style="text-align: center;">List Order Details</h3>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <table class="table">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col">Product</th>
                                                                    <th scope="col">Qty</th>
                                                                    <th scope="col">Qty Sold</th>
                                                                    <th scope="col">Coupon</th>
                                                                    <th scope="col">Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="detailorder">

                                                            </tbody>
                                                            <tfoot id="loadtotal">

                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="country-floating">Status</label>
                                                            <select class="form-control" id="status_or" name="status_or">
                                                                <option value="1">PROCESSING</option>
                                                                <option value="2">BEING TRANSPORTED</option>
                                                                <option id="com_pay" class="display" value="3">
                                                                    COMPLETELY PAYMENT</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
@section('css')
    <link rel="stylesheet"
        href="{{ asset('backend/assets/vendors/jquery-datatables/jquery.dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/toastify/toastify.css') }}">
    <style>
        .display {
            display: none;
        }
        .textTranform{
            text-transform: uppercase;
        }

    </style>
@endsection
@section('js')
    <script src="{{ asset('backend/assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/vendors/toastify/toastify.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        // Load Datatable
        $('#Loadsample').DataTable({
            destroy: true,
            order: [],
            ajax: {
                url: "{{ route('order.index') }}",
            },
            columns: [{
                    data: null,
                    render: function(data, type, full, meta) {
                        return '#' + data.order_code + '';
                    },

                },
                {
                    data: 'customer_name'
                },
                {
                    data: 'customer_pay'
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        if (data.order_status == 1) {
                            return "<span class='badge bg-light-danger textTranform'>Processing</span>";
                        } else if (data.order_status == 2) {
                            return "<span class='badge bg-light-info textTranform'>being transported</span>";
                        } else {
                            return "<span class='badge bg-light-success textTranform'>COMPLETELY PAYMENT</span>";
                        }
                    },
                    orderable: false
                },
                {
                    data: 'action'
                }
            ]
        });
        // Reset Form
        $('.clicklist').click(function() {
            $('.editclick').text('')
        });
        //Edit
        $(document).on('click', '.editsample', function(e) {
            var id = $(this).data('id');
            $('.clicklist').removeClass('active show');
            $('.editclick').addClass('active show');
            $('#home').removeClass('active show');
            $('#addproduct').addClass('active show');

            $.ajax({
                type: 'get',
                url: 'order/' + id,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 200) {
                        $('.editclick').text('Detail "#' + res.order.order_code + '"');
                        $('#hidden_cate_id').val(id);
                        $('#cus_name').val(res.cus.customer_name);
                        $('#cus_email').val(res.cus.customer_email);
                        $('#cus_phone').val(res.cus.customer_phone);
                        $('#cus_pay').val(res.cus.customer_pay);
                        $('#cus_address').text(res.cus.customer_address);
                        $('#status_or').val(res.order.order_status);
                        if (res.cus.customer_note != null) {
                            $('.dis_note').removeClass('display');
                            $('#cus_note').text(res.cus.customer_note);
                        }else{
                            $('.dis_note').addClass('display');
                        }
                        if (res.order.order_status == 3) {
                            $('#status_or').attr('disabled', true);
                        }
                        if (res.order.order_status == 2) {
                            $('#com_pay').removeClass('display');
                        }else{
                            $('#com_pay').addClass('display');
                        }
                        $('#code_hidden').val(id);
                        $('#detailorder').html(res.data);
                        $('#loadtotal').html(res.data_2);
                    } else {
                        alert(res.message)
                    }
                }
            });
        });
        // Change Qty
        $(document).on('blur', '.update_qty', function() {
            var id = $(this).data('id');
            var order_text = $('.idpro_' + id + '').text();
            var code_hidden = $('#code_hidden').val();

            $.ajax({
                type: 'put',
                url: 'order/' + id,
                data: {
                    order_text: order_text,
                    code_hidden: code_hidden
                },
                success: function(res) {
                    if (res.status == 200) {
                        $('.subtotal').text(res.subtotal);
                        $('.total').text(res.total);
                        Toastify({
                            text: "" + res.message + "",
                            duration: 3000,
                            close: true,
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        }).showToast();
                    } else if (res.status == 400) {
                        $.each(res.errors, function(key, err_values) {
                            alert(err_values);
                        });
                        $('.idpro_' + id + '').text(res.data.order_de_qty);
                    } else {
                        alert(res.message);
                        $('.idpro_' + id + '').text(res.data.order_de_qty);
                    }
                }

            });
        });
        // Change Status
        $(document).on('change', '#status_or', function(e) {
            e.preventDefault();
            var value = $(this).val();
            var id = $('#code_hidden').val();

            //lay so luong
            quantity = [];
            $("input[name='product_quantity_order']").each(function() {
                quantity.push($(this).val());
            });

            //lay product id
            order_product_id = [];
            $("input[name='order_product_id']").each(function() {
                order_product_id.push($(this).val());
            });

            j = 0;
            for (i = 0; i < order_product_id.length; i++) {
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

                if (parseInt(order_qty) > parseInt(order_qty_storage)) {
                    j += 1;
                    if (j == 1) {
                        alert('Số lượng trong kho không đủ');
                    }
                    $('.color_qty_' + order_product_id[i]).css('color', '#e74a3b').css('font-weight', 'bold');
                }

            }
            if (j == 0) {

                $.ajax({
                    type: 'get',
                    url: 'order/' + id + '/edit',
                    data: {
                        value: value,
                        order_product_id: order_product_id,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.status == 404) {
                            alert(response.message);
                        } else {
                            $('#Loadsample').DataTable().ajax.reload();
                            $('.clicklist').addClass('active show');
                            $('.editclick').removeClass('active show');
                            $('#home').addClass('active show');
                            $('#addproduct').removeClass('active show');
                            $('.editclick').text('');
                            Toastify({
                                text: "" + response.message + "",
                                duration: 3000,
                                close: true,
                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                            }).showToast();
                        }
                    }

                });
            }
        });
        // Delete
        $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'delete',
                            url: 'order/' + id,
                            success: function(res) {
                                if (res.status == 200) {
                                    setTimeout(function() {
                                        $('#Loadsample').DataTable().ajax.reload();
                                    }, 1000);
                                    swal("Poof! " + res.message + "", {
                                        icon: "success",
                                    });
                                } else {
                                    alert(res.message);
                                }

                            }
                        });
                    } else {
                        swal("Your file is safe!", {
                            icon: "error",
                        });
                    }
                });

        });
    </script>
@endsection
