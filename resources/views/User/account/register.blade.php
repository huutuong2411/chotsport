@extends('User.layout.main')

@section('title')
Chotsport - Đăng ký
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
                <!--register area start-->
                <div class="col-lg-6 col-md-6 mx-auto">
                     
                    <div class="account_form register" data-aos="fade-up"  data-aos-delay="200">
                        <h3>Đăng ký tài khoản</h3>
                        <form action="{{route('user.register.post')}}" method="POST">
                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                            @endif
                            @csrf
                            <div class="default-form-box">
                                <label>Tên của bạn <span>*</span></label>
                                <input name="name" type="text" required>
                            </div>
                            <div class="default-form-box">
                                <label>Email address <span>*</span></label>
                                <input name="email" type="email" required>
                            </div>
                            <div class="default-form-box">
                                <label>Passwords <span>*</span></label>
                                <input name="password" type="password" required>
                            </div>
                            <div class="default-form-box">
                                <label>Nhập lại mật khẩu <span>*</span></label>
                                <input name="confirm_password" type="password" required>
                            </div>
                            <div class="login_submit">
                                <button class="btn btn-md btn-black-default-hover" type="submit">Đăng ký</button>
                            </div>
                        </form>
                            <div class="default-form-box">
                                <br>
                            <label>bạn đã có tài khoản? <a href="">Đăng nhập</a></label>
                            </div>
                    </div>
                </div>
                <!--register area end-->
            </div>
        </div>
    </div> <!-- ...:::: End Customer Login Section :::... -->

@endsection
               