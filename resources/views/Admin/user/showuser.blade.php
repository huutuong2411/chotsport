@extends('admin.layout.main')

@section('title')
Thông tin người dùng
@endsection

@section('content')
    
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Thông tin người dùng</h1>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                        {{session('success')}}
            </div>
         @endif
<div class="card shadow mb-4">
                        <div class="card">
                          <div class="card-header text-primary font-weight-bold">Thông tin người dùng<a style="float: right;" href="{{ URL::previous() }}" class="btn btn-danger"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></div>
                            <div class="card-body">
                                <div class="row">
                                <div class="col-xl-4">
                                    <!-- Profile picture card-->
                                    <div class="card mb-4 mb-xl-0">
                                        <div class="card-header text-primary font-weight-bold">Ảnh đại diện</div>
                                        <div class="card-body text-center">
                                            <!-- Profile picture image-->
                                        @if(!empty($user->avatar))
                                            @if($user->id_role==1)
                                               <img style="width:80%; height:80% " class="img-account-profile rounded-circle mb-2" src="{{asset('admin/assets/img/user/'.$user->avatar)}}" alt="">
                                            @else
                                                <img style="width:80%; height:80% " class="img-account-profile rounded-circle mb-2" src="{{asset('user/assets/images/user/'.$user->avatar)}}" alt="">
                                            @endif
                                        @endif
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
                                                    <label class="small mb-1" for="inputUsername">Tên:</label>
                                                    <input readonly  class="form-control" id="inputUsername" type="text" placeholder="Tên của bạn" value="{{$user->name}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputUsername">Email</label>
                                                    <input readonly  class="form-control" id="inputUsername" type="email"  value="{{$user->email}}">
                                                </div>
                                                 <!-- Form Group (email address)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputEmailAddress">Số điện thoại</label>
                                                    <input readonly  class="form-control" id="inputEmailAddress" type="text" placeholder="Số điện thoại của bạn" value="{{$user->phone}}">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label class="small mb-1">Địa chỉ đã lưu</label>
                                                    <input readonly  class="form-control" type="text" readonly value="{{$full_address}}">
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

</div>
@endsection
