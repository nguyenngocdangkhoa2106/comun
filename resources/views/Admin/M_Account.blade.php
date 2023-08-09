@extends('Layout_admin')
@section('title','Account')
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Level</th>
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
                                                            <label for="first-name-column">Name</label>
                                                            <input type="text" required class="form-control"
                                                                name="user_name" id="user_name" placeholder="Enter Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Email</label>
                                                            <input type="text" required class="form-control"
                                                                name="user_email" id="user_email" placeholder="Enter Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Password</label>
                                                            <input type="password" required class="form-control"
                                                                name="user_password" id="user_password" placeholder="Enter Password">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="country-floating">Status</label>
                                                            <select class="form-control" id="user_level" name="user_level"
                                                                required>
                                                                <option value="1">User</option>
                                                                <option value="2">Admin</option>
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

    <script>
        $('#submit_form').parsley();
        // Load Datatable
        $('#Loadsample').DataTable({
            destroy: true,
            order: [],
            ajax: {
                url: "{{ route('account.index') }}",
            },
            columns: [{
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        if (data.level == 1) {
                            $output =
                                '<button type="button" class="btn btn-danger btn-sm click_status" data-id="' +
                                data.id + '"><i class="fas fa-user"></i></button>';
                        } else {
                            $output =
                                '<button type="button" class="btn btn-success btn-sm click_status" data-id="' +
                                data.id + '"><i class="fas fa-user-secret"></i></button>';
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
            $('.card-title').text('Add Account');
            $('.editclick').text('Add')
            $('#submit_form')[0].reset();
            $('#submit_form').parsley().reset();
        });
        // Add & Update
        $(document).on('submit', '#submit_form', function(e) {
            e.preventDefault();
            if ($('#submit_form').parsley().isValid()) {
                var action_url = '';
                var action_type = '';
                var user_name = $('#user_name').val();
                var user_email = $('#user_email').val();
                var user_password = $('#user_password').val();
                var user_level = $('#user_level').val();

                if ($('#hidden_action').val() == 'Add') {
                    action_url = '{{ route('account.store') }}';
                    action_type = 'POST';
                } else {
                    var id = $('#hidden_cate_id').val();
                    action_url = 'account/' + id;
                    action_type = 'PUT';
                }

                $.ajax({
                    type: action_type,
                    url: action_url,
                    data: {
                        user_name:user_name,
                        user_email:user_email,
                        user_password:user_password,
                        user_level:user_level,
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
                                $('.card-title').text('Add Account');
                            }
                        } else {
                            $.each(res.errors, function(key, err_values) {
                                Toastify({
                                    text: "" + err_values + "",
                                    duration: 3000,
                                    close: true,
                                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                                }).showToast();
                            });
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
            $('#user_password').attr('required',false);
            $.ajax({
                type: 'get',
                url: 'account/' + id,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 200) {
                        $('.card-title').text('Edit Coupon');
                        $('#hidden_action').val('Edit');
                        $('.editclick').text('Edit "' + res.data.name + '"');
                        $('#hidden_cate_id').val(id);
                        $('#user_name').val(res.data.name);
                        $('#user_email').val(res.data.email);
                        $('#user_password').val();
                        $('#user_level').val(res.data.level);
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
                            url: 'account/' + id,
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
            var id = $(this).data('id');

            $.ajax({
                type: 'get',
                url: 'account/' + id + '/edit',
                success: function(res) {
                    if (res.status == 200) {
                        $('#Loadsample').DataTable().ajax.reload();
                        Toastify({
                            text: "" + res.message + "",
                            duration: 3000,
                            close: true,
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        }).showToast();
                    } else {
                        alert(res.message);
                    }
                }
            });
        });
    </script>
@endsection
