@extends('User.layout.main')

@section('title')
Chotsport - Thông tin tài khoản
@endsection

@section('content')
<div class="breadcrumb-nav p-3 mb-2 text-dark" style="background-color:#e1e3e8!important;padding: 3px 20px!important; margin-bottom: 50px!important">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li class="active" aria-current="page">Trang chủ</li>
                                    <li class="active" aria-current="page">Tài khoản</li>
                                </ul>
                            </nav>
</div>
<div class="row">
    <div class="col-7 mx-auto">
     @if ($errors->any())
                                    <div class="alert alert-danger">
                                       <ul>
                                        @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                        @endif


                        @if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                        {{session('success')}}
                            </div>
                                @endif
    </div>
</div>
<form action="{{route('user.profile.post')}}" method="post" enctype="multipart/form-data" id="form">
    @csrf
<div class="row justify-content-center">
<div class="col-2">
    <div class="showavatar">
        @if(Auth::user()->avatar)
        <img style="width:100%"  src="{{asset('/user/assets/images/user/'.Auth::user()->avatar)}}" >
        @else
        <img style="width:100%" src="{{asset('/user/assets/images/user/userdefault.webp')}}" >
        @endif
    </div>
    <div class="default-form-box mb-20">
        <label>Tải lên avatar</label>
        <input name="avatar" type="file">
    </div>
</div>

<div class="tab-pane fade active show col-5" id="account-details">
                            <h3>Thông tin tài khoản</h3>
                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">
                                            <br>
                                            <div class="default-form-box mb-20">
                                                <label>Tên của bạn</label>
                                                <input type="text" name="name" value="{{Auth::user()->name}}" required>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Email</label>
                                                <input type="text" name="email" value="{{Auth::user()->email}}" required>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Số điện thoại</label>
                                                <input type="text" name="phone" value="{{Auth::user()->phone}}" required>
                                            </div>
                                            @if(Auth::user()->id_address)
                                            <div class="default-form-box mb-20">
                                                <label>Địa chỉ đã lưu</label>
                                                <input name="full_address"  type="text" readonly value="{{$full_address}}">
                                            </div>
                                            @endif
                                            <div class="row default-form-box mb-20">
                                                <label>Chọn địa chỉ</label>
                                                <div class="col-md-4">
                                                        <select {{ $full_address !="" ? '' : 'required' }} class="form-select" id="city" aria-label=".form-select-sm" name="city"  >
                                                            <option value="" >Chọn tỉnh thành</option>   
                                                          @foreach($city as $value)       
                                                           <option value="{{$value->id}}">{{$value->name}}</option>
                                                          @endforeach
                                                         </select>
                                                </div>
                                                <div class="col-md-4">
                                                        <select class="form-select" id="district" aria-label=".form-select-sm" name="district" {{ $full_address !="" ? '' : 'required' }}>
                                                        <option value="" >Chọn quận huyện</option>
                                                        </select>
                                                </div>
                                                <div class="col-md-4">
                                                       <select class="form-select"  aria-label=".form-select-sm" id="ward" name="ward" {{ $full_address !="" ? '' : 'required' }}>
                                                        <option  value="">Chọn phường xã</option>
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>Địa chỉ chi tiết</label>
                                                <input {{ Auth::user()->id_address ? '' : 'required' }}  class="form-control" id="chitiet" type="text" name="chitiet"  value="">
                                            </div>
                                            <div class="save_button mt-3">
                                                <button class="btn btn-md btn-black-default-hover" type="submit">Lưu</button>
                                                <br>
                                                <br>
                                                <h5><a href="{{route('user.changepass')}}"> Đổi mật khẩu</a></h5>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
</div>
</div>
</form>

<!-- js -->
<script type="text/javascript">
    $(document).ready(function() {
        $('select').niceSelect('destroy');


  // xử lý gọi huyện theo tỉnh thành
      $('#city').change(function(){
        var id_city=$(this).val();
      // gài trường hợp chọn về default  thì không hiển thị xã
       if(id_city==" "){
          $('#ward').html("<option value='"+"' >Chọn phường xã</option>");
      }
      // Bắt đầu gửi AJAX
        $.ajax({
            url: '{{route('user.profile.post') }}', // đường dẫn đến controller
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
            url: '{{route('admin.profile.post') }}', // đường dẫn đến controller
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

    $('#form').submit(function(){
        if($('#chitiet').val()!=""){
            if($('#ward').val()==""){
                $("#city").attr("required", true);
                $("#district").attr("required", true);
                $("#ward").attr("required", true);
                return false;
           }else{
            return true;
           }
        }

    });
});
</script>
@endsection
               