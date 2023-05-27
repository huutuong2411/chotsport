@extends('admin.layout.main')

@section('title')
Chi tiết đơn hàng
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Thông tin đơn hàng </h1>
<div class="card shadow mb-4">
                         
                        <div class="card">
                          <div class="card-header text-primary font-weight-bold">Thông tin chi tiết đơn hàng<a style="float: right;" href="{{route('admin.order')}}" class="btn btn-danger"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></div>
                           <div class="card-body">
            <h6>Mã đơn hàng: {{$order->order_code}}</h6>
            <article class="card mb-4 py-3 border-left-info">
                <div class="card-body row">
                    <div class="col"> <strong>Ngày mua:</strong> <br>{{$order->created_at}}</div>
                    <div class="col"> <strong>Thôn tin nhận hàng</strong> <br> {{$order->name}} | <i class="fa fa-phone"></i> {{$order->phone}} </div>
                    <div class="col"> <strong>Trạng thái:</strong> <br> 
                                                @if($order->status==0)
                                                    <span class="badge badge-info">Chờ xác nhận</span>
                                                @elseif($order->status==1)
                                                    <span class="badge badge-warning">Đã xác nhận</span>
                                                @elseif($order->status==2)
                                                    <span class="badge badge-success">Đã nhận hàng</span>
                                                @elseif($order->status==3)
                                                    <span class="badge badge-danger">Đã huỷ</span>
                                                @endif
                    </div>
                    <div class="col"> <strong>Phương thức thanh toán:</strong> <br> {{$order->payment_status==0?'Thanh toán sau khi nhận hàng':'Thanh toán online (đã thanh toán)'}} </div>
                    <div class="col"> <strong>Tổng tiền:</strong> <br> {{number_format($order->sum_money, 0, '.', ',')}}đ </div>
                </div>
                <div class="card-body row">
                    <div class="col-12"> <strong>Địa chỉ nhận hàng:</strong>  {{$full_address}} </div>
                    <div class="col-12"> <strong>Ghi chú:</strong>{{$order->note}} </div>
                </div>
            </article>
            <hr>
            <ul class="row">
               
                @foreach($orderDetail as $value)
                <li class="col-md-6">
                    <div class="row col-12">
                        <div class="col-4">
                            <label><img src="{{asset('/admin/assets/img/product/'.$value->id_product.'/'.json_decode($value->image)[0])}}" style="width:66%"><span>× {{$value->qty}}</span></label>
                        </div>
                        <div class="col-8" style="padding:0">
                             {{$value->product_name}}
                            <br>
                            <span style="font-size: 13px">Kích thước:{{$value->size_name}}</span>
                            <br>
                            <span>{{number_format($value->price, 0, '.', ',')}}đ</span>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <hr>
            
        </div>     
                        </div>

</div>
        



@endsection
