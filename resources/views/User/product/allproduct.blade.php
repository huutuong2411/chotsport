@extends('User.layout.main')

@section('title')
Chotsport - Tất cả sản phẩm
@endsection

@section('content')
<!-- ...:::: Start Shop Section:::... -->
    <div class="shop-section">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                @include('User.layout.left-sidebar')
                <div class="col-lg-9">
                    <!-- Start Shop Product Sorting Section -->
                    <div class="shop-sort-section">
                        <div class="container">
                            <div class="row">
                                <!-- Start Sort Wrapper Box -->
                                <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column" data-aos="fade-up"  data-aos-delay="0">
                                    <!-- Start Sort tab Button -->
                                    <div class="sort-tablist d-flex align-items-center">
                                        <ul class="tablist nav sort-tab-btn">
                                            <li><a class="nav-link active" data-bs-toggle="tab" href=""><img src="{{asset('/user/assets/images/icons/bkg_grid.png')}}" alt=""></a></li>
                                        </ul>

                                       
                                    </div> <!-- End Sort tab Button -->

                                    <!-- Start Sort Select Option -->
                                    <div class="sort-select-list d-flex align-items-center">
                                        <label class="mr-2">Sắp xếp theo:</label>
                                        <form action="{{route('user.allproduct')}}" method="get">
                                            <fieldset>
                                                <select class="form-select" name="sortby" id="speed" onchange="this.form.submit()">
                                                	<option {{request('sortby')=='newest'?'selected':''}} value="newest">Mới nhất</option>
                                                    <option {{request('sortby')=='bestseller'?'selected':''}}  value="bestseller">Bán chạy</option>
                                                    <option {{request('sortby')=='oldest'?'selected':''}} value="oldest">Cũ nhất</option>
                                                    <option {{request('sortby')=='price-ascending'?'selected':''}} value="price-ascending">Giá tăng dần</option>
                                                    <option {{request('sortby')=='price-descending'?'selected':''}} value="price-descending">Giá giảm dần</option>
                                                    <option {{request('sortby')=='sale'?'selected':''}} value="sale">Đang Giảm giá</option>
                                                    <option {{request('sortby')=='best-rating'?'selected':''}} value="best-rating">Đánh giá tốt</option>
                                                    @if(!empty(request('category')))
                                                    <input type="hidden" name="category"  value="{{request('category')}}">
                                                    @endif
                                                    @if(!empty(request('brand')))
                                                    <input type="hidden" name="brand"  value="{{request('brand')}}">
                                                    @endif
                                                    @if(!empty(request('price')))
                                                    <input type="hidden" name="price"  value="{{request('price')}}">
                                                    @endif
                                                </select>
                                            </fieldset>
                                        </form>
                                    </div> <!-- End Sort Select Option -->

                                    

                                </div> <!-- Start Sort Wrapper Box -->
                            </div>
                        </div>
                    </div> <!-- End Section Content -->

                    <!-- Start Tab Wrapper -->
                    <div class="sort-product-tab-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content tab-animate-zoom">
                                        <!-- Start Grid View Product -->
                                        <div class="tab-pane active show sort-layout-single" id="layout-3-grid">
                                         @if($allproduct->total()!=0)
                                            <div class="row">
                                        
                                            @foreach($allproduct as $value)
                                                <div class="col-xl-4 col-sm-6 col-12">
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
                      {{$allproduct->links('pagination::bootstrap-4')}}
                    </div> <!-- End Pagination -->
            </div>
        </div>
    </div> <!-- ...:::: End Shop Section:::... -->





<!-- jquery -->
<script type="text/javascript">
    $(document).ready(function() {
        $('select').niceSelect('destroy');  

     	var priceURL = "{{request('price')}}";
        var priceValues = [{{$minprice}}, {{$maxprice}}];

        if (priceURL) {
            var priceRange = priceURL.split(" - ");
            if (priceRange.length === 2) {
                priceValues[0] = parseInt(priceRange[0].replace(/[^0-9]/g, ''));
                priceValues[1] = parseInt(priceRange[1].replace(/[^0-9]/g, ''));
            }
        }
     $("#slider-range").slider({
            range: true,
            min: {{$minprice}},
            max: {{$maxprice}},
            values: priceValues,
            step: 100000,
            slide: function(event, ui) {
                $("#amount").val(ui.values[0].toLocaleString('en-US') + "đ - " + ui.values[1].toLocaleString('en-US') + "đ");
            }
        });
	    $("#amount").val($("#slider-range").slider("values", 0).toLocaleString('en-US') +
	        "đ - " + $("#slider-range").slider("values", 1).toLocaleString('en-US')+'đ');
	});
</script>
@endsection
