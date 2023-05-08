@extends('admin.layout.main')

@section('title')
Chi tiết sản phẩm
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Chi tiết sản phẩm<a style="float:right;" href="{{route('admin.product')}}" class="btn btn-danger col-1"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></h1>
                        @if ($errors->any())
                                    <div class="alert alert-danger">
                                       <ul>
                                        @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                        @endif   
<div class="card shadow mb-4">
                        
                        
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header text-primary font-weight-bold">Chi tiết sản phẩm</div>
                                        <div class="card-body"> 
                                                    <label class="small mb-1 font-weight-bold" >Tên sản phẩm:</label>
                                                    <label class="font-weight-bold" >{{$product->name}}</label>
                                                <div class="mb-3">  
                                                    <label class="small mb-1 font-weight-bold" >Danh mục: </label>
                                                    <label >{{$category}}</label>    
                                                    <label style="margin-left: 5%" class="small mb-1 font-weight-bold">Nhãn hàng: </label>
                                                    <label >{{$brand}}</label>    
                                                </div>
                                                <div class="mb-3">
                                                    @foreach(json_decode($product->image) as $value)
                                                    <img class="col-2" src="{{asset('/admin/assets/img/product/'.$product->id.'/'.$value)}}">
                                                    @endforeach
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1 font-weight-bold">Giá: </label>
                                                    <label>{{number_format($product->price, 0, ',', '.')}}</label>   
                                                    <label style="margin-left: 5%" class="small mb-1 font-weight-bold">Giảm giá: </label>
                                                    <label >{{$product->discount}}</label>
                                                    <label style="margin-left: 5%" class="small mb-1 font-weight-bold">Số lượng: </label>
                                                    <label >{{$product->total_qty}}</label>     
                                                </div>
                                                @if($listsize->count() > 0)
                                                <div class="mb-3">  
                                                    <label class="small mb-1 font-weight-bold">Số lượng chi tiết: </label>
                                                    @foreach ($listsize as $value)
                                                    <label style="margin-left:1.5%" class="font-weight-bold">size {{$value->size}}: </label>
                                                    <label>{{$value->size_qty}} </label>
                                                    @endforeach
                                                </div>
                                                @endif
                                                <div class="mb-3">
                                                    <label class="small mb-1 font-weight-bold">Mô tả: </label>
                                                    @if($product->description)
                                                    <div class="card-body small" style="overflow: hidden;">
                                                    {!!$product->description!!}
                                                    </div>
                                                    @else 
                                                        Chưa có mô tả
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                     
                        

</div>


@endsection
         