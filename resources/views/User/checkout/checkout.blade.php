@extends('User.layout.main')

@section('title')
Chotsport - Thanh toán đơn hàng
@endsection

@section('content')
<div class="breadcrumb-nav p-3 mb-2 text-dark" style="background-color:#e1e3e8!important;padding: 3px 20px!important; margin-bottom: 50px!important">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li class="active" aria-current="page">Giỏ hàng</li>
                                    <li class="active" aria-current="page">Thông tin giao hàng</li>
                                </ul>
                            </nav>
</div>
 <!-- ...:::: Start Checkout Section:::... -->
    <div class="checkout-section m-10">
        <div class="container">
            <div class="row">
            </div>
            <!-- Start User Details Checkout Form -->
            <div class="checkout_form" data-aos="fade-up"  data-aos-delay="400">
                <form action="{{route('user.checkout.post')}}" method="POST">
                    @csrf
                <div class="row">
                    @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                    @endif
                    <div class="col-lg-6 col-md-6">
                            <h3>Thông tin giao hàng</h3>
                            <div class="row">
                                <div class="col-12">
                                    <div class="default-form-box">
                                        <label>Tên nhận hàng <span>*</span></label>
                                        <input name="name" type="text" placeholder="Họ và tên" value="{{Auth::user()->name}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="default-form-box">
                                        <label>Số điện thoại <span>*</span></label>
                                        <input name="phone" type="text" placeholder="Số điện thoại" value="{{Auth::user()->phone}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="default-form-box">
                                        <label> Email <span>*</span></label>
                                        <input name="email" type="email" placeholder="Email" value="{{Auth::user()->email}}" required>
                                    </div> 
                                </div>
                                @if(!empty($full_address))
                                <div class="col-12">
                                    <div class="default-form-box">
                                        <label>Địa chỉ đã lưu</label>
                                        <input name="full_address" type="text" readonly value="{{$full_address}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="checkbox-default" for="newShipping" data-bs-toggle="collapse" data-bs-target="#anotherShipping">
                                        <input type="checkbox" id="newShipping">
                                        <span>Thay đổi địa chỉ nhận hàng?</span>
                                    </label>

                                    <div id="anotherShipping"  class="collapse mt-3" data-parent="#anotherShipping">
                                        <div class="row">
                                            <div class="row default-form-box mb-20">
                                                <label>Chọn địa chỉ <span>*</span></label>
                                                <div class="col-md-4">
                                                        <select  class="form-select" id="city" aria-label=".form-select-sm" name="city"  >
                                                            <option value="" >Chọn tỉnh thành</option>   
                                                         @foreach($city as $value)       
                                                           <option value="{{$value->id}}">{{$value->name}}</option>
                                                          @endforeach
                                                         </select>
                                                </div>
                                                <div class="col-md-4">
                                                        <select class="form-select" id="district" aria-label=".form-select-sm" name="district">
                                                        <option value="" >Chọn quận huyện</option>
                                                        </select>
                                                </div>
                                                <div class="col-md-4">
                                                       <select class="form-select"  aria-label=".form-select-sm" id="ward" name="ward" >
                                                        <option  value="">Chọn phường xã</option>
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Địa chỉ chi tiết <span>*</span></label>
                                                <input class="form-control" id="chitiet" type="text" name="chitiet"  value="" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row default-form-box mb-20">
                                                <label>Chọn địa chỉ <span>*</span></label>
                                                <div class="col-md-4">
                                                        <select  class="form-select" id="city" aria-label=".form-select-sm" name="city" required >
                                                            <option value="" >Chọn tỉnh thành</option>   
                                                          @foreach($city as $value)       
                                                           <option value="{{$value->id}}">{{$value->name}}</option>
                                                          @endforeach
                                                         </select>
                                                </div>
                                                <div class="col-md-4">
                                                        <select class="form-select" id="district" aria-label=".form-select-sm" name="district" required >
                                                        <option value="" >Chọn quận huyện</option>
                                                        </select>
                                                </div>
                                                <div class="col-md-4">
                                                       <select class="form-select"  aria-label=".form-select-sm" id="ward" name="ward" required>
                                                        <option  value="">Chọn phường xã</option>
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Địa chỉ chi tiết <span>*</span></label>
                                                <input class="form-control" id="chitiet" type="text" name="chitiet"  value="" required>
                                            </div>
                                @endif
                                <div class="col-12 mt-3">
                                    <div class="order-notes">
                                        <label for="order_note">Ghi chú</label>
                                        <textarea name="note" id="order_note" placeholder="Chúng tôi sẽ chuyển ghi chú này tới đơn vị giao hàng"></textarea>
                                    </div>
                                </div>
                            </div>
                       
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <form action="#">
                            <h3>Đơn hàng của bạn</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(session()->has('cart'))
                                        @php $totalPayment=0; @endphp 
                                        @foreach(session()->get('cart') as $key => $value )   
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label><img src="{{$value['cartImg']}}" style="width:66%"><span>× {{$value['cartQty']}}</span></label>
                                                    </div>
                                                    <div class="col-9" style="padding:0">
                                                        {{$value['Name_product']}}
                                                        <br>
                                                        <span style="font-size: 13px">Kích thước: {{$value['Sizename']}}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{number_format($value['cartPrice']*$value['cartQty'], 0, '.', ',')}}đ</td>
                                        </tr>
                                    @php $totalPayment += $value['cartPrice'] * $value['cartQty']; @endphp
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Phí vận chuyển:</th>
                                            <td><strong>Miễn phí</strong></td>
                                        </tr>
                                        <tr class="order_total">
                                            <th><h5 class="font-weight-bold text-success">Tổng tiền thanh toán</h4></th>
                                            <td><h5 class="font-weight-bold text-danger">{{number_format($totalPayment,0,','.',')}}đ</h5></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment_method">
                                <div class="panel-default">
                                    <label class="checkbox-default" for="currencyCod" data-bs-toggle="collapse" data-bs-target="#methodCod">
                                        <input type="radio" id="currencyCod" name="payment_method" value="postpay">
                                        <span>Thanh toán sau khi nhận hàng</span>
                                    </label>

                                    <div id="methodCod" class="collapse method" data-parent="#methodCod">
                                        <div class="card-body1">
                                            <p>Khách hàng được kiểm tra hàng, vui lòng chỉ thử giày trực tiếp trước shipper</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-default">
                                    <label class="checkbox-default" for="currencyPaypal" data-bs-toggle="collapse" data-bs-target="#methodPaypal">
                                        <input type="radio" id="currencyPaypal" name="payment_method" value="prepay">
                                        <span>Thanh toán online</span>
                                    </label>
                                    <div id="methodPaypal" class="collapse method" data-parent="#methodPaypal">
                                        <div class="card-body1">
                                            <p>Khách hàng chọn thanh toán online sẽ nhận được hàng sớm nhất có thể. Vui lòng giữ hoá đơn thanh toán để chúng tôi dễ dàng xử lý nếu gặp lỗi</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="order_button pt-3">
                                    <button class="btn btn-md btn-black-default-hover" type="submit">Hoàn tất đơn hàng</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                 </form>
            </div> <!-- Start User Details Checkout Form -->
        </div>
    </div><!-- ...:::: End Checkout Section:::... -->






<!-- Jquery -->
<script type="text/javascript">
    $(document).ready(function() {
        $('select').niceSelect('destroy');

        $('input[type="radio"]').click(function() {
            $('.method').removeClass('show');
            $(this).parent().siblings('.method').addClass('show'); //siblings tìm anh em cùng cấp với parent(phần tử cha)
            
        });
        $('form').submit(function() { //bắt buộc chọn phương thức thanh toán
        if($('input[name="payment_method"]').is(':checked') ){
            return true;
        }else{
            alert('Vui lòng chọn phương thức thanh toán');
            return false;
        }
        });
        $('#newShipping').click(function() {
            if ($('#newShipping').is(':checked')) {
                $('#anotherShipping').find('select').attr('required', true);
            } else {
                $('#anotherShipping').find('select').attr('required', false);
            }
        });
        // Xử lý Ajax địa chỉ
        // xử lý gọi huyện theo tỉnh thành
          $('#city').change(function(){
            var id_city=$(this).val();
          // gài trường hợp chọn về default  thì không hiển thị xã
           if(id_city==" "){
              $('#ward').html("<option value='"+"' >Chọn phường xã</option>");
          }
          // Bắt đầu gửi AJAX
            $.ajax({
                url: '{{route('user.checkout.post') }}', // đường dẫn đến controller
                method: 'POST', // phương thức POST
                data: { // dữ liệu gửi đi
                    id_city: id_city, // giá trị id_city
                    _token: '{{ csrf_token() }}' // token để bảo vệ form
                },
                success: function(data){ // nhận kết quả trả về
                    // xoá hết option huyện cũ chỉ chừa lại option default
                      $('#district').html("<option value='"+"' >Chọn quận huyện</option>");
                  $.each(data, function(index, district) {   
                    // thêm các option huyện mới vào
                      $('#district').append('<option value="' + district.id + '">' + district.name + '</option>');
                  });

                }
            });
           
          })

          // xử lý gọi xã theo huyện
           $('#district').change(function(){
            var id_district=$(this).val();
            $.ajax({
                url: '{{route('user.profile.post') }}', // đường dẫn đến controller
                method: 'POST', // phương thức POST
                data: { // dữ liệu gửi đi
                    id_district: id_district, // giá trị id_district
                    _token: '{{ csrf_token() }}' // token để bảo vệ form
                },
                success: function(data){ // nhận kết quả trả về
                    // xoá hết option xã cũ chỉ chừa lại option default
                      $('#ward').html("<option value='"+"' >Chọn phường xã</option>");
                  $.each(data, function(index, ward) {   
                    // thêm các option huyện mới vào
                      $('#ward').append('<option value="' + ward.id + '">' + ward.name + '</option>');
                  });

                }
            });

          })   
    });
</script>

@endsection
           


