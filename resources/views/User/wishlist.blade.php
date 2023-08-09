@extends('Layout_user')
@section('content')
    @include('User.sample')


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Remove</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Add To Cart</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="loadShowwish">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('js')
    <script>
        function LoadData() {
            $.ajax({
                type: 'get',
                url: '{{ route('wishlist.create') }}',
                dataType: 'json',
                success: function(res) {
                    $('#loadShowwish').html(res.data);
                }
            });
        }

        $(document).ready(function() {
            LoadData();

            $(document).on('click','.removewish',function(e){
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    type: 'delete',
                    url: 'wishlist/'+id,
                    success:function(res){
                        if(res.status == 200){
                            LoadData();
                        }else{
                            LoadData();
                            alert(res.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
