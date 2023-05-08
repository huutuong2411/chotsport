@extends('admin.layout.main')

@section('title')
Quản lý bài viết
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý bài viết</h1>
        @if(session('delete'))
            <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              {{session('delete')}}
            </div>
        @endif
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
<div class="card shadow mb-4">
                        
                        <div class="card">
                          <div class="card-header text-primary font-weight-bold">Danh sách bài viết <a style="float:right" href="{{route('admin.blog.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm bài viết</a></div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="dataTable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th  style="width:3%">ID</th>
                                            <th class="col-3">Tiêu đề</th>
                                            <th class="col-6">Mô tả</th>
                                            <th class="col-1">Ngày cập nhật</th>
                                            <th class="col-2">Thao tác</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach($infor as $value)
                                        <tr>   
                                            <th scope="row">{{$value->id}}</th>
                                            <td class="name">{{$value->title}}</td>
                                            <td class="name">{{$value->description}}</td>
                                            <td class="name">{{$value->updated_at}}</td>
                                            <td>
                                                <a href="{{route('admin.blog.show',['id'=>$value->id])}}" class="btn btn-info btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-solid fa-eye"></i></a>
                                                <a href="{{route('admin.blog.edit',['id'=>$value->id])}}" class="btn btn-warning btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="{{route('admin.blog.delete',['id'=>$value->id])}}" class="btn btn-danger btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach                   
                                    </tbody>
                                </table>
                                {{$infor->links('pagination::bootstrap-4')}}
                            </div> 
                        </div>
                        
                        

</div>


@endsection
