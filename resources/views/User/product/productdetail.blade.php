@extends('User.layout.main')

@section('title')
Chotsport-{{$product->name}}
@endsection

@section('content')
<div class="breadcrumb-nav p-3 mb-2 text-dark" style="background-color:#e1e3e8!important;padding: 3px 20px!important; margin-bottom: 50px!important">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li class="active" aria-current="page"><a href="{{route('user.home')}}">Trang chủ</a></li>
                                    <li class="active" aria-current="page">{{$product->name}}</li>
                                </ul>
                            </nav>
</div>
<!-- Start Product Details Section -->
<div class="container">
</div>
    <div class="product-details-section" style="margin-top:30px">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="product-details-gallery-area" data-aos="fade-up"  data-aos-delay="0">
                        <!-- Start Large Image -->
                        <div class="product-large-image product-large-image-horaizontal swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach(json_decode($product->image) as $image)
                                    <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                        <img src="{{asset('/admin/assets/img/product/'.$product->id.'/'.$image)}}" alt="">
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                        <!-- End Large Image -->
                         <!-- Start Thumbnail Image -->
                        <div class="product-image-thumb product-image-thumb-horizontal swiper-container pos-relative mt-5">
                                <div class="swiper-wrapper">
                                    @foreach(json_decode($product->image) as $image)
                                    <div class="product-image-thumb-single swiper-slide">
                                        <img class="img-fluid" src="{{asset('/admin/assets/img/product/'.$product->id.'/'.$image)}}" alt="">
                                    </div>
                                    @endforeach
                            </div>
                            <!-- Add Arrows -->
                            <div class="gallery-thumb-arrow swiper-button-next"></div>
                            <div class="gallery-thumb-arrow swiper-button-prev"></div>
                        </div>
                         <!-- End Thumbnail Image -->
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="product-details-content-area product-details--golden" data-aos="fade-up"  data-aos-delay="200">
                        <!-- Start  Product Details Text Area-->
                        <div class="product-details-text">
                            <h4 class="title">{{$product->name}}</h4>
                            <div class="d-flex align-items-center">
                                <ul class="review-star">
                                @php
                                    $averageRating = App\Models\User\Rating::where('id_product', $product->id)->avg('star');
                                    $roundedRating = round($averageRating);
                                @endphp
                                    @for($i = 1; $i <= $roundedRating; $i++)
                                        <li class="fill"><i class="ion-android-star"></i></li>
                                    @endfor
                                    
                                </ul>
                            </div>
                            @if($product->discount!= 0)
                                <del>{{number_format($product->price, 0, '.', ',')}}</del>
                            @endif
                            <div class="price">
                                <h2 class="font-weight-bold" style="color: red">{{number_format($product->price*(100-$product->discount)/100, 0, '.', ',')}}</h2>
                            </div>
                            <!-- Product Variable Single Item -->
                            <div class="variable-single-item">
                                @if($product->total_qty>0)
                                <div class="product-stock"> <span class="product-stock-in"><i class="ion-checkmark-circled"></i></span> {{$product->total_qty}} Sẵn có</div>
                                @else
                                <div class="product-stock"> <span class="product-stock-in"><i style="color:red" class="fa-sharp fa-solid fa-circle-xmark"></i></span> Tạm hết hàng</div>
                                @endif
                            </div>
                        </div> <!-- End  Product Details Text Area-->
                        <!-- Start Product Variable Area -->
                        @if($product->total_qty>0)
                        <div class="product-details-variable">
                            <h4 class="title">TUỲ CHỌN SIZE</h4>
                            <!-- Product Variable Single Item -->
                            <div class="variable-single-item">
                                <span>Kích thước</span>
                                <div class="product-variable-color">
                                    <label >
                                        @foreach($listsize as $value)
                                        <!-- start per size -->
                                        <input type="radio" class="btn-check" name="options" id="{{$value->id}}" autocomplete="off">
                                        <label style="line-height:1" class="btn btn-warning" for="{{$value->id}}">{{$value->size}}</label>
                                        <!-- end per size -->
                                        @endforeach
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center actioncart">
                                <div class="variable-single-item ">
                                    <span>Số lượng</span>
                                    <div class="product-variable-quantity">
                                        <input min="1" max="100" value="1" type="number">
                                    </div>
                                </div>
                                <div class="product-add-to-cart-btn" style="margin-right: 20px">
                                    <a href="#" id="gotocheckout" data-bs-toggle="modal" data-target="#exampleModal">Mua ngay</a>
                                </div>
                                <div class="product-add-to-cart-btn">
                                    <a href="javascript:void(0)" id="addtocart" data-bs-target="#modalAddcart">+ Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div> <!-- End Product Variable Area -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Details Section -->
<!-- Start Product Content Tab Section -->
    <div class="product-details-content-tab-section section-top-gap-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-details-content-tab-wrapper" data-aos="fade-up"  data-aos-delay="0">

                        <!-- Start Product Details Tab Button -->
                        <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                            <li><a class="nav-link active" data-bs-toggle="tab" href="#description">
                                    Mô tả
                                </a></li>
                            <li><a class="nav-link" data-bs-toggle="tab" href="#specification">
                                    Thông tin
                                </a></li>
                            <li><a class="nav-link" data-bs-toggle="tab" href="#review">
                                    Đánh giá
                                </a></li>
                        </ul> <!-- End Product Details Tab Button -->

                        <!-- Start Product Details Tab Content -->
                        <div class="product-details-content-tab">
                            <div class="tab-content">
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane active show" id="description" style="overflow: hidden;">
                                    <div class="single-tab-content-item">
                                        <p>{!!$product->description!!}</p>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane" id="specification">
                                    <div class="single-tab-content-item">
                                        <table class="table table-bordered mb-20">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Phân loại</th>
                                                    <td>Giày cỏ nhân tạp</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Thương hiệu</th>
                                                    <td>Nike</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                                <!-- Start Product Details Tab Content Singel -->
                                <div class="tab-pane" id="review">
                                    <div class="single-tab-content-item">
                                        <!-- Start - Review Comment -->
                                        <ul class="comment">
                                            <!-- Start - Review Comment list-->
                                            @foreach($feedback as $value)
                                            <li class="comment-list">
                                                <div class="comment-wrapper">
                                                    <div class="comment-img">
                                                        @if($value->user_avatar)
                                                        <img src="{{asset('/user/assets/images/user/'.$value->user_avatar)}}" alt="">
                                                        @else
                                                        <img src="{{asset('/user/assets/images/user/userdefault.webp')}}" alt="">
                                                        @endif
                                                    </div>
                                                    <div class="comment-content">
                                                        <div class="comment-content-top">
                                                            <div class="comment-content-left">
                                                                <h6 class="comment-name">{{$value->user_name}}</h6>
                                                                <ul class="review-star">
                                                                    @for($i = 1; $i <= $value->star; $i++)
                                                                        <li class="fill"><i class="ion-android-star"></i></li>
                                                                    @endfor
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="para-content">
                                                            <p>
                                                        {{ App\Models\User\Comment::where('id_product', $value->id)
                                                               ->where('id_order', $value->id_order)
                                                               ->where('id_user', $value->id_user)
                                                               ->value('message') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> <!-- End - Review Comment list-->
                                            @endforeach
                                            <!-- Start - Review Comment list-->
                                        </ul> <!-- End - Review Comment -->
                                            <hr>
                                            <h5 class="text-danger">Chỉ những người đã mua hàng mới được đánh giá sản phẩm này (*)</h5>
                                    
                                    </div>
                                </div> <!-- End Product Details Tab Content Singel -->
                            </div>
                        </div> <!-- End Product Details Tab Content -->

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Content Tab Section -->
 <!-- Start Product Default Slider Section -->
    <div class="product-default-slider-section section-top-gap-100 section-fluid">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up"  data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content">
                                <h3  class="section-title">RELATED PRODUCTS</h3>
                                <p>Browse the collection of our related products.</p>
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
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="assets/images/product/default/home-1/default-9.jpg" alt="">
                                                <img src="assets/images/product/default/home-1/default-10.jpg" alt="">
                                            </a>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Epicuri per lobortis</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$68</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="assets/images/product/default/home-1/default-11.jpg" alt="">
                                                <img src="assets/images/product/default/home-1/default-3.jpg" alt="">
                                            </a>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Kaoreet lobortis sagit</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$95.00</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="assets/images/product/default/home-1/default-5.jpg" alt="">
                                                <img src="assets/images/product/default/home-1/default-7.jpg" alt="">
                                            </a>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Condimentum posuere</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$115.00</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="assets/images/product/default/home-1/default-6.jpg" alt="">
                                                <img src="assets/images/product/default/home-1/default-9.jpg" alt="">
                                            </a>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Convallis quam sit</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$75.00 - $85.00</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="assets/images/product/default/home-1/default-1.jpg" alt="">
                                                <img src="assets/images/product/default/home-1/default-2.jpg" alt="">
                                            </a>
                                            <div class="tag">
                                                <span>sale</span>
                                            </div>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Aliquam lobortis</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$75.00 - $85.00</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="assets/images/product/default/home-1/default-3.jpg" alt="">
                                                <img src="assets/images/product/default/home-1/default-4.jpg" alt="">
                                            </a>
                                            <div class="tag">
                                                <span>sale</span>
                                            </div>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Condimentum posuere</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price"><del>$89.00</del> $80.00</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="assets/images/product/default/home-1/default-5.jpg" alt="">
                                                <img src="assets/images/product/default/home-1/default-6.jpg" alt="">
                                            </a>
                                            <div class="tag">
                                                <span>sale</span>
                                            </div>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Cras neque metus</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price"><del>$70.00</del> $60.00</span>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Product Default Single Item -->
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.html" class="image-link">
                                                <img src="assets/images/product/default/home-1/default-7.jpg" alt="">
                                                <img src="assets/images/product/default/home-1/default-8.jpg" alt="">
                                            </a>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                                    <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                    <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.html">Donec eu libero ac</a></h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$74</span>
                                            </div>

                                        </div>
                                    </div> <!-- End Product Default Single Item -->
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
<!-- modal check login trước khi thanh toán
 -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 76px!important;min-width: 461px!important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bạn cần đăng nhập trước khi thanh toán
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <a href="{{route('user.login')}}" class="btn btn-warning">Đăng nhập</a>
        
      </div>
    </div>
  </div>
</div>




<!-- Jquery -->
<script type="text/javascript">
   $(document).ready(function() { 
        $('#addtocart').click(function(){ //bắt buộc chọn size
            if($('.btn-check').is(':checked') ){
                var Id_product =  "{{$product->id}}";
                var Price = "{{$product->price*(100-$product->discount)/100}}";
                var formatPrice = "{{number_format($product->price*(100-$product->discount)/100, 0, '.', ',')}}";
                var Name_product = "{{$product->name}}"
                var Imgsrc = $('.product-image-large-image').find('img').first().attr('src');
                var Qty =  $('#addtocart').closest('.actioncart').find('.product-variable-quantity').find('input').val();
                var Product_detail = $('.btn-check:checked').attr('id');
                var Sizename = $('.btn-check:checked').next('label').text();
               
                $.ajax({
                url: '{{route('user.addcart')}}', 
                method: 'POST', // phương thức POST
                dataType: 'json',
                data: { // dữ liệu gửi đi
                    id_product: Id_product, // giá trị id_product
                    price: Price, // giá trị giá mỗi mặt hàng (sau cùng)
                    name_product: Name_product, // giá trị tên product
                    imgsrc: Imgsrc, // giá trị đường dẫn ảnh
                    qty: Qty, // giá trị số lượng sản phẩm
                    product_detail: Product_detail,
                    sizename: Sizename,
                    _token: '{{ csrf_token() }}' // token để bảo svệ form
                },
                success: function(data){ // nhận kết quả trả về
                    $('span.item-count').text(data.count);
                    $('#modalAddcart').find('.modal-add-cart-info').html("<i class='fa fa-check-square'></i>"+data.success);
                    $('#modalAddcart').find('.imagecart').find('img').attr('src',Imgsrc);
                
                    $('#modalAddcart').find('ul.modal-add-cart-product-shipping-info').html(
                        "<li> <strong>"+Name_product+"</strong></li>"+
                        "<li> <strong>Kích thước:</strong><span>"+Sizename+"</span></li>"+
                        "<li> <strong>Số lượng:</strong> <span>"+Qty+"</span></li>"+
                        "<li><strong>Đơn giá: </strong><strong style='color:red!important'>"+ formatPrice+"</strong></li>" 
                        );
                 }
                });  // dấu đóng AJAX               
                $('#modalAddcart').modal("show");
                }
                else{
                    alert("Vui lòng chọn kích thước giày");  
                }
        });

        $('#gotocheckout').click(function(){ //bắt buộc chọn size
            var checklogin = "{{Auth::check()}}";
            if($('.btn-check').is(':checked') ){
                //kiểm tra đăng nhập
                if(!checklogin){
                    $('#exampleModal').modal("show")
                    return false;
                }
                // 
                var Id_product =  "{{$product->id}}";
                var Price = "{{$product->price*(100-$product->discount)/100}}";
                var formatPrice = "{{number_format($product->price*(100-$product->discount)/100, 0, '.', ',')}}";
                var Name_product = "{{$product->name}}"
                var Imgsrc = $('.product-image-large-image').find('img').first().attr('src');
                var Qty =  $('#gotocheckout').closest('.actioncart').find('.product-variable-quantity').find('input').val();
                var Product_detail = $('.btn-check:checked').attr('id');
                var Sizename = $('.btn-check:checked').next('label').text();
              
                $.ajax({
                url: '{{route('user.addcart')}}', 
                method: 'POST', // phương thức POST
                dataType: 'json',
                data: { // dữ liệu gửi đi
                    id_product: Id_product, // giá trị id_product
                    price: Price, // giá trị giá mỗi mặt hàng (sau cùng)
                    name_product: Name_product, // giá trị tên product
                    imgsrc: Imgsrc, // giá trị đường dẫn ảnh
                    qty: Qty, // giá trị số lượng sản phẩm
                    product_detail: Product_detail,
                    sizename: Sizename,
                    _token: '{{ csrf_token() }}' // token để bảo svệ form
                },
                success: function(data){ // nhận kết quả trả về
                    window.location.href = "{{route('user.checkout')}}";
                 }
                });  // dấu đóng AJAX                  
            }
            else{
                alert("Vui lòng chọn kích thước giày");  
            }
        });
    }); //dấu đóng hàm ready
</script>




@endsection