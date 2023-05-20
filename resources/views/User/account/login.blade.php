@extends('User.layout.main')

@section('title')
Chotsport - Đăng nhập
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
                        <h3>Đăng nhập</h3>
                        <form action="{{route('user.login.post')}}" method="POST">
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
                                <label>Email của bạn <span>*</span></label>
                                <input name="email" type="email" required>
                            </div>
                            <div class="default-form-box">
                                <label>Mật khẩu <span>*</span></label>
                                <input name="password" type="password" required>
                            </div>
                            <div class="login_submit">
                                <label class="checkbox-default mb-4" for="offer" style="line-height: 1.5"> 
                                    <input name="remember_me" type="checkbox" id="offer">
                                    <span>Remember me</span>
                                </label>
                                <button class="btn btn-md btn-black-default-hover mb-4" type="submit">Đăng nhập</button>
                                
                            </div>
                        </form>
                    </div>
                </div>
                <!--login area start-->
            </div>
        </div>
    </div> <!-- ...:::: End Customer Login Section :::... -->

@endsection
               