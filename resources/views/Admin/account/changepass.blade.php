    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Đăng nhập-Admin</title>

        <!-- Custom fonts for this template-->
        <link href="{{asset('admin/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{asset('admin/assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
        <link rel="icon" href="{{asset('logo_chot.ico')}}" type="image/x-icon">

    </head>
    <body class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">ĐỔI MẬT KHẨU</h1>
                                        </div>
                                        <form  action="{{route('admin.changepass.post')}}" class="user" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label>Mật khẩu cũ</label>
                                                <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Mật khẩu" required>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label>Mật khẩu mới</label>
                                                <input type="password" name="new_password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Mật khẩu" required>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label>Nhập lại mật khẩu mới</label>
                                                <input type="password" name="re_password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Mật khẩu" required>
                                                
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Đổi</button>
                                            <hr>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScrip t-->
        <script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{asset('admin/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{asset('admin/assets/js/sb-admin-2.min.js')}}"></script>
    </body>
    </html>