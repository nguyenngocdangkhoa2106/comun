@extends('Layout_admin')
@section('title','Dashboard')
@section('contect')
    <div class="page-heading">
        <h3>Profile Statistics</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Views</h6>
                                        <h6 class="font-extrabold mb-0">{{ number_format($total_view_product) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">User</h6>
                                        <h6 class="font-extrabold mb-0">{{ $kh_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Order</h6>
                                        <h6 class="font-extrabold mb-0">{{ $dh_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Product</h6>
                                        <h6 class="font-extrabold mb-0">{{ $sp_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Visit</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Top Views Product</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Desc</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($view_product as $view_pro)
                                            <tr>
                                                <td class="col-3"><a href="{{ route('detail.show',$view_pro->product_slug) }}">{{ $view_pro->product_name }}</a></td>
                                                <td class="col-auto">
                                                    <p class=" mb-0">{!! substr($view_pro->product_desc, 0, 100) !!}...</p>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-5">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="{{ asset('backend/assets/images/faces/1.jpg') }}" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                                <h6 class="text-muted mb-0" style="text-transform: lowercase;
                                word-spacing: -4px;">@<span>{{ Auth::user()->name }}</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="height: 42%">
                    <div class="card-header">
                        <h4>New User</h4>
                    </div>
                    <div class="card-content pb-4">
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="{{ asset('backend/assets/images/faces/4.jpg') }}">
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">Hank Schrader</h5>
                                <h6 class="text-muted mb-0">@johnducky</h6>
                            </div>
                        </div>
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="{{ asset('backend/assets/images/faces/5.jpg') }}">
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">Dean Winchester</h5>
                                <h6 class="text-muted mb-0">@imdean</h6>
                            </div>
                        </div>
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg">
                                <img src="{{ asset('backend/assets/images/faces/1.jpg') }}">
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">John Dodol</h5>
                                <h6 class="text-muted mb-0">@dodoljohn</h6>
                            </div>
                        </div>
                        <div class="px-4">
                            <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Start
                                Conversation</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Visitors Profile</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart_2"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <style>
        #chart_2 svg{
            margin-top: -15%;
        }
    </style>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection
@section('js')
    {{-- <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/assets/js/pages/dashboard.js') }}"></script> --}}

    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script>
        $(document).ready(function() {
            chart40daysorder()
            var chart = new Morris.Area({

                element: 'chart',
                parseTime: false,
                hideHover: 'auto',
                lineColors: ['rgb(79, 190, 135)', '#1ab394', '#1C84C6', '#e74a3b'],

                xkey: 'period',
                ykeys: ['order', 'sales', 'profit', 'quantity'],
                labels: ['Order', 'Sales', 'Profit', 'Quantity']
            });
            Morris.Donut({
                element: 'chart_2',
                resize: true,
                colors: ['#435ebe', '#4fbe87', '#eaca4a', '#56b6f7', '#ebeef3'],
                data: [{
                        label: "Products",
                        value: <?php echo $sp_count; ?>
                    },
                    {
                        label: "Order",
                        value: <?php echo $dh_count; ?>
                    },
                    {
                        label: "User",
                        value: <?php echo $kh_count; ?>
                    },
                    {
                        label: "Category",
                        value: <?php echo $dm_count; ?>
                    },
                    {
                        label: "Slider",
                        value: <?php echo $sl_count; ?>
                    }
                ]
            });

            function chart40daysorder() {

                $.ajax({
                    url: "{{ route('dashboard.store') }}",
                    method: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        chart.setData(data);
                    }
                });
            }
        });
    </script>
@endsection
