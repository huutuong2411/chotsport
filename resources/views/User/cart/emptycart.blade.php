@extends('User.layout.main')

@section('title')
Chotsport - Giỏ hàng của bạn
@endsection

@section('content')
    <!-- ...::::Start About Us Center Section:::... -->
    <div class="empty-cart-section section-fluid" style="margin-top: 50px">
        <div class="emptycart-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 offset-md-1 col-xl-6 offset-xl-3">
                        <div class="emptycart-content text-center">
                            <div class="image">
                                <img class="img-fluid" src="{{asset('user/assets/images/emprt-cart/empty-cart.png')}}" alt="">
                            </div>
                            <h4 class="title">Giỏ hàng của bạn đang trống</h4>
                            <h6 class="sub-title">Bạn chưa thêm sản phẩm nào vào giỏ hàng</h6>
                            <a href="{{route('user.home')}}" class="btn btn-lg btn-golden">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...::::End  About Us Center Section:::... -->
        
@endsection
               