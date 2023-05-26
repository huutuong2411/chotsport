<!-- Start Header Area -->
@php 
    $categorys = App\Models\admin\Category::select('name','id')->get();
    $brands = App\Models\admin\Brand::select('name','id')->get();
@endphp
    <header class="header-section d-none d-xl-block">
        <div class="header-wrapper">
            <div class="header-bottom header-bottom-color--golden section-fluid  sticky-color--golden">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                             <!-- Start Header Logo -->
                            <div class="header-logo col-2">
                                <div class="logo">
                                    <a href="{{route('user.home')}}"><img src="{{asset('user/assets/images/logo/logo_chot.png')}}" alt="" style="width: 200%;"></a>
                                </div>
                            </div>
                            <!-- End Header Logo -->
                            
                            <!-- Start Header Main Menu -->
                           
                            <!-- End Header Main Menu Start -->
                            <div class="col-5 search_form">
                                <input class="form-control mr-sm-2" id="inputsearch" type="search" placeholder="Tìm kiếm..." aria-label="Search" style="position: relative">
                                <!-- Start Offcanvas Addcart Section -->
                            </div>
                            <!-- Start Header Action Link -->
                            <ul class="header-action-link action-color--black action-hover-color--golden col-5-auto">
                                <li style="margin-right: 20px;">
                                    <a href="#search">
                                        <button type="button" class="btn btn-warning btn-sm">Tư vấn size <i class="fa-solid fa-shoe-prints" style="color: #c8ab19;"></i></button>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('user.cart')}}" >
                                        <i class="icon-bag"></i>
                                        <span class="item-count">{{session()->has('cart')?array_sum(array_column(session()->get('cart'), 'cartQty')): 0}}</span>
                                        
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button style="padding: 0px" class="offside-about" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            @if(Auth::check())
                                            @php $avatar= Illuminate\Support\Facades\Auth::user()->avatar; @endphp
                                                @if($avatar)
                                            <img style="width:85%;height:85%" class="rounded-circle" src="{{asset('/user/assets/images/user/'.$avatar)}}">  
                                                @else
                                            <i class="fa-regular fa-user" style="color: #000000; font-size: 18px;"></i>    
                                                @endif
                                            @else
                                            <i class="fa-regular fa-user" style="color: #000000; font-size: 18px;"></i>
                                            @endif
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" >
                                            @if(Auth::check())
                                        <a class="dropdown-item" style="letter-spacing: -1px;font-size: 20px;" href="{{route('user.profile')}}">Trang cá nhân</a>
                                        <a class="dropdown-item" style="letter-spacing: -1px;font-size: 20px;"  href="{{route('user.order')}}">Xem đơn hàng</a>
                                        <a class="dropdown-item" style="letter-spacing: -1px;font-size: 20px;" href="{{route('user.logout')}}">Đăng xuất</a>
                                            @else
                                        <a class="dropdown-item" style="letter-spacing: -1px; font-size: 20px;" href="{{route('user.login')}}">Đăng nhập</a>
                                        <a class="dropdown-item" style="letter-spacing: -1px; font-size: 20px;" href="{{route('user.register')}}">Đăng ký</a>    
                                            @endif
                                      </div>
                                      </div>
                                </li>
                            </ul>
                            <!-- End Header Action Link -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="sticky-header header-bottom header-bottom-color--golden section-fluid  sticky-color--golden">
                <div class="container-fluid">
                    <div class="text-center">
                        <div class="main-menu menu-color--black menu-hover-color--golden col-12" >
                            <nav>
                                <ul>
                                    <li class="has-dropdown">
                                        <a class="active main-menu-link" href="{{route('user.home')}}">Trang chủ</a>
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