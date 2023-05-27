@extends('User.layout.main')

@section('title')
Chotsport-giày bóng đá chính hãng
@endsection

@section('content')

<!-- Start Hero Slider Section-->
    <div class="hero-slider-section">
        <!-- Slider main container -->
        <div class="hero-slider-active swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Start Hero Single Slider Item -->
                @foreach($banner as $value)
                <div class="hero-single-slider-item swiper-slide">
                    <!-- Hero Slider Image -->
                    <div class="hero-slider-bg">
                        <img src="{{asset('user/assets/images/hero-slider/'.$value->image)}}" alt="">
                    </div>
                    <!-- Hero Slider Content -->
                    <div class="hero-slider-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="hero-slider-content">
                                        <h4 class="subtitle">Sản phẩm của</h4>
                                        <h2 class="title">Thương hiệu<br>{{$value->brand_name}}</h2>
                                        <a href="{{url('/product?brand='.$value->id)}}" class="btn btn-lg btn-outline-golden">Mua ngay</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Hero Single Slider Item -->
                @endforeach
            </div>

            <!-- If we need pagination -->
            <div class="swiper-pagination active-color-golden"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev d-none d-lg-block"></div>
            <div class="swiper-button-next d-none d-lg-block"></div>
        </div>
    </div> 
    <!-- End Hero Slider Section-->
 <!-- Start Service Section -->
    <div class="service-promo-section section-top-gap-100" style="margin-top: 30px;">
        <div class="service-wrapper">
            <div class="container">
                <div class="row">
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up"  data-aos-delay="0">
                           <div class="image">
                                <img src="{{asset('user/assets/images/icons/service-promo-1.png')}}" alt="">
                           </div>
                            <div class="content">
                                <h6 class="title">MIỄN PHÍ SHIP</h6>
                                <p>Miễn phí ship với tất cả đơn hàng, tự do mua sắm</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up"  data-aos-delay="200">
                           <div class="image">
                                <img src="{{asset('user/assets/images/icons/service-promo-2.png')}}" alt="">
                           </div>
                            <div class="content">
                                <h6 class="title">7 NGÀY ĐỔI TRẢ</h6>
                                <p>Miễn phí đổi trả trong vòng 7 ngày với sản phẩm không vừa size!</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up"  data-aos-delay="400">
                           <div class="image">
                                <img src="{{asset('user/assets/images/icons/service-promo-3.png')}}" alt="">
                           </div>
                            <div class="content">
                                <h6 class="title">THANH TOÁN AN TOÀN</h6>
                                <p>Thanh toán online an toàn tiện lợi.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up"  data-aos-delay="600">
                           <div class="image">
                                <img src="{{asset('user/assets/images/icons/service-promo-4.png')}}" alt="">
                           </div>
                            <div class="content">
                                <h6 class="title">CAM KẾT CHÍNH HÃNG</h6>
                                <p>Sản phẩm được cam kết chính hãng đánh đổi bằng sự uy tín của cửa hàng.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Service Section -->
<!-- Start Product Default Slider Section -->
    <div class="product-default-slider-section section-top-gap-100 section-fluid">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up"  data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                                <h3 class="section-title">SẢN PHẨM MỚI</h3>
                                <p>Chúng tôi luôn cố gắng nhập sản phẩm mới nhất</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Section Content Text Area -->
        <div class="product-wrapper" data-aos="fade-up"  data-aos-delay="200">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-slider-default-2rows default-slider-nav-arrow">
                            <!-- Slider main container -->
                            <div class="swiper-container product-default-slider-4grid-2row">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Start Product Default Single Item -->
                                    @foreach ($newProducts as $value)
                                    <div class="product-default-single-item product-color--golden swiper-slide" style="width:200px">
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
                                            </div>
                                            <div class="content-right col-12">
                                            	<ul class="review-star float-left">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                                <div class="price float-right">
                                                	@if($value->discount!= 0)
													    <del>{{number_format($value->price, 0, '.', ',')}}</del>
													@endif
													<span class="font-weight-bold">{{number_format($value->price*(100-$value->discount)/100, 0, '.', ',')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- End Product Default Single Item -->
                                </div>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
     <!-- End Product Default Slider Section -->


<!-- Start Product Default Slider Section -->
    <div class="product-default-slider-section section-top-gap-100 section-fluid section-inner-bg">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up"  data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                                <h3  class="section-title">SẢN PHẨM BÁN CHẠY</h3>
                                <p>Thêm vào giỏ hàng những sản phẩm bán chạy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Section Content Text Area -->
        <div class="product-wrapper" data-aos="fade-up"  data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-slider-default-1row default-slider-nav-arrow">
                            <!-- Slider main container -->
                            <div class="swiper-container product-default-slider-4grid-1row">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    @foreach ($bestseller as $value)
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="{{route('user.productdetail',['id'=>$value->id_product])}}" class="image-link">
                                                <img src="{{asset('/admin/assets/img/product/'.$value->id_product.'/'.json_decode($value['image'])[0])}}" alt="">
                                                <img src="{{asset('/admin/assets/img/product/'.$value->id_product.'/'.json_decode($value['image'])[1])}}" alt="">
                                            </a>
                                            @if($value->discount !=0)
                                            <div class="tag">
                                                <span>sale</span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="{{route('user.productdetail',['id'=>$value->id_product])}}">{{$value->name}}</a></h6>
                                            </div>
                                            <div class="content-right col-12">
                                            	<ul class="review-star float-left">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                                <div class="price float-right">
                                                	@if($value->discount!= 0)
													    <del>{{number_format($value->price, 0, '.', ',')}}</del>
													@endif
													<span class="font-weight-bold">{{number_format($value->price*(100-$value->discount)/100, 0, '.', ',')}}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                         
                                </div>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Product Default Slider Section -->

<!-- Start Banner Section -->
   <div class="banner-section">
        <div class="banner-wrapper clearfix">
            <!-- Start Banner Single Item -->
            <div class="banner-single-item banner-style-4 banner-animation banner-color--golden float-left img-responsive" data-aos="fade-up"  data-aos-delay="0">
                <div class="image">
                    <img class="img-fluid" src="{{asset('/user/assets/images/banner/anh7.jpg')}}" alt="">
                </div>
                <a href="{{url('/product?brand='.$nikeProducts[0]->id)}}" class="content">
                    <div class="inner">
                        <h4 style="color: #f29f1b" class="title">Nike x Cr7</h4>
                        <h6 style="color: #f29f1b" class="sub-title">{{!empty($nikeProducts)&&isset($nikeProducts[0])?$nikeProducts[0]->product_count : 0 }} Sản phẩm</h6>
                    </div>
                    <span class="round-btn"><i class="ion-ios-arrow-thin-right"></i></span>
                </a>
            </div> 
            <!-- End Banner Single Item -->
            <!-- Start Banner Single Item -->
            <div class="banner-single-item banner-style-4 banner-animation banner-color--golden float-left img-responsive" data-aos="fade-up"  data-aos-delay="200">
                <div class="image">
                    <img class="img-fluid" src="{{asset('/user/assets/images/banner/anh10.jpg')}}" alt="">
                </div>
                <a href="{{url('/product?brand='.$adidasProducts[0]->id)}}" class="content">
                    <div class="inner">
                        <h4 style="color: #f29f1b" class="title">Adidas x Messi</h4>
                        <h6 style="color: #f29f1b" class="sub-title">{{!empty($adidasProducts)&&isset($adidasProducts[0])?$adidasProducts[0]->product_count : 0 }} Sản phẩm</h6>
                    </div>
                    <span class="round-btn"><i class="ion-ios-arrow-thin-right"></i></span>
                </a>
            </div> 
            <!-- End Banner Single Item -->
            <!-- Start Banner Single Item -->
            <div class="banner-single-item banner-style-4 banner-animation banner-color--golden float-left img-responsive" data-aos="fade-up"  data-aos-delay="400">
                <div class="image">
                    <img class="img-fluid" src="{{asset('/user/assets/images/banner/anhney.jpg')}}" alt="">
                </div>
                <a href="{{url('/product?brand='.$pumaProducts[0]->id)}}" class="content">
                    <div class="inner">
                        <h4 style="color: #f29f1b" class="title">Puma x Neymar</h4>
                        <h6 style="color: #f29f1b" class="sub-title">{{!empty($pumaProducts)&&isset($pumaProducts[0])?$pumaProducts[0]->product_count : 0 }} Sản phẩm</h6>
                    </div>
                    <span class="round-btn"><i class="ion-ios-arrow-thin-right"></i></span>
                </a>
            </div> 
            <!-- End Banner Single Item -->
            <!-- Start Banner Single Item -->
            <div class="banner-single-item banner-style-4 banner-animation banner-color--golden float-left img-responsive" data-aos="fade-up"  data-aos-delay="600">
                <div class="image">
                    <img class="img-fluid" src="{{asset('/user/assets/images/banner/anh4.jpg')}}" alt="">
                </div>
                <a href="{{url('/product?brand='.$mizunoProducts[0]->id)}}" class="content">
                    <div class="inner">
                        <h4 style="color: #f29f1b" class="title">Mizuno x Ramos</h4>
                        <h6 style="color: #f29f1b" class="sub-title">{{!empty($mizunoProducts)&&isset($mizunoProducts[0])?$mizunoProducts[0]->product_count : 0 }} Sản phẩm</h6>
                    </div>
                    <span class="round-btn"><i class="ion-ios-arrow-thin-right"></i></span>
                </a>
            </div> 
            <!-- End Banner Single Item -->
        </div>
   </div>
   <!-- End Banner Section -->

<!-- Start Blog Slider Section -->
   <div class="blog-default-slider-section section-top-gap-100 section-fluid">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up"  data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                                <h3  class="section-title">Bài viết mới nhất</h3>
                                <p>Những tin tức về giày bóng đá phục vụ đam mê</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Section Content Text Area -->
        <div class="blog-wrapper" data-aos="fade-up"  data-aos-delay="200">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="blog-default-slider default-slider-nav-arrow">
                            <!-- Slider main container -->
                            <div class="swiper-container blog-slider">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Start Product Default Single Item -->
                                    @foreach($blog as $value)
                                    <div class="blog-default-single-item blog-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="{{route('user.blog_detail',['id'=>$value->id])}}" class="image-link">
                                                <img class="img-fluid" src="{{asset('/admin/assets/img/blog/'.$value->image)}}" alt="">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h6 style="min-height: 81px;" class="title"><a href="{{route('user.blog_detail',['id'=>$value->id])}}">{{$value->title}}</a></h6>
                                            <p>{{ \Illuminate\Support\Str::limit($value->description, 100, '...')}}</p>
                                            <div class="inner">
                                                <a href="{{route('user.blog_detail',['id'=>$value->id])}}" class="read-more-btn icon-space-left">Xem thêm<span><i class="ion-ios-arrow-thin-right"></i></span></a>
                                                <div class="post-meta">
                                                    <a href="#" class="date">{{$value->updated_at}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- End Product Default Single Item -->
                                </div>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div> 
   <!-- End Blog Slider Section -->
@endsection