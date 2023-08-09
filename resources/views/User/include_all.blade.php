
    <div class="row pb-3">
        <div class="col-12 pb-1">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                    <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                </div>
                <div class="ml-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                            data-toggle="dropdown">Sorting</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Latest</a>
                            <a class="dropdown-item" href="#">Popularity</a>
                            <a class="dropdown-item" href="#">Best Rating</a>
                        </div>
                    </div>
                    <div class="btn-group ml-2">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                            data-toggle="dropdown">Showing</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">10</a>
                            <a class="dropdown-item" href="#">20</a>
                            <a class="dropdown-item" href="#">30</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($sample as $sam)
            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100"
                            src="{{ asset('uploads/product/' . $sam->product_image) }}" alt="">
                        <div class="product-action">
                            <input type="hidden" id="hidden_qtypro{{ $sam->product_id }}" value="1">
                            <a class="btn btn-outline-dark btn-square clickAddCart" id="{{ $sam->product_id }}" href="#"><i
                                    class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square clickAddWish" data-id_proWish="{{ $sam->product_id }}" href="#"><i
                                    class="far fa-heart"></i></a>
                            <a class="btn btn-outline-dark btn-square"
                                href="{{ route('detail.show', $sam->product_slug) }}"><i
                                    class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate"
                            href="{{ route('detail.show', $sam->product_slug) }}">{{ Str::title($sam->product_name) }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            @if ($sam->product_price_sale != 0)
                                <h5>{{ number_format($sam->product_price_sale) }}</h5>
                                <h6 class="text-muted ml-2">
                                    <del>{{ number_format($sam->product_price) }}</del></h6>
                            @else
                                <h5>{{ number_format($sam->product_price) }}</h5>
                            @endif
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


        <div class="col-12">
            <nav>
                {!! $sample->render('User.pagination') !!}
            </nav>
        </div>
    </div>

