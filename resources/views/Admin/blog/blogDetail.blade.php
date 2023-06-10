@extends('Admin.layout.main')

@section('title')
Chi tiết bài viết
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Chi tiết bài viết </h1>

        
<div class="card shadow mb-4">
    <a style="margin-left:1%" href="{{route('admin.blog')}}" class="btn btn-danger col-1"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a>
           <div class="card-body">
            
                        <h1>{{$infor->title}}</h1>
                        {{$infor->updated_at}}
                        {!!$infor->content!!}
            </div>        
</div>


@endsection
