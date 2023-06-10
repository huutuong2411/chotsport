<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from htmldemo.hasthemes.com/hono/hono/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Jan 2021 00:31:04 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    
    <!-- ::::::::::::::Favicon icon::::::::::::::-->
    <link rel="shortcut icon" href="{{asset('user/assets/images/logo_chot.ico')}}" type="image/png">

    <!-- ::::::::::::::All CSS Files here :::::::::::::: -->
    <!-- Vendor CSS -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/vendor/ionicons.css">
    <link rel="stylesheet" href="assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <!-- link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <!-- Plugin CSS -->
    <!-- <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/venobox.min.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.lineProgressbar.css">
    <link rel="stylesheet" href="assets/css/plugins/aos.min.css"> -->

    <!-- Main CSS -->
    <!-- <link rel="stylesheet" href="assets/sass/style.css"> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="{{asset('user/assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/vendor/vendor.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/plugins/plugins.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/tracking.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/style.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
   $(document).ready(function() { 
         $('#inputsearch').on('input', function() { //bắt buộc chọn size
            $('#formSearch').remove();
            
            var word= $(this).val();
           $.ajax({
                url: '{{route('user.search')}}', 
                method: 'GET', // phương thức POST
                dataType: 'json',
                data: { // dữ liệu gửi đi
                    word: word, // giá trị id_product 
                },
                success: function(data){ // nhận kết quả trả về
                    if(data!=""){
                        $('#formSearch').empty(); // Xóa các kết quả hiện có
                        $('.search_form').append("<ul class='col-11 card' id='formSearch'>"+
                                    "</ul>");
                        $.each(data, function(key, value) {
                            var price = Number(value.price).toLocaleString('en-US');
                            var image = JSON.parse(value.image);
                            var URL="{{url('admin/assets/img/product/')}}"+"/"+value.id+"/"+image[0];
                            $('#formSearch').append(
                                "<li class='offcanvas-cart-item-single'>"+
                                    "<div class='offcanvas-cart-item-block'>"+
                                        "<a href='{{url('product/')}}"+"/"+value.id+"' class='offcanvas-cart-item-image-link'>"+
                                                    "<img src='"+URL+"' alt='' class='offcanvas-cart-image'>"+
                                                "</a>"+
                                                "<div class='offcanvas-cart-item-content'>"+
                                                    "<a href='{{url('product/')}}"+"/"+value.id+"' class='offcanvas-cart-item-link'>"+value.name+"</a>"+
                                                    "<div class='offcanvas-cart-item-details'>"+
                                                        "<span class='offcanvas-cart-item-details-price'>"+price+"đ"+"</span>"+
                                                    "</div>"+
                                                "</div>"+
                                            "</div>"+
                                        "</li>"
                                );
                        });

                    }
                }
                   
            }); // dấu đóng ajax
           if (word == '') {
                $('#formSearch').remove(); // Xóa phần tử formSearch
            }
        });
        // xử lý click bên ngoài form search
        $(document).click(function(event) {
            var target = event.target;
            // Kiểm tra xem phần tử được click có là input hoặc formSearch hay không
            if (!$(target).is('#inputsearch') && !$(target).is('#formSearch')) {
                $('#formSearch').remove();
            }
        });

        // xử lý tư vấn size giày
        $('form#advisesize').submit(function(event) {
            event.preventDefault();
            $('#result').html("");
            var isChecked = $('#sock').prop('checked');
            var length = $(this).find('input#length').val();
            var width = $(this).find('input#width').val();
            var havesock="";
            isChecked==true?havesock="(Đo khi đã đi tất/vớ)":havesock="(Đo khi không đi tất/vớ)"
            $.ajax({
                url: '{{route('user.Advise')}}',
                method: 'POST',
                data: {
                    length: length,
                    width: width,
                    isChecked:isChecked,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data); // Kiểm tra kết quả trong tab Console
                    if(data.form=="Thon"){
                        var note="Vì form chân của bạn là:"+"<strong class='font-weight-bold text-danger'> "+data.form+"</strong>"+", bạn nên cân nhắc lùi size nếu vẫn muốn đi dòng giày cho chân bè";
                    }else if(data.form=="Vừa"||data.form=="Bè"){
                        var note="Vì form chân của bạn là:"+"<strong class='font-weight-bold text-danger'> "+data.form+"</strong>"+", đây là form chân thích hợp với đa số dòng giày bóng đá, bạn nên đi truesize (đúng size của mình)";
                    }else if(data.form=="Bè nhiều"){
                        var note="Vì form chân của bạn là:"+"<strong class='font-weight-bold text-danger'> "+data.form+"</strong>"+", bạn nên cân nhắc tăng size nếu vẫn muốn đi dòng giày cho chân thon";
                    }else if(data.form=="Siêu bè"){
                        var note="Vì form chân của bạn là:"+"<strong class='font-weight-bold text-danger'> "+data.form+"</strong>"+", đây là form chất khá kén với hầu hết giày bóng đá. Bạn phải tăng size nếu vẫn muốn đi dòng giày cho chân thon, và chịu khó mất thời gian thuần giày nếu đi truesize (đúng size chân của mình) khi đi những dòng giày còn lại";
                    }
                    $('#result').append(
                    "<div class='card emptycart-content col-11' id='sizeresult'>"+
                    "<h5 class='title text-center'>Thông tin kích thước chân</h5>"+
                    "<label><strong>Chiều dài chân của bạn:</strong> "+length+" (cm)</label>"+
                    "<label><strong>Chiều rộng chân của bạn:</strong> "+width+" (cm)</label>"+
                    "<label>"+havesock+"</label>"+
                   "<h5 class='font-weight-bold text-success'>Form chân của bạn:<strong class='font-weight-bold text-danger'> "+data.form+"</strong></h5>"+
                   "<div class='row'>"+
                   "<h5 class='font-weight-bold text-success col-5'>Size giày thích hợp:</h5>"+
                    "<ul class='col-7' id='listsize'>"+
                    "</ul>"+
                    "</div>"+
                    "<a target='_blank' href='{{url('/bangsize.webp')}}'><u>Tham Khảo bảng size chi tiết</u></a>"+
                   "<h5 class='font-weight-bold text-success'>Lời khuyên:</h5>"+
                   "<label>- Nếu form chân thon nên chọn dòng giày: <strong>nike Mercurial, nike Phantom, adidas X, puma Ultra...</strong></label>"+
                   "<label>- Nếu form chân bè nhiều hoặc siêu bè nên chọn dòng giày: <strong>nike Tiempo, adidas Predator, adidas Copa, puma Future, giày Mizuno, Kamito...</strong></label>"+
                   "<h5 class='font-weight-bold text-danger'>*Lưu ý:</h5>"+
                   "<label>- "+note+".</label>"+
                   "<label>- Giày bóng đá cần thời gian giãn theo chân nên bạn không nên trả hàng ngay trừ khi nó quá bó hoặc kích mũi mà hãy kiên nhẫn đi lại trong nhà để cảm nhận đôi giày này có hợp hay không!</label>"+
                   "<label class='text-danger'> #Đừng lo lắng vì chúng tôi có chính sách đổi trả trong vòng 7 ngày nếu giày chưa ra sân!</label>"+
                   "</div>"
                    );
                    if(data.truesize){
                      $.each(data.truesize, function(key, value) {
                        $('#listsize').append(
                            "<li>"+value.size+"  <strong>với "+value.brand+"</strong></li>"
                        );
                      });
                    }
                }
            }); // dấu đóng ajax
        });
}); //dấu đóng hàm ready
</script>
</head>
<body>
    <!-- Start Header Area -->
    @include('User.layout.header')
    <!-- Start Header Area -->
    <!-- content main -->

    @yield('content')
    <!-- end content main -->
    <!-- Start Mobile Header -->
    <div class="mobile-header mobile-header-bg-color--golden section-fluid d-lg-block d-xl-none">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <!-- Start Mobile Left Side -->
                    <div class="mobile-header-left">
                        <ul class="mobile-menu-logo">
                            <li>
                                <a href="index.html">
                                    <div class="logo">
                                        <img src="assets/images/logo/logo_black.png" alt="">
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                     <!-- End Mobile Left Side -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Mobile Header -->
    <!-- Start Offcanvas Mobile Menu Section -->
    <div id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
        <!-- Start Offcanvas Header -->
        <div class="offcanvas-header text-right">
            <button class="offcanvas-close"><i class="ion-android-close"></i></button>
        </div> <!-- ENd Offcanvas Header -->

        <!-- Start Offcanvas Mobile Menu Wrapper -->
        <div class="offcanvas-wishlist-wrapper">
            <h4 class="offcanvas-title">Wishlist</h4>
            <ul class="offcanvas-wishlist">
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">
                        <a href="#" class="offcanvas-wishlist-item-image-link">
                            <img src="assets/images/product/default/home-1/default-1.jpg" alt="" class="offcanvas-wishlist-image">
                        </a>
                        <div class="offcanvas-wishlist-item-content">
                            <a href="#" class="offcanvas-wishlist-item-link">Car Wheel</a>
                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                                <span class="offcanvas-wishlist-item-details-price">$49.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">
                        <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">
                        <a href="#" class="offcanvas-wishlist-item-image-link">
                            <img src="assets/images/product/default/home-2/default-1.jpg" alt="" class="offcanvas-wishlist-image">
                        </a>
                        <div class="offcanvas-wishlist-item-content">
                            <a href="#" class="offcanvas-wishlist-item-link">Car Vails</a>
                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">3 x </span>
                                <span class="offcanvas-wishlist-item-details-price">$500.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">
                        <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
                <li class="offcanvas-wishlist-item-single">
                    <div class="offcanvas-wishlist-item-block">
                        <a href="#" class="offcanvas-wishlist-item-image-link">
                            <img src="assets/images/product/default/home-3/default-1.jpg" alt="" class="offcanvas-wishlist-image">
                        </a>
                        <div class="offcanvas-wishlist-item-content">
                            <a href="#" class="offcanvas-wishlist-item-link">Shock Absorber</a>
                            <div class="offcanvas-wishlist-item-details">
                                <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                                <span class="offcanvas-wishlist-item-details-price">$350.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="offcanvas-wishlist-item-delete text-right">
                        <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </li>
            </ul>
            <ul class="offcanvas-wishlist-action-button">
                <li><a href="#" class="btn btn-block btn-golden">View wishlist</a></li>
            </ul>
        </div> <!-- End Offcanvas Mobile Menu Wrapper -->

    </div> 
    <!-- tìm kiếm -->
    <div id="search" class="search-modal">
        <button type="button" class="close">×</button>
        <div class="row" style="margin: 40px 0px 0px 35px;">
        <div class="col-lg-4 col-md-4" >
            <h1 style="color: yellow;">Hướng Dẫn Đo Chân</h1>
            <h5 style="color: bisque;">bạn hãy đặt chân mình lên tờ giấy, vẽ chu vi bàn chân lên giấy và đo chiều dài, chiều rộng rồi nhập vào ô bên dưới</h5>
            <br>
            <img  src="{{asset('user/assets/images/dochan/huongdandochan.jpg')}}" alt="">
        </div>
        <div class="col-lg-3 col-md-3">
            <form id="advisesize">
            <div class="form-group">
              <label style="color: yellow;margin:10px 0px ;" >Chiều dài chân (cm)</label>
              <input class="form-control" id="length" type="text" pattern="[0-9]+([.][0-9]+)?" title="Vui lòng nhập số nguyên hoặc số thực, ngăn cách phần nguyên bằng dấu '.'" required/>
              
            </div>
            <div class="form-group">
                <label style="color: yellow;" >Chiều Rộng chân (cm)</label>
                <input id="width" type="text" pattern="[0-9]+([.][0-9]+)?" title="Vui lòng nhập số nguyên hoặc số thực, ngăn cách phần nguyên bằng dấu '.'" class="form-control" required>
            </div>
            <div class="form-group form-check" >
                <input type="checkbox" class="form-check-input" id="sock" style="margin-top: 0px;">
                <label class="form-check-label"  style="color: rgb(151, 151, 20);" >Bạn đo khi có đi vớ/tất?</label>
            </div>
            <button type="submit" class="btn btn-lg btn-golden">Tìm size</button>
          </form>
        </div>
        <div class="col-lg-5 col-md-5" id="result">
        </div>
        </div>
        
    </div>
  
    <div class="offcanvas-overlay"></div>
 
 
     


    <!-- Start Footer Section -->
    @include('User.layout.footer')
    <!-- End Footer Section -->

    <!-- material-scrolltop button -->
    <button class="material-scrolltop" type="button"></button>

    <!-- Start Modal Add cart -->
    <div class="modal fade" id="modalAddcart" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="modal-add-cart-info"></div>
                            <div class="col-md-3 imagecart">
                                <img style="width:100%;" src="" alt="">
                            </div>
                            <div class="col-md-8 modal-border">
                                <ul class="modal-add-cart-product-shipping-info">
                                    
                                </ul>
                                <div class="modal-add-cart-product-cart-buttons">
                                            <a href="{{route('user.cart')}}">Xem giỏ hàng</a>        
                                </div>
                                <a href="javascript:void(0)" class="text-decoration-underline" data-bs-dismiss="modal">Tiếp tục mua sắm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Add cart -->

    <!-- Start Modal Quickview cart -->
    <div class="modal fade" id="modalQuickview" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-details-gallery-area mb-7">
                                    <!-- Start Large Image -->
                                    <div class="product-large-image modal-product-image-large swiper-container">
                                            <div class="swiper-wrapper">
                                                <div class="product-image-large-image swiper-slide img-responsive">
                                                    <img src="assets/images/product/default/home-1/default-1.jpg" alt="">
                                                </div>
                                                <div class="product-image-large-image swiper-slide img-responsive">
                                                    <img src="assets/images/product/default/home-1/default-2.jpg" alt="">
                                                </div>
                                                <div class="product-image-large-image swiper-slide img-responsive">
                                                    <img src="assets/images/product/default/home-1/default-3.jpg" alt="">
                                                </div>
                                                <div class="product-image-large-image swiper-slide img-responsive">
                                                    <img src="assets/images/product/default/home-1/default-4.jpg" alt="">
                                                </div>
                                                <div class="product-image-large-image swiper-slide img-responsive">
                                                    <img src="assets/images/product/default/home-1/default-5.jpg" alt="">
                                                </div>
                                                <div class="product-image-large-image swiper-slide img-responsive">
                                                    <img src="assets/images/product/default/home-1/default-6.jpg" alt="">
                                                </div>
                                            </div>
                                    </div>
                                    <!-- End Large Image -->
                                        <!-- Start Thumbnail Image -->
                                    <div class="product-image-thumb modal-product-image-thumb swiper-container pos-relative mt-5">
                                            <div class="swiper-wrapper">
                                                <div class="product-image-thumb-single swiper-slide">
                                                    <img class="img-fluid" src="assets/images/product/default/home-1/default-1.jpg" alt="">
                                                </div>
                                                <div class="product-image-thumb-single swiper-slide">
                                                    <img class="img-fluid" src="assets/images/product/default/home-1/default-2.jpg" alt="">
                                                </div>
                                                <div class="product-image-thumb-single swiper-slide">
                                                    <img class="img-fluid" src="assets/images/product/default/home-1/default-3.jpg" alt="">
                                                </div>
                                                <div class="product-image-thumb-single swiper-slide">
                                                    <img class="img-fluid" src="assets/images/product/default/home-1/default-4.jpg" alt="">
                                                </div>
                                                <div class="product-image-thumb-single swiper-slide">
                                                    <img class="img-fluid" src="assets/images/product/default/home-1/default-5.jpg" alt="">
                                                </div>
                                                <div class="product-image-thumb-single swiper-slide">
                                                    <img class="img-fluid" src="assets/images/product/default/home-1/default-6.jpg" alt="">
                                                </div>
                                        </div>
                                        <!-- Add Arrows -->
                                        <div class="gallery-thumb-arrow swiper-button-next"></div>
                                        <div class="gallery-thumb-arrow swiper-button-prev"></div>
                                    </div>
                                        <!-- End Thumbnail Image -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-product-details-content-area">
                                    <!-- Start  Product Details Text Area-->
                                    <div class="product-details-text">
                                        <h4 class="title">Nonstick Dishwasher PFOA</h4>
                                        <div class="price"><del>$70.00</del>$80.00</div>
                                    </div> <!-- End  Product Details Text Area-->
                                    <!-- Start Product Variable Area -->
                                    <div class="product-details-variable">
                                        <!-- Product Variable Single Item -->
                                        <div class="variable-single-item">
                                            <span>Color</span>
                                            <div class="product-variable-color">
                                                <label for="modal-product-color-red">
                                                    <input name="modal-product-color" id="modal-product-color-red" class="color-select" type="radio" checked>
                                                    <span class="product-color-red"></span>
                                                </label>
                                                <label for="modal-product-color-tomato">
                                                    <input name="modal-product-color" id="modal-product-color-tomato" class="color-select" type="radio">
                                                    <span class="product-color-tomato"></span>
                                                </label>
                                                <label for="modal-product-color-green">
                                                    <input name="modal-product-color" id="modal-product-color-green" class="color-select" type="radio">
                                                    <span class="product-color-green"></span>
                                                </label>
                                                <label for="modal-product-color-light-green">
                                                    <input name="modal-product-color" id="modal-product-color-light-green" class="color-select" type="radio">
                                                    <span class="product-color-light-green"></span>
                                                </label>
                                                <label for="modal-product-color-blue">
                                                    <input name="modal-product-color" id="modal-product-color-blue" class="color-select" type="radio">
                                                    <span class="product-color-blue"></span>
                                                </label>
                                                <label for="modal-product-color-light-blue">
                                                    <input name="modal-product-color" id="modal-product-color-light-blue" class="color-select" type="radio">
                                                    <span class="product-color-light-blue"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- Product Variable Single Item -->
                                        <div class="d-flex align-items-center flex-wrap">
                                            <div class="variable-single-item ">
                                                <span>Quantity</span>
                                                <div class="product-variable-quantity">
                                                    <input min="1" max="100" value="1" type="number">
                                                </div>
                                            </div>

                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add To Cart</a>
                                            </div>
                                        </div>
                                    </div> <!-- End Product Variable Area -->
                                    <div class="modal-product-about-text">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam, reiciendis maiores quidem aperiam, rerum vel recusandae</p>
                                    </div>
                                    <!-- Start  Product Details Social Area-->
                                    <div class="modal-product-details-social">
                                        <span class="title">SHARE THIS PRODUCT</span>
                                        <ul>
                                            <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                        
                                    </div> <!-- End  Product Details Social Area-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Quickview cart -->

    <!-- ::::::::::::::All JS Files here :::::::::::::: -->
    <!-- Global Vendor, plugins JS -->
    <!-- <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/jquery-ui.min.js"></script>  -->
    <!--Plugins JS-->
    <!-- <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/material-scrolltop.js"></script>
    <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/venobox.min.js"></script>
    <script src="assets/js/plugins/jquery.waypoints.js"></script>
    <script src="assets/js/plugins/jquery.lineProgressbar.js"></script>
    <script src="assets/js/plugins/aos.min.js"></script>
    <script src="assets/js/plugins/jquery.instagramFeed.js"></script>
    <script src="assets/js/plugins/ajax-mail.js"></script> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->

    <script src="{{asset('user/assets/js/vendor/vendor.min.js')}}"></script>
    <script src="{{asset('user/assets/js/plugins/plugins.min.js')}}"></script> 

    <!-- Main JS -->
    <script src="{{asset('user/assets/js/main.js')}}"></script>
    <!-- jQuery library -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->

</body>

</html>