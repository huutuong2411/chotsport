@extends('User.layout.main')

@section('title')
Chotsport - Giỏ hàng của bạn
@endsection

@section('content')
<div class="breadcrumb-nav p-3 mb-2 text-dark" style="background-color:#e1e3e8!important;padding: 3px 20px!important; margin-bottom: 50px!important">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li class="active" aria-current="page">Trang chủ</li>
                                    <li class="active" aria-current="page">Giỏ hàng</li>
                                </ul>
                            </nav>
</div>
<!-- ...:::: Start Cart Section:::... -->
    <div class="cart-section">
        <!-- Start Cart Table -->
        <div class="cart-table-wrapper"  data-aos="fade-up"  data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="table_page table-responsive">
                                <table>
                                    <!-- Start Cart Table Head -->
                                    <thead>
                                        <tr>
                                            <th class="product_remove">Xoá</th>
                                            <th class="product_thumb">Hình ảnh</th>
                                            <th class="product_name">Tên sản phẩm</th>
                                            <th class="product-price">Đơn giá</th>
                                            <th class="product_quantity">Số lượng</th>
                                            <th class="product_total">Thành tiền</th>
                                        </tr>
                                    </thead> <!-- End Cart Table Head -->
                                    <tbody>
                                        <!-- Start Cart Single Item-->
                                    @if(session()->has('cart'))
                                        @php $totalPayment=0; @endphp 
                                        @foreach(session()->get('cart') as $key => $value )
                                        <tr>
                                            <td class="product_remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                            <td class="product_thumb"><a href="product-details-default.html"><img src="{{$value['cartImg']}}" alt=""></a></td>
                                            <td class="product_name" style="text-align: left;">
                                                <a href="product-details-default.html">{{$value['Name_product']}}</a>
                                                <br>
                                                <span>Kích thước:{{$value['Sizename']}}</span>
                                                <input type="hidden" value="{{$key}}">
                                            </td>
                                            <td class="product-price">{{number_format($value['cartPrice'], 0, '.', ',')}}</td>
                                            <td class="product_quantity"><input onKeyDown="return false" min="1" max="100" value="{{$value['cartQty']}}" type="number"></td>
                                            <td class="product_total">{{number_format($value['cartPrice']*$value['cartQty'], 0, '.', ',')}}đ</td>
                                        </tr> <!-- End Cart Single Item-->
                                         @php $totalPayment += $value['cartPrice'] * $value['cartQty']; @endphp
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_submit">
                                @if(!empty(session()->get('cart')))
                                <h5>Tổng tiền: <strong style="color:red">{{number_format($totalPayment,0,','.',')}} đ</strong></h5>
                                <div class="float-left"><a href="{{route('user.home')}}" style="color: #b1935e; text-decoration: underline;">Tiếp tục mua sắm</a></div>
                                <div class="checkout_btn">
                                    <a href="{{route('user.checkout')}}" id="checkout" data-target="#exampleModal" class="btn btn-md btn-golden">Thanh toán</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Cart Table -->

    </div> <!-- ...:::: End Cart Section:::... -->


<!-- Button trigger modal -->
<!-- Modal -->
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
        // xử lý tăng giảm tiền theo số lượng
        $('td.product_quantity').find('input').change(function(){  
            var id_cartchange= $(this).closest('tr').find('td.product_name').find('input').val();   
            var thisPrice =parseInt($(this).closest('tr').find('td.product-price').text().replace(/\D/g,'')); //giá
            var oldTotalpayment = parseInt($('.cart_submit').find('strong').text().replace(/\D/g,''));        //Tổng tiền cũ
            var thisTotal = parseInt($(this).closest('tr').find('td.product_total').text().replace(/\D/g,'')); // thành tiền sản phẩm chưa tăng
            // \D là viết tắt của [^\d] tức không phải số 0-9;
            var nowQty = $(this).val();
            var nowTotal = thisPrice*nowQty;
            var nowTotalpayment= oldTotalpayment-thisTotal+nowTotal;
            $(this).closest('tr').find('td.product_total').text(nowTotal.toLocaleString('en-US')+"đ");
            $('.cart_submit').find('strong').text(nowTotalpayment.toLocaleString('en-US')+"đ");
            // xử lý ajax
            $.ajax({
                url: '{{route('user.updatecart')}}', 
                method: 'POST', // phương thức POST
                dataType: 'json',
                data: { // dữ liệu gửi đi
                    id_cartChange: id_cartchange,
                    newQty: nowQty, // giá trị id_cart
                    _token: '{{ csrf_token() }}' // token để bảo svệ form
                },
                success: function(data){ // nhận kết quả trả về
                    $('span.item-count').text(data);
                 }
            });  // dấu đóng AJAX        
        });



        // xử lý xoá bớt sản phẩm trong cart
        $('td.product_remove').find('a').click(function(){
            if (confirm('Bạn có chắc muốn xoá?')) {
                var id_cartdelete= $(this).closest('tr').find('td.product_name').find('input').val();   
                var oldTotalpayment = parseInt($('.cart_submit').find('strong').text().replace(/\D/g,''));        //Tổng tiền cũ
                var thisTotal = parseInt($(this).closest('tr').find('td.product_total').text().replace(/\D/g,'')); //tiền sản phẩm trước lúc xoá

                $(this).closest('tr').remove(); //xoá hàng của sản phẩm đó

                var nowTotalpayment= oldTotalpayment-thisTotal;
                $('.cart_submit').find('strong').text(nowTotalpayment.toLocaleString('en-US')+"đ"); 
                // xử lý ajax
                $.ajax({
                    url: '{{route('user.updatecart')}}', 
                    method: 'POST', // phương thức POST
                    dataType: 'json',
                    data: { // dữ liệu gửi đi
                        id_cartDelete: id_cartdelete, // giá trị id_cart
                        _token: '{{ csrf_token() }}' // token để bảo svệ form
                    },
                    success: function(data){ // nhận kết quả trả về
                    $('span.item-count').text(data);
                    }
                });  // dấu đóng AJAX        
            }    
        });

        $('#checkout').click(function(){
            var checklogin = "{{Auth::check()}}";
            if(!checklogin){
                $('#exampleModal').modal("show")
                return false;
            }

        });

    }); //dấu đóng hàm ready
</script>
@endsection
               