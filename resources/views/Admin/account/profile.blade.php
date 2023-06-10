@extends('Admin.layout.main')
@section('title')
Thông tin cá nhân
@endsection

@section('content')
	

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Thông tin tài khoản</h1>

<!-- form -->
<div class="container-xl px-4 mt-4">
                        <!-- Account page navigation-->
                        <hr class="mt-0 mb-4">
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
                        <form action="{{route('admin.profile.post')}}" method="post" enctype="multipart/form-data" id="form">
                           @csrf
                            <div class="row">
                                <div class="col-xl-4">
                                    <!-- Profile picture card-->
                                    <div class="card mb-4 mb-xl-0">
                                        <div class="card-header text-primary font-weight-bold">Ảnh đại diện</div>
                                        <div class="card-body text-center">
                                            <!-- Profile picture image-->
                                            @if(Auth::user()->avatar)
                                            <img style="width:80%; height:80% " class="img-account-profile rounded-circle mb-2" src="{{asset('admin/assets/img/user/'.Auth::user()->avatar)}}" alt="">
                                            @else
                                            <img style="width:80%; height:80% " src="{{asset('/user/assets/images/user/userdefault.webp')}}" >
                                            @endif
                                            
                                            <!-- Profile picture help block-->
                                            <div class="small font-italic text-muted mb-4">Hình ảnh phải nhỏ hơn 2MB</div>
                                            <!-- Profile picture upload button-->
                                            <input type="file" name="avatar" class="form-control form-control-line">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header text-primary font-weight-bold">Thông tin tài khoản</div>
                                        <div class="card-body">
                                            
                                                <!-- Form Group (username)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputUsername">Tên của bạn</label>
                                                    <input name="name" class="form-control" id="inputUsername" type="text" placeholder="Tên của bạn" value="{{Auth::user()->name}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputUsername">Email</label>
                                                    <input readonly name="email" class="form-control" id="inputUsername" type="email"  value="{{Auth::user()->email}}">
                                                </div>
                                                 <!-- Form Group (email address)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputEmailAddress">Số điện thoại</label>
                                                    <input name="phone" class="form-control" id="inputEmailAddress" type="text" placeholder="Số điện thoại của bạn" value="{{Auth::user()->phone}}">
                                                </div>
                                                @if(Auth::user()->id_address)
                                                <div class="mb-3">
                                                    <label class="small mb-1">Địa chỉ đã lưu</label>
                                                    <input name="full_address" class="form-control" type="text" readonly value="{{$full_address}}">
                                                </div>
                                                @endif
                                                
                                                <!-- Form Row        -->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (organization name)-->
                                                    <label class="small col-md-12" for="inputOrgName">Chọn địa chỉ</label>
                                                    <div class="col-md-4">
                                                        <select {{ $full_address ? '' : 'required' }} class="form-control  form-select-sm mb-3" id="city" aria-label=".form-select-sm" name="city"  >
                                                            <option value="" >Chọn tỉnh thành</option>   
                                                          @foreach($city as $value)       
                                                           <option value="{{$value->id}}">{{$value->name}}</option>
                                                          @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- Form Group (location)-->
                                                    <div class="col-md-4">
                                                        <select class="form-control form-select-sm mb-3" id="district" aria-label=".form-select-sm" name="district" {{ $full_address ? '' : 'required' }}>
                                                        <option value="" >Chọn quận huyện</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                       <select class="form-control  form-select-sm"  aria-label=".form-select-sm" id="ward" name="ward" {{ $full_address ? '' : 'required' }}>
                                                        <option  value="">Chọn phường xã</option>
                                                        </select>
                                                    </div>    
                                                </div>
                                                <div class=" mb-3">
                                                    <label class="small mb-1" >Địa chỉ chi tiết</label>
                                                    <input {{ Auth::user()->id_address ? '' : 'required' }}  class="form-control" id="chitiet" type="text" name="chitiet"  value="">
                                                </div>   
                                                <!-- Form Row-->
                                                <!-- Save changes button-->
                                                <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
</div>


<script type="text/javascript">
    $(document).ready(function(){
      // xử lý gọi huyện theo tỉnh thành
      $('#city').change(function(){
        var id_city=$(this).val();
      // gài trường hợp chọn về default  thì không hiển thị xã
       if(id_city==" "){
          $('#ward').html("<option value='"+"' >Chọn phường xã</option>");
      }
      // Bắt đầu gửi AJAX
        $.ajax({
            url: '{{route('admin.profile.post') }}', // đường dẫn đến controller
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
        
       
      });

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

// dấu đóng hàm ready
});






</script>



<!-- end -->
@endsection
    
 
