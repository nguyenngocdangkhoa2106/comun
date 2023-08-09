@extends('Layout_admin')
@section('title', 'Photo Gallery')
@section('contect')
    <div class="page-heading">
        @include('Admin.SampleTitle')
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Our Gallery</h5>
                        </div>
                        <div class="card-body">
                            <div class="row gallery">
                                @foreach ($photo as $pho)
                                <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2 mt-md-4">
                                    <a href="#">
                                        <img class="w-100" id="click_photo" data-id="{{ $pho->gallery_id }}"
                                            src="{{ asset('uploads/gallery/'.$pho->gallery_image) }}"
                                            data-bs-target="#Gallerycarousel">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryModalTitle">Our Gallery Example</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div id="Gallerycarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="3"
                                    aria-label="Slide 4"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active show_photo"></div>
                                @foreach ($photo as $key=> $pho)
                                <div class="carousel-item">
                                    <img class="d-block w-100"
                                        src="{{ asset('uploads/gallery/'.$pho->gallery_image) }}">
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#Gallerycarousel" role="button" type="button"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </a>
                            <a class="carousel-control-next" href="#Gallerycarousel" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </a>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).on('click','#click_photo',function(e){
            e.preventDefault();
            var id = $(this).data('id');

            $('#galleryModal').modal('show');
            $.ajax({
                type: 'get',
                url: '{{ route('gallery.index') }}',
                data: { id:id },
                success:function(res){
                    $('.show_photo').html(res.data);
                }
            });
        });
    </script>
@endsection
