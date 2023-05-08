@extends('admin.layout.main')

@section('title')
Sản phẩm-thùng rác
@endsection

@section('content')
	
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Sản phẩm - thùng rác<a style="float:right;" href="{{route('admin.product')}}" class="btn btn-sm btn-danger"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></h1>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                        {{session('success')}}
            </div>
         @endif
<div class="card shadow mb-4">
                        
                        <div class="card">
                          <div class="card-header text-primary font-weight-bold">Danh sách sản phẩm đã xoá</div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="dataTable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-1">ID</th>
                                            <th class="col-2">Tên sản phẩm</th>
                                            <th class="col-2">Hình ảnh</th>
                                            <th class="col-2">Giá</th>
                                            <th class="col-1">Giảm giá</th>
                                            <th class="col-1">Số lượng</th>
                                            <th class="col-1">Đã bán</th>
                                            <th class="col-2">Thao tác</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach($trash as $value)
                                        <tr>   
                                            <th scope="row">{{$value->id}}</th>
                                            <td>{{$value->name}}</td>
                                          
                                            <td><img style="max-width:100%;" src="{{asset('/admin/assets/img/product/'.$value->id.'/'.json_decode($value['image'])[0])}}"></td>
                                            <td>{{number_format($value->price, 0, ',', '.')}}</td>
                                            <td>{{$value->discount}}</td>
                                            <td>{{$value->total_qty}}</td>
                                            <td>XXXXX</td>
                                            <td>
                                               <a href="{{route('admin.product.restore',['id'=>$value->id])}}" class="btn btn-warning"><i class="fas fa-retweet"></i> Khôi phục</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                              
                            </div> 
                        </div>

</div>
@endsection
