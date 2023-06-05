@extends('admin.layout.main')

@section('title')
Không tìm thấy trang - 404
@endsection

@section('content')
  <div class="text-center">
                        <div class="error mx-auto" data-text="404">404</div>
                        <p class="lead text-gray-800 mb-5">Không tìm thấy trang</p>
                        <p class="text-gray-500 mb-0">Có vẻ như bạn không có quyền truy cập vào đường dẫn này</p>
                        <a href="{{route('admin.dashboard')}}">&larr; Trở về trang chủ</a>
  </div>


@endsection
