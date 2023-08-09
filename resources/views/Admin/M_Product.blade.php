@extends('Layout_admin')
@section('title', 'Product')
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
                    <li class="nav-item dis_gal display" role="presentation">
                        <button class="nav-link galclick" id="gal-tab" data-bs-toggle="tab" data-bs-target="#gal"
                            type="button" role="tab" aria-controls="gal" aria-selected="false"></button>
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
                                        <th>Image</th>
                                        <th>Gallery</th>
                                        <th>Price</th>
                                        <th>Category</th>
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
                                    <div class="card-header">
                                        <h4 class="card-title">Add Product</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form" id="submit_form" action="post">
                                                <input type="hidden" id="hidden_cate_id">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="first-name-column">Name</label>
                                                            <input type="text" id="cate_name" name="pro_name"
                                                                class="form-control" placeholder="Name"
                                                                name="fname-column" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="last-name-column">Slug</label>
                                                            <input type="text" id="cate_slug" name="pro_slug"
                                                                class="form-control" placeholder="Slug Name"
                                                                name="lname-column" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="last-name-column">Price</label>
                                                            <input type="text"
                                                                data-parsley-pattern="^[1-9]\d{0,7}(?:\.\?:\,\d{1,4})?$"
                                                                data-parsley-trigger="keyup" id="pro_price" name="pro_price"
                                                                class="form-control" placeholder="Enter Price"
                                                                name="lname-column" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="last-name-column">Price Sale</label>
                                                            <input type="text" id="pro_price_sale" name="pro_price_sale"
                                                                class="form-control" placeholder="Enter Price Sale"
                                                                name="lname-column" value="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="last-name-column">Qty</label>
                                                            <input type="number"
                                                                data-parsley-pattern="^[1-9]\d{0,7}(?:\.\d{1,4})?$"
                                                                data-parsley-trigger="keyup" id="pro_qty" name="pro_qty"
                                                                class="form-control" placeholder="Enter Qty"
                                                                name="lname-column" required value="20">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="last-name-column">Desc</label>
                                                            <textarea class="form-control" id="pro_desc" name="pro_desc"
                                                                required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="last-name-column">Info</label>
                                                            <textarea class="form-control" id="pro_info" name="pro_info"
                                                                required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="last-name-column">Size</label>
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox" name="sizePro[]" id="idSize_XS" class="form-check-input pro_size" value="XS">
                                                                            <label for="checkbox1">XS</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox"name="sizePro[]" id="idSize_S" class="form-check-input pro_size" value="S">
                                                                            <label for="checkbox1">S</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox" name="sizePro[]" id="idSize_M" class="form-check-input pro_size" value="M">
                                                                            <label for="checkbox1">M</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox" name="sizePro[]" id="idSize_L" class="form-check-input pro_size" value="L">
                                                                            <label for="checkbox1">L</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox" name="sizePro[]" id="idSize_XL" class="form-check-input pro_size" value="XL">
                                                                            <label for="checkbox1">XL</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox" name="sizePro[]" id="idSize_2XL" class="form-check-input pro_size" value="2XL">
                                                                            <label for="checkbox1">2XL</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox" name="sizePro[]" id="idSize_3XL" class="form-check-input pro_size" value="3XL">
                                                                            <label for="checkbox1">3XL</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="last-name-column">Color</label>
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox" name="colorPro[]" id="idColor_Black" class="form-check-input pro_color" value="Black">
                                                                            <label for="checkbox1">Black</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox" name="colorPro[]" id="idColor_White" class="form-check-input pro_color" value="White">
                                                                            <label for="checkbox1">White</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox" name="colorPro[]" id="idColor_Red" class="form-check-input pro_color" value="Red">
                                                                            <label for="checkbox1">Red</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox" name="colorPro[]" id="idColor_Blue" class="form-check-input pro_color" value="Blue">
                                                                            <label for="checkbox1">Blue</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox" name="colorPro[]" id="idColor_Green" class="form-check-input pro_color" value="Green">
                                                                            <label for="checkbox1">Green</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="d-inline-block me-2 mb-1">
                                                                    <div class="form-check">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox" name="colorPro[]" id="idColor_Purple" class="form-check-input pro_color" value="Purple">
                                                                            <label for="checkbox1">Purple</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="country-floating">Category</label>
                                                            <div class="form-group">
                                                                <select class="choices form-select" id="pro_cate"
                                                                    name="pro_cate" required>
                                                                    @foreach ($category as $cate)
                                                                        <option value="{{ $cate->category_id }}">
                                                                            {{ $cate->category_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="country-floating">Status</label>
                                                            <div class="form-group">
                                                                <select class="choices form-select" id="pro_status"
                                                                    name="pro_status" required>
                                                                    <option value="1">Show</option>
                                                                    <option value="2">Hide</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-group">
                                                            <label for="country-floating">Image</label>
                                                            <input type="file" class="basic-filepond" id="pro_image"
                                                                name="pro_image" multiple required data-max-file-size="2MB"
                                                                data-max-files="1">
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
                    <div class="tab-pane fade" id="gal" role="tabpanel" aria-labelledby="gal-tab">
                        <div class="card-body">
                            <div class="col-12 d-flex justify-content-start mt-3 mb-2">
                                <input type="hidden" id="idhidden">
                                <button type="button" class="btn btn-primary me-1 mb-1 btn_gall">Add Gallery</button>
                                <button type="button" class="btn btn-danger me-1 mb-1 btn_gall_del_all">Delete All</button>
                                <!-- Vertically Centered modal Modal -->
                                <div class="modal fade" id="modal_gall" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add Gallery</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form id="submitgalll" method="post">
                                                <input type="hidden" id="hidden_gal_pro_id">
                                                <div class="modal-body">
                                                    <div class="col-md-12 col-12">
                                                        <input type="file" class="with-validation-filepond" id="gal_image"
                                                            name="gal_image" multiple required data-max-file-size="2MB"
                                                            data-max-files="5">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary ml-1 submit">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Submit</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadGal">

                                    </tbody>
                                </table>
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
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/choices.js/choices.min.css') }}" />
    <style>
        #parsley-id-29 {
            margin-top: 80px;
        }

        .click_gallery:hover {
            color: #000;
        }

        .display {
            display: none;
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

    {{-- <script src="//cdn.ckeditor.com/4.17.1/basic/ckeditor.js"></script> --}}
    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        function CKupdate() {
            for (instance in CKEDITOR.instance) {
                CKEDITOR.instances['pro_desc'].updateElement();
                CKEDITOR.instances['pro_info'].updateElement();
            }
        }
        CKEDITOR.config.autoParagraph = false;
        CKEDITOR.replace('pro_desc');
        CKEDITOR.replace('pro_info');
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
                acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg', 'image/webp'],
                fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                    // Do custom type detection here and return with promise
                    resolve(type);
                })
            });
        pond_2 = FilePond.create(document.querySelector('.with-validation-filepond'), {
            allowImagePreview: false,
            allowMultiple: true,
            allowFileEncode: false,
            required: true,
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg', 'image/webp'],
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
                url: "{{ route('product.index') }}",
            },
            columns: [{
                    data: 'product_name'
                },
                {
                    data: 'image',
                    orderable: false
                },
                {
                    data: 'gallery_td',
                    orderable: false
                },
                {
                    data: 'price_td',
                    orderable: false
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        return '<span class="badge bg-light-primary">' + data.category_name +
                            '</span>';
                    }
                },
                {
                    data: null,
                    render: function(data, type, full, meta) {
                        if (data.product_status == 1) {
                            $output =
                                '<div class="form-check form-switch">\
                                                                                <input class="form-check-input click_status" value="' +
                                data.product_id + '" type="checkbox" checked>\
                                                                            </div>';
                        } else {
                            $output =
                                '<div class="form-check form-switch">\
                                                                                <input class="form-check-input click_status" value="' +
                                data.product_id + '" type="checkbox">\
                                                                            </div>';
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
        // Change Slug
        $('#cate_name').keyup(function() {
            $.ajax({
                type: 'get',
                url: '{{ route('home-admin.index') }}',
                data: {
                    keyword: $('#cate_name').val()
                },
                dataType: 'json',
                success: function(data) {
                    $('#cate_slug').val(data);
                }
            });
        });
        // Reset Form
        $('.clicklist').click(function() {
            $('#hidden_action').val('Add');
            $('.card-title').text('Add Product');
            $('.editclick').text('Add')
            $('#submit_form')[0].reset();
            $('#submit_form').parsley().reset();
            CKupdate();
            $('.pro_size').attr('checked',false);
            $('.pro_color').attr('checked',false);
            $('#pro_desc').val('');
            $('#pro_info').text('');
            CKEDITOR.instances['pro_desc'].setData(pro_desc);
            CKEDITOR.instances['pro_info'].setData(pro_info);
        });
        // Add & Update
        $(document).on('submit', '#submit_form', function(e) {
            e.preventDefault();
            if ($('#submit_form').parsley().isValid()) {
                var action_url = '';
                var action_type = '';
                var size = [];
                var color = [];
                var pro_name = $('#cate_name').val();
                var pro_slug = $('#cate_slug').val();
                var pro_status = $('#pro_status').val();
                var pro_price = $('#pro_price').val();
                var pro_price_sale = $('#pro_price_sale').val();
                var pro_qty = $('#pro_qty').val();
                var pro_cate = $('#pro_cate').val();
                var pro_desc = $('#pro_desc').val();
                var pro_info = $('#pro_info').val();

                $('.pro_size').each(function(){
                    if($(this).is(":checked")){
                        size.push($(this).val());
                    }
                });
                $('.pro_color').each(function(){
                    if($(this).is(":checked")){
                        color.push($(this).val());
                    }
                });

                var data = new FormData(this);
                data.append('pro_name', pro_name);
                data.append('pro_slug', pro_slug);
                data.append('pro_status', pro_status);
                data.append('pro_price', pro_price);
                data.append('pro_price_sale', pro_price_sale);
                data.append('pro_qty', pro_qty);
                data.append('pro_cate', pro_cate);
                data.append('pro_desc', pro_desc);
                data.append('pro_info', pro_info);
                data.append('pro_size', size);
                data.append('pro_color', color);

                pondFiles = pond.getFiles();
                if (pondFiles.length > 0) {
                    data.append('pro_image', pondFiles[0].file);
                } else {
                    data.append('pro_image', '');
                }

                if ($('#hidden_action').val() == 'Add') {
                    action_url = '{{ route('product.store') }}';
                    data.append('_method', 'POST');
                } else {
                    var id = $('#hidden_cate_id').val();
                    action_url = 'product/' + id;
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
                            CKupdate();
                            $('#pro_desc').text('');
                            $('#pro_info').text('');
                            CKEDITOR.instances['pro_desc'].setData(pro_desc);
                            CKEDITOR.instances['pro_info'].setData(pro_info);
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
                                $('input[name="category_image"]').attr('required', true);
                            }
                        } else {
                            $.each(res.errors, function(key, err_values) {
                                Toastify({
                                    text: "" + err_values + "",
                                    duration: 3000,
                                    close: true,
                                    backgroundColor: "#B94A48",
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
                url: 'product/' + id,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 200) {
                        $('.card-title').text('Edit Product');
                        $('#hidden_action').val('Edit');
                        $('.editclick').text('Edit "' + res.data.product_name + '"');
                        $('#hidden_cate_id').val(id);
                        $('#cate_name').val(res.data.product_name);
                        $('#cate_slug').val(res.data.product_slug);
                        $('#pro_status').val(res.data.product_status);
                        $('#pro_price').val(res.data.product_price);
                        $('#pro_price_sale').val(res.data.product_price_sale);
                        $('#pro_qty').val(res.data.product_quantity);
                        $('#pro_cate').val(res.data.category_id);

                        $.each(res.size, function(key, values){
                            $('#idSize_'+values+'').val(values).attr('checked',true);
                        });
                        $.each(res.color, function(key, values){
                            $('#idColor_'+values+'').val(values).attr('checked',true);
                        });
                        CKupdate();
                        $('#pro_desc').text(res.data.product_desc);
                        $('#pro_info').text(res.data.product_info);
                        CKEDITOR.instances['pro_desc'].setData(pro_desc);
                        CKEDITOR.instances['pro_info'].setData(pro_info);

                        $('input[name="pro_image"]').attr('required', false);
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
                            url: 'product/' + id,
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
            var action = 'product';
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

        // Gallery
        $('.editclick, .clicklist').click(function() {
            var check = $(this).attr('id');
            if (check == 'home-tab') {
                $('.dis_gal').addClass('display');
                $('.clicklist').addClass('active show');
                $('.galclick').removeClass('active show');
                $('#home').addClass('active show');
                $('#gal').removeClass('active show');
            } else {
                $('.dis_gal').addClass('display');
                $('.editclick').addClass('active show');
                $('.galclick').removeClass('active show');
                $('#addproduct').addClass('active show');
                $('#gal').removeClass('active show');
            }
        });
        // Show Gallery
        $(document).on('click', '.click_gallery', function(e) {
            e.preventDefault();
            $('.clicklist').removeClass('active show');
            $('.galclick').addClass('active show');
            $('#home').removeClass('active show');
            $('#gal').addClass('active show');

            $('.dis_gal').removeClass('display');

            var action = $(this).attr('href');
            $.ajax({
                type: 'get',
                url: action,
                dataType: 'json',
                success: function(res) {
                    $('.galclick').text('Gallery "' + res.gall.product_name + '"');
                    $('#hidden_proid').val(res.gall.product_id);
                    $('#idhidden').val(res.gall.product_id);
                    $('.btn_gall').attr('data-gal_pro_id', res.gall.product_id);
                    $('.btn_gall_del_all').attr('data-gal_pro_id', res.gall.product_id);
                    $('#loadGal').html(res.data);
                }
            });
        });
        // Modal Add Gallery
        $('.btn_gall').click(function() {
            var id = $(this).data('gal_pro_id');
            $('#modal_gall').modal('show');
            $('#hidden_gal_pro_id').val(id);
            $('.submit').attr('disabled', false);
        });
        // Add Gallery
        $(document).on('submit', '#submitgalll', function(e) {
            e.preventDefault();
            var id = $('#idhidden').val();

            var data = new FormData(this);
            data.append('id', id);
            pondFiles_2 = pond_2.getFiles();
            for (var i = 0; i < pondFiles_2.length; i++) {
                data.append('file[]', pondFiles_2[i].file);
            }

            $.ajax({
                type: 'post',
                url: '{{ route('gallery.store') }}',
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
                    Toastify({
                        text: "" + res.message + "",
                        duration: 4000,
                        close: true,
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                    }).showToast();
                    $('#loadGal').html(res.data);
                    $('#Loadsample').DataTable().ajax.reload();
                    $('.filepond--action-remove-item').click();
                    $('.submit').attr('disabled', false);
                    setTimeout(function() {
                        $('#modal_gall').modal('hide');
                    }, 2000);
                }
            });
        });
        // Update Gallery
        $(document).on('change', '.file_image', function() {
            var up_id = $(this).data('gal_id');
            var image = document.getElementById('file-' + up_id).files[0];
            var data = new FormData();
            data.append("file", image);
            data.append("up_id", up_id);
            data.append('_method', 'PUT');

            $.ajax({
                type: 'post',
                url: 'gallery/' + up_id,
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function(res) {
                    Toastify({
                        text: "" + res.message + "",
                        duration: 4000,
                        close: true,
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                    }).showToast();
                    $('#loadGal').html(res.data);
                    $('#Loadsample').DataTable().ajax.reload();
                }

            });
        });
        // Delete Gallery
        $(document).on('click', '.deletegal', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var id_gall = $(this).data('id_gall');
            var action = 'One';

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
                            type: 'DELETE',
                            url: 'gallery/' + id,
                            data: {
                                id_gall: id_gall,
                                action: action
                            },
                            dataType: 'json',
                            success: function(res) {
                                if (res.status == 200) {
                                    swal("Poof! " + res.message + "", {
                                        icon: "success",
                                    });
                                    $('#loadGal').html(res.data);
                                    $('#Loadsample').DataTable().ajax.reload();
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
        // Delete Gallery All
        $(document).on('click', '.btn_gall_del_all', function(e) {
            e.preventDefault();
            var id = $('#idhidden').val();
            var action = 'All';

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
                            type: 'DELETE',
                            url: 'gallery/' + id,
                            data: {
                                action: action
                            },
                            dataType: 'json',
                            success: function(res) {
                                if (res.status == 200) {
                                    swal("Poof! " + res.message + "", {
                                        icon: "success",
                                    });
                                    $('#loadGal').html(res.data);
                                    $('#Loadsample').DataTable().ajax.reload();
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
        // Sorting Gallery
        $('#loadGal').sortable({
            palceholder: 'ui-state-highlight',
            update: function(event, ui) {
                var id_pro = $('#idhidden').val();
                var gall_id_array = new Array();
                $('#loadGal tr').each(function() {
                    gall_id_array.push($(this).attr('id'));
                });

                $.ajax({
                    type: 'get',
                    url: '{{ route('gallery.create') }}',
                    data: {
                        id_pro: id_pro,
                        gall_id_array: gall_id_array
                    },
                    success: function(res) {
                        $('#loadGal').html(res.data);
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
