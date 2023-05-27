@php 
    $categorys = App\Models\admin\Category::select('name','id')->get();
    $brands = App\Models\admin\Brand::select('name','id')->get();
@endphp
<style type="text/css">
    .selectactive {
            color: #b19361!important;
        }
</style>
<div class="col-lg-3">
                    <!-- Start Sidebar Area -->
                    <div class="siderbar-section" data-aos="fade-up"  data-aos-delay="0">
                        <!-- Start Single Sidebar Widget -->
                        <div class="sidebar-single-widget" >
                            <h6 class="sidebar-title"><a href="">DANH MỤC</a></h6>
                            <div class="sidebar-content">
                                <ul class="sidebar-menu">
                                 @foreach ($categorys as $category)
                                   <li><a href="{{request()->fullUrlWithQuery(['category' =>$category->id])}}" class="{{request('category')==$category->id?'nav-link selectactive':''}}">{{$category->name}}</a></li>   
                                 @endforeach  
                                </ul>
                            </div>
                        </div> <!-- End Single Sidebar Widget -->
                        <form action="{{route('user.allproduct')}}">
                        <!-- Start Single Sidebar Widget -->
                        <div class="sidebar-single-widget">
                            <h6 class="sidebar-title">Lọc theo giá</h6>
                            <div class="sidebar-content">
                                <div id="slider-range"></div>
                                <div class="filter-type-price">
                                    <label for="amount">Khoảng giá:</label>
                                    <input name="price" type="text" id="amount">
                                </div>
                                @if(!empty(request('category')))
                                    <input type="hidden" name="category"  value="{{request('category')}}">
                                @endif
                                @if(!empty(request('brand')))
                                    <input type="hidden" name="brand"  value="{{request('brand')}}">
                                @endif
                                @if(!empty(request('price')))
                                    <input type="hidden" name="sortby"  value="{{request('sortby')}}">
                                @endif
                                <button class="btn btn-sm btn-golden"><i class="fa-solid fa-filter"></i> Lọc giá</button>
                            </div>
                        </div> <!-- End Single Sidebar Widget -->
                        </form>
                        <div class="sidebar-single-widget" >
                            <h6 class="sidebar-title">Thương hiệu</h6>
                            <div class="sidebar-content">
                                <ul class="sidebar-menu">
                                @foreach ($brands as $brand) 
                                   <li><a href="{{ request()->fullUrlWithQuery(['brand' =>$brand->id]) }}" class="{{request('brand')==$brand->id?'nav-link selectactive':''}}">{{$brand->name}}</a></li>   
                                @endforeach    
                                </ul>
                            </div>
                        </div> <!-- End Single Sidebar Widget -->


                        <!-- Start Single Sidebar Widget -->
                        <div class="sidebar-single-widget">
                            <div class="sidebar-content">
                                <a href="product-details-default.html" class="sidebar-banner img-hover-zoom">
                                    <img class="img-fluid" src="assets/images/banner/side-banner.jpg" alt="">
                                </a>
                            </div>
                        </div> <!-- End Single Sidebar Widget -->

                    </div> <!-- End Sidebar Area -->
                </div>