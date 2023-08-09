@extends('Layout_admin')
@section('title','Coupon')
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
                            aria-selected="false">Add</button>
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
                                        <th>Status</th>
                                        <th>Date</th>
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
                                    <div class="card-header">
                                        <h4 class="card-title">Add {{ $title }}</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form" id="submit_form" action="post">
                                                <input type="hidden" id="hidden_cate_id">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Code</label>
                                                            <input type="text" id="coupon_code" name="coupon_code"
                                                                class="form-control" placeholder="Enter Code" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Qty</label>
                                                            <input type="munber" id="coupon_qty" name="coupon_qty"
                                                                class="form-control" placeholder="Enter Qty" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Date Start</label>
                                                            <input type="munber" id="coupon_date_start"
                                                                name="coupon_date_start" class="form-control"
                                                                placeholder="Enter Date Start" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Date End</label>
                                                            <input type="munber" id="coupon_date_end" name="coupon_date_end"
                                                                class="form-control" placeholder="Enter Date End"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="country-floating">Condition</label>
                                                            <select class="form-control" id="coupon_condition"
                                                                name="coupon_condition" required>
                                                                <option value="">Choose</option>
                                                                <option value="1">Money</option>
                                                                <option value="2">Percent</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12 salenumber display">
                                                        <label for="country-floating"
                                                            class="title_coupon_condition">Money</label>
                                                        <div class="form-group position-relative has-icon-left">
                                                            <input type="text" required
                                                                data-parsley-pattern="^[1-9]\d{0,7}(?:\.\?:\,\d{1,4})?$"
                                                                data-parsley-trigger="keyup" class="form-control"
                                                                id="coupon_sale_number" name="coupon_sale_number">
                                                            <div class="form-control-icon icon_coupon_condition">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="country-floating">Status</label>
                                                            <select class="form-control" id="coupon_status"
                                                                name="coupon_status" required>
                                                                <option value="1">Show</option>
                                                                <option value="2">Hide</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-12 d-flex justify-content-end mt-3">
                                                    <input type="hidden" id="hidden_action" value="Add">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1 submit"
                                                        style="margin-bottom: -3% !important;">Submit</button>
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
    <link href="{{ asset('frontend/parsley.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <style>
        .display {
            display: none;
        }

    </style>
@endsection
@section('js')
    <script src="{{ asset('backend/assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}">
    </script>
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script src="{{ asset('backend/assets/vendors/toastify/toastify.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        $("#coupon_date_start, #coupon_date_end").datepicker({
            dateFormat: "yy/mm/dd"
        });

        $('#submit_form').parsley();
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        // Load Datatable
        $('#Loadsample').DataTable({
            destroy: true,
            order: [],
            ajax: {
                url: "{{ route('coupon.index') }}",
            },
            columns: [{
                    data: 'coupon_code'
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        if (data.coupon_status == 1) {
                            $output =
                                '<div class="form-check form-switch">\
                                            <input class="form-check-input click_status" value="' +
                                data.coupon_id + '" type="checkbox" checked>\
                                        </div>';
                        } else {
                            $output =
                                '<div class="form-check form-switch">\
                                            <input class="form-check-input click_status" value="' +
                                data.coupon_id + '" type="checkbox">\
                                        </div>';
                        }
                        return $output;
                    },
                    orderable: false
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        var date_end = new Date(data.coupon_date_end);
                        var date_end_dd = date_end.getDate();
                        var date_end_mm = date_end.getMonth() + 1;
                        var date_end_yyyy = date_end.getFullYear();
                        if (mm < date_end_mm && date_end_yyyy >= yyyy) {
                            $output =
                                '<button type="button" class="btn btn-success btn-sm">Expiry Date</button>';
                        } else if (mm == date_end_mm && date_end_yyyy == yyyy) {
                            if (date_end_dd >= dd) {
                                $output =
                                    '<button type="button" class="btn btn-success btn-sm">Expiry Date</button>';
                            } else {
                                $output =
                                    '<button type="button" class="btn btn-danger btn-sm">Out Of Date</>';
                            }
                        } else {
                            $output =
                                '<button type="button" class="btn btn-danger btn-sm">Out Of Date</button>';
                        }
                        return $output;
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
            $('#hidden_action').val('Add');
            $('.card-title').text('Add Coupon');
            $('.editclick').text('Add')
            $('#submit_form')[0].reset();
            $('#submit_form').parsley().reset();
            $('.salenumber').addClass('display');
        });
        // Change
        $('#coupon_condition').change(function() {
            var val = $(this).val();
            $('#coupon_sale_number').val('');
            if (val == 1) {
                $('.salenumber').removeClass('display');
                $('.icon_coupon_condition').html('<i class="fas fa-dollar-sign"></i>');
            } else {
                $('.salenumber').removeClass('display');
                $('.title_coupon_condition').text('Percent');
                $('.icon_coupon_condition').html('<i class="fas fa-percentage"></i>');
            }
        });
        // Add & Update
        $(document).on('submit', '#submit_form', function(e) {
            e.preventDefault();
            if ($('#submit_form').parsley().isValid()) {
                var action_url = '';
                var action_type = '';
                var coupon_code = $('#coupon_code').val();
                var coupon_qty = $('#coupon_qty').val();
                var coupon_date_start = $('#coupon_date_start').val();
                var coupon_date_end = $('#coupon_date_end').val();
                var coupon_condition = $('#coupon_condition').val();
                var coupon_sale_number = $('#coupon_sale_number').val();
                var coupon_status = $('#coupon_status').val();

                if ($('#hidden_action').val() == 'Add') {
                    action_url = '{{ route('coupon.store') }}';
                    action_type = 'POST';
                } else {
                    var id = $('#hidden_cate_id').val();
                    action_url = 'coupon/' + id;
                    action_type = 'PUT';
                }

                $.ajax({
                    type: action_type,
                    url: action_url,
                    data: {
                        coupon_code: coupon_code,
                        coupon_qty: coupon_qty,
                        coupon_date_start: coupon_date_start,
                        coupon_date_end: coupon_date_end,
                        coupon_condition: coupon_condition,
                        coupon_sale_number: coupon_sale_number,
                        coupon_status: coupon_status,
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $('.submit').attr('disabled', 'disabled');
                        $('.submit').val('Submitting...');
                    },
                    success: function(res) {
                        if (res.status == 200) {
                            $('#submit_form')[0].reset();
                            $('#submit_form').parsley().reset();
                            $('.submit').attr('disabled', false);
                            $('#Loadsample').DataTable().ajax.reload();
                            $('.salenumber').addClass('display');
                            Toastify({
                                text: "" + res.message + "",
                                duration: 3000,
                                close: true,
                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                            }).showToast();
                            if ($('#hidden_action').val() == 'Edit') {
                                $('.clicklist').addClass('active show');
                                $('.editclick').removeClass('active show');
                                $('#home').addClass('active show');
                                $('#addproduct').removeClass('active show');
                                $('#hidden_action').val('Add');
                                $('.editclick').text('Add');
                                $('.card-title').text('Add Coupon');
                            }
                        } else if(res.status == 404) {
                            $.each(res.errors, function(key, err_values) {
                                Toastify({
                                    text: "" + err_values + "",
                                    duration: 3000,
                                    close: true,
                                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                                }).showToast();
                            });
                            $('.submit').attr('disabled', false);
                        }else{
                            Toastify({
                                text: "" + res.message + "",
                                duration: 4000,
                                close: true,
                                backgroundColor: "#B94A48",
                            }).showToast();
                            $('#coupon_date_start').addClass('parsley-error');
                            $('#coupon_date_end').addClass('parsley-error');
                            $('.submit').attr('disabled', false);
                        }
                    }
                });
            }
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
                url: 'coupon/' + id,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 200) {
                        $('.salenumber').removeClass('display');
                        if(res.data.coupon_condition == 1){
                            $('.icon_coupon_condition').html('<i class="fas fa-dollar-sign"></i>');
                        }else{
                            $('.icon_coupon_condition').html('<i class="fas fa-percentage"></i>');
                        }
                        $('.card-title').text('Edit Coupon');
                        $('#hidden_action').val('Edit');
                        $('.editclick').text('Edit "' + res.data.coupon_code + '"');
                        $('#hidden_cate_id').val(id);
                        $('#coupon_code').val(res.data.coupon_code);
                        $('#coupon_qty').val(res.data.coupon_qty);
                        $('#coupon_date_start').val(res.data.coupon_date_start);
                        $('#coupon_date_end').val(res.data.coupon_date_end);
                        $('#coupon_condition').val(res.data.coupon_condition);
                        $('#coupon_sale_number').val(res.data.coupon_sale_number);
                        $('#coupon_status').val(res.data.coupon_status);
                    } else {
                        alert(res.message)
                    }
                }
            });
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
                            url: 'coupon/' + id,
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
        // Status
        $(document).on('click', '.click_status', function() {
            var checked = $(this).is(':checked');
            var id = $(this).val();
            var action = 'coupon';
            var statusss = '';

            if (checked == true) {
                statusss = 1;
            } else {
                statusss = 2;
            }

            $.ajax({
                type: 'post',
                url: '{{ route('home-admin.store') }}',
                data: {
                    statusss: statusss,
                    id: id,
                    action: action
                },
                success: function(res) {
                    if (res.status == 200) {
                        Toastify({
                            text: "" + res.message + "",
                            duration: 3000,
                            close: true,
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        }).showToast();
                        $('#Loadsample').DataTable().ajax.reload();
                    } else {
                        alert(res.message);
                    }
                }
            });
        });
    </script>
@endsection
