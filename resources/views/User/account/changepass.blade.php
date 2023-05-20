@extends('User.layout.main')

@section('title')
Chotsport - Đổi mật khẩu
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
<!-- ...:::: Start Customer Login Section :::... -->
     <div class="customer-login" style="margin: 130px 0">
        <div class="container">
            <div class="row">
                <!--login area start-->
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="account_form" data-aos="fade-up"  data-aos-delay="0">
                        <h3>Thay đổi mật khẩu</h3>
                        <form action="{{route('user.changepass.post')}}" method="POST">
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
                            @csrf
                            <div class="default-form-box">
                                <label>Mật khẩu cũ <span>*</span></label>
                                <input name="password" type="password" required>
                            </div>
                            <div class="default-form-box">
                                <label>Mật khẩu mới <span>*</span></label>
                                <input name="new_password" type="password" required>
                            </div>
                            <div class="default-form-box">
                                <label>Xác nhập lại mật khẩu mới <span>*</span></label>
                                <input name="re_password" type="password" required>
                            </div>
                            <div class="login_submit">
                                <button class="btn btn-md btn-black-default-hover mb-4" type="submit">Đổi mật khẩu</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--login area start-->
            </div>
        </div>
    </div> <!-- ...:::: End Customer Login Section :::... -->

@endsection
               