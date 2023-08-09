<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.css') }}">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/app.css') }}">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('dashboard.index') }}"><i class="fab fa-d-and-d"></i> Admin</a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                @php
                    $url_now = Request::url();
                @endphp
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item {{ $url_now == route('dashboard.index') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.index') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ $url_now == route('category.index') ? 'active' : '' }}">
                            <a href="{{ route('category.index') }}" class='sidebar-link'>
                                <i class="fas fa-certificate"></i>
                                <span>Category</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ $url_now == route('product.index') ? 'active' : '' }}">
                            <a href="{{ route('product.index') }}" class='sidebar-link'>
                                <i class="fab fa-product-hunt"></i>
                                <span>Product</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ $url_now == route('order.index') ? 'active' : '' }}">
                            <a href="{{ route('order.index') }}" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Order</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ $url_now == route('coupon.index') ? 'active' : '' }}">
                            <a href="{{ route('coupon.index') }}" class='sidebar-link'>
                                <i class="fab fa-salesforce"></i>
                                <span>Coupon</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ $url_now == route('account.index') ? 'active' : '' }}">
                            <a href="{{ route('account.index') }}" class='sidebar-link'>
                                <i class="fas fa-users-cog"></i>
                                <span>Account</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ $url_now == route('slider.index') ? 'active' : '' }}">
                            <a href="{{ route('slider.index') }}" class='sidebar-link'>
                                <i class="fab fa-slideshare"></i>
                                <span>Slider</span>
                            </a>
                        </li>
                        <li class="sidebar-title">Pages</li>
                        <li class="sidebar-item {{ $url_now == route('gallery.index') ? 'active' : '' }}">
                            <a href="{{ route('gallery.index') }}" class='sidebar-link'>
                                <i class="bi bi-image-fill"></i>
                                <span>Photo Gallery</span>
                            </a>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a href="" class='sidebar-link'>
                                <i class="fas fa-cog"></i>
                                <span>Settings</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="">Profile</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{ route('sign.create') }}">Log Out</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>


            @yield('contect')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>{{ now()->format('Y') }} &copy; All Rights Reserved.
                            This website is completed by <span class="text-danger"><i class="bi bi-heart"></i></span><a
                            target="_blank" href="https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&to=namnguyen.02.08.99@gmail.com&su=Help&body=Hi%20Guy,%0AI%20need%20your%20help"> Pi Pj</a></p>
                    </div>
                </div>
            </footer>
        </div>
        <input type="hidden" id="csrf-token" name="csrf-token" value="{{ csrf_token() }}">
    </div>
    <script src="{{ asset('backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/mazer.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/fontawesome/all.min.js') }}"></script>
    <script>
        $(document).ready(function (){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf-token"]').val()
                },
            });
        });
    </script>
    @yield('js')


</body>

</html>
