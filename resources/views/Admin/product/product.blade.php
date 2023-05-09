@extends('admin.layout.main')

@section('title')
Quản lý sản phẩm
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý Sản phẩm</h1>
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
                          <div class="card-header text-primary font-weight-bold">Danh sách sản phẩm<a href="{{route('admin.product.trash')}}" class="btn btn-danger" style="float:right; margin-left:1%"><i class="fas fa-trash"></i> Thùng rác</a><a style="float:right" href="{{route('admin.product.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm sản phẩm</a></div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="dataTable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-1">ID</th>
                                            <th class="col-2">Tên sản phẩm</th>
                                            <th class="col-2">Hình ảnh</th>
                                            <th class="col-1">Giá</th>
                                            <th class="col-1">Giảm giá</th>
                                            <th class="col-1">Số lượng</th>
                                            <th class="col-1">Đánh giá</th>
                                            <th class="col-1">Đã bán</th>
                                            <th class="col-2" style="text-align: center">Thao tác</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach($product as $value)
                                        <tr>   
                                            <th scope="row">{{$value->id}}</th>
                                            <td>{{$value->name}}</td>
                                          
                                            <td><img style="max-width:100%;" src="{{asset('/admin/assets/img/product/'.$value->id.'/'.json_decode($value['image'])[0])}}"></td>
                                            <td>{{number_format($value->price, 0, ',', '.')}}</td>
                                            <td>{{$value->discount}}</td>
                                            <td>{{$value->total_qty}}</td>
                                            <td>*****</td>
                                            <td>XXXXX</td>
                                            <td style="text-align: center">
                                                <a href="{{route('admin.product.show',['id'=>$value->id])}}" class="btn btn-info btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-solid fa-eye"></i></a>
                                                <a href="{{route('admin.product.edit',['id'=>$value->id])}}" class="btn btn-warning btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="{{route('admin.product.delete',['id'=>$value->id])}}" class="btn btn-danger btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        {{$product->links('pagination::bootstrap-4')}}      
                            </div> 
                        </div>
                        
                        

</div>


@endsection
