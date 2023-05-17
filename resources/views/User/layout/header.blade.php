<!-- Start Header Area -->
@php 
    $categorys = App\Models\admin\Category::select('name','id')->get();
    $brands = App\Models\admin\Brand::select('name','id')->get();
@endphp
    <header class="header-section d-none d-xl-block">
        <div class="header-wrapper">
            <div class="header-bottom header-bottom-color--golden section-fluid sticky-header sticky-color--golden">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                             <!-- Start Header Logo -->
                            <div class="header-logo col-2">
                                <div class="logo">
                                    <a href="index.html"><img src="{{asset('user/assets/images/logo/logo_chot.png')}}" alt="" style="width: 200%;"></a>
                                </div>
                            </div>
                            <!-- End Header Logo -->
                            
                            <!-- Start Header Main Menu -->
                           
                            <!-- End Header Main Menu Start -->
                            <div class="col-5">
                                <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                            </div>
                            <!-- Start Header Action Link -->
                            <ul class="header-action-link action-color--black action-hover-color--golden col-5-auto">
                                <li style="margin-right: 20px;">
                                    <a href="#search">
                                        <button   type="button" class="btn btn-warning btn-sm">Tư vấn size <i class="fa-solid fa-shoe-prints" style="color: #c8ab19;"></i></button>
                                    </a>
                                </li>
                                <li>
                                    <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                        <i class="icon-bag"></i>
                                        <span class="item-count">3</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="offside-about" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa-regular fa-user" style="color: #000000; font-size: 18px;"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" >
                                        <a class="dropdown-item" style="letter-spacing: -1px; font-size: 20px;" href="#">Đăng nhập</a>
                                        <a class="dropdown-item" style="letter-spacing: -1px;font-size: 20px;"  href="#">Xem đơn hàng</a>
                                        <a class="dropdown-item" style="letter-spacing: -1px;font-size: 20px;" href="#">Profile</a>
                                      </div>
                                      </div>
                                </li>
                            </ul>
                            <!-- End Header Action Link -->
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="main-menu menu-color--black menu-hover-color--golden col-12" >
                            <nav>
                                <ul>
                                    <li class="has-dropdown">
                                        <a class="active main-menu-link" href="index.html">Trang chủ</a>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="blog-single-sidebar-left.html">Giày bóng đá <i class="fa fa-angle-down"></i></a>
                                        <!-- Sub Menu -->
                                        <ul class="sub-menu">
                                            @foreach ($categorys as $category)
                                            <li><a href="">{{$category->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="blog-single-sidebar-left.html">Thương hiệu<i class="fa fa-angle-down"></i></a>
                                        <!-- Sub Menu -->
                                        <ul class="sub-menu">
                                            @foreach ($brands as $brand)
                                            <li><a href="">{{$brand->name}}</a></li>
                                            @endforeach 
                                        </ul>
                                    </li>
                                    <li class="has-dropdown">
                                        <a id="blog" href="#">Bài viết</a>
                                    </li>
                                    <li>
                                        <a href="">Về chúng tôi</a>
                                    </li>
                                    <li>
                                        <a href="">Liên hệ</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </header>
    <!-- Start Header Area -->