@extends('Layout_admin')
@section('title','Slider')
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
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="sorting_orderby">

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
                                                                name="slider_name" id="slider_name"
                                                                placeholder="Enter Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="last-name-column">Name Sub</label>
                                                            <input type="text" required class="form-control"
                                                                name="slider_desc" id="slider_desc"
                                                                placeholder="Enter Name Sub">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="last-name-column">Url</label>
                                                            <input type="text" data-parsley-type="url"
                                                                data-parsley-trigger="keyup" class="form-control"
                                                                name="slider_url" id="slider_url" placeholder="Enter Url">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="country-floating">Status</label>
                                                            <select class="form-control" required id="slider_status"
                                                                name="slider_status">
                                                                <option value="1">Show</option>
                                                                <option value="2">Hide</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="country-floating">Image</label>
                                                            <input type="file" class="basic-filepond" id="slider_image"
                                                                name="slider_image" multiple required
                                                                data-max-file-size="2MB" data-max-files="1">
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
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/toastify/toastify.css') }}">
    <link href="{{ asset('frontend/parsley.css') }}" rel="stylesheet">
    <style>
        #parsley-id-15 {
            margin-top: 80px;
        }
    </style>
@endsection
@section('js')
    <script src="{{ asset('backend/assets/vendors/jquery-datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js') }}">
    </script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="http://parsleyjs.org/dist/parsley.js"></script>
    <script src="{{ asset('backend/assets/vendors/toastify/toastify.js') }}"></script>

    <!-- filepond validation -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

    <!-- image editor -->
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-filter/dist/filepond-plugin-image-filter.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        $('#submit_form').parsley();
        // register desired plugins...
        FilePond.registerPlugin(
            // validates the size of the file...
            FilePondPluginFileValidateSize,
            // validates the file type...
            FilePondPluginFileValidateType,
        );
        // Filepond: Basic
        pond = FilePond.create(
            document.querySelector('.basic-filepond'), {
                allowMultiple: true,
                instantUpload: false,
                allowProcess: false,
                acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
                fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                    // Do custom type detection here and return with promise
                    resolve(type);
                })
            });
        // Load Datatable
        $('#Loadsample').DataTable({
            destroy: true,
            order: [],
            ajax: {
                url: "{{ route('slider.index') }}",
            },
            columns: [{
                    data: null,
                    render: function(data, type, full, meta) {
                        return "<img src={{ URL::to('/') }}/uploads/slider/" + data
                            .slider_image + " width='90px' height='90px' class='img-thumbnail' />";
                    },
                    orderable: false
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        if (data.slider_status == 1) {
                            $output =
                                '<div class="form-check form-switch">\
                                                        <input class="form-check-input click_status" value="' +
                                data.slider_id + '" type="checkbox" checked>\
                                                    </div>';
                        } else {
                            $output =
                                '<div class="form-check form-switch">\
                                                        <input class="form-check-input click_status" value="' +
                                data.slider_id + '" type="checkbox">\
                                                    </div>';
                        }
                        return $output;
                    },
                    orderable: false
                },
                {
                    data: 'action'
                }
            ],
            createdRow: function(row, data, index) {
                $(row).attr("id", data['slider_id']);
            }
        });
        // Reset Form
        $('.clicklist').click(function() {
            $('#hidden_action').val('Add');
            $('.card-title').text('Add Category');
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
                var slider_title = $('#slider_name').val();
                var slider_content = $('#slider_desc').val();
                var slider_url = $('#slider_url').val();
                var slider_status = $('#slider_status').val();

                var data = new FormData(this);
                data.append('slider_title', slider_title);
                data.append('slider_content', slider_content);
                data.append('slider_url', slider_url);
                data.append('slider_status', slider_status);

                pondFiles = pond.getFiles();
                if (pondFiles.length > 0) {
                    data.append('slider_image', pondFiles[0].file);
                } else {
                    data.append('slider_image', '');
                }

                if ($('#hidden_action').val() == 'Add') {
                    action_url = '{{ route('slider.store') }}';
                    data.append('_method', 'POST');
                } else {
                    var id = $('#hidden_cate_id').val();
                    action_url = 'slider/' + id;
                    data.append('_method', 'PUT');
                }

                $.ajax({
                    type: 'post',
                    url: action_url,
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
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
                            $('.filepond--action-remove-item').click();
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
                                $('input[name="slider_image"]').attr('required', true);
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
                            $('.filepond--action-remove-item').click();
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
                url: 'slider/' + id,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 200) {
                        $('.card-title').text('Edit Slider');
                        $('#hidden_action').val('Edit');
                        $('.editclick').text('Edit "' + res.data.slider_title + '"');
                        $('#hidden_cate_id').val(id);
                        $('#slider_name').val(res.data.slider_title);
                        $('#slider_desc').val(res.data.slider_content);
                        $('#slider_url').val(res.data.slider_url);
                        $('#slider_status').val(res.data.slider_status);
                        $('input[name="slider_image"]').attr('required', false);
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
                            url: 'slider/' + id,
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
                        swal("Your imaginary file is safe!", {
                            icon: "error",
                        });
                    }
                });

        });
        // Status
        $(document).on('click', '.click_status', function() {
            var checked = $(this).is(':checked');
            var id = $(this).val();
            var action = 'slider';
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
        // Sorting
        $('#sorting_orderby').sortable({
            palceholder: 'ui-state-highlight',
            update: function(event, ui) {
                var slider_id_array = new Array();
                $('#sorting_orderby tr').each(function() {
                    slider_id_array.push($(this).attr('id'));
                });

                $.ajax({
                    type: 'get',
                    url: '{{ route('slider.create') }}',
                    data: {
                        slider_id_array: slider_id_array
                    },
                    success: function(res) {
                        $('#Loadsample').DataTable().ajax.reload();
                        Toastify({
                            text: "" + res.message + "",
                            duration: 3000,
                            close: true,
                            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        }).showToast();
                    }
                });
            }
        });
    </script>
@endsection
