@extends('User.layout.main')

@section('title')
Chotsport - Tất cả sản phẩm
@endsection

@section('content')
<div class="breadcrumb-nav p-3 mb-2 text-dark" style="background-color:#e1e3e8!important;padding: 3px 20px!important; margin-bottom: 50px!important">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li class="active" aria-current="page"><a href="{{route('user.home')}}">Trang chủ</a></li>
                                    <li class="active" aria-current="page"><a href="{{url('/product')}}">Tìm kiếm</a></li>
                                </ul>
                            </nav>
</div>
<!-- ...:::: Start Shop Section:::... -->
    <div class="shop-section">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                    <!-- Start Shop Product Sorting Section -->

                    <!-- Start Tab Wrapper -->
                    <div class="sort-product-tab-wrapper">
                        <div class="container">
                            <h2>Kết quả tìm kiếm cho: "{{request('inputsearch')}}"</h2>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content tab-animate-zoom">
                                        <!-- Start Grid View Product -->
                                        <div class="tab-pane active show sort-layout-single" id="layout-3-grid">
                                         @if($product->count()!=0)
                                            <div class="row">
                                        
                                            @foreach($product as $value)
                                                <div class="col-xl-3 col-sm-6 col-12">
                                                    <!-- Start Product Default Single Item -->
                                                    <div class="product-default-single-item product-color--golden" data-aos="fade-up"  data-aos-delay="0">
                                                        <div class="image-box">
                                                            <a href="{{route('user.productdetail',['id'=>$value->id])}}" class="image-link">
                                                                <img src="{{asset('/admin/assets/img/product/'.$value->id.'/'.json_decode($value->image)[0])}}" alt="">
                                                                <img src="{{asset('/admin/assets/img/product/'.$value->id.'/'.json_decode($value->image)[1])}}" alt="">
                                                            </a>
                                                            @if($value->discount !=0)
				                                            <div class="tag">
				                                                <span>sale</span>
				                                            </div>
				                                            @endif
                                                        </div>
                                                        <div class="content">
                                                            <div class="content-left">
                                                                <h6 class="title"><a href="{{route('user.productdetail',['id'=>$value->id])}}">{{$value->name}}</a></h6>
                                                                <ul class="review-star">
                                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="content-right">
		                                                        @if($value->discount!= 0)
															    <del>{{number_format($value->price, 0, '.', ',')}}</del>
																@endif
																<span class="font-weight-bold">{{number_format($value->price*(100-$value->discount)/100, 0, '.', ',')}}</span>
                                                            </div>
                
                                                        </div>
                                                    </div>
                                                    <!-- End Product Default Single Item -->
                                                </div>
                                            @endforeach 
                                            </div>
                                        @else
                                        <div class="product-default-single-item product-color--golden col-10 mx-auto" data-aos="fade-up"  data-aos-delay="0">
                                       	<h2>KHÔNG CÓ SẢN PHẨM NÀO PHÙ HỢP!!!</h2> 
                                       </div>
                                        @endif
                                        </div> <!-- End Grid View Product -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Tab Wrapper -->

                    <!-- Start Pagination -->
                    <div class="" data-aos="fade-up"  data-aos-delay="0">
                      {{$product->links('pagination::bootstrap-4')}}
                    </div> <!-- End Pagination -->
            
        </div>
    </div> <!-- ...:::: End Shop Section:::... -->





<!-- jquery -->
@endsection
