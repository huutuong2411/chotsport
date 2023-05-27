@extends('User.layout.main')

@section('title')
Chotsport - Thanh toán đơn hàng
@endsection

@section('content')
<div class="breadcrumb-nav p-3 mb-2 text-dark" style="background-color:#e1e3e8!important;padding: 3px 20px!important; margin-bottom: 50px!important">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li class="active" aria-current="page">Trang chủ</li>
                                    <li class="active" aria-current="page">Chi tiết đơn hàng</li>
                                </ul>
                            </nav>
</div>


<div class="container">
    <article class="card">
        <header class="card-header"> Chi tiết đơn hàng </header>
        <div class="card-body">
            <h6>Mã đơn hàng: {{$order->order_code}}</h6>
            <article class="card">
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
                    <div class="col-12"> <strong>Ghi chú:</strong>  {{$order->note}} </div>
                </div>
            </article>
            @if($order->status==0||$order->status==1||$order->status==2)
            <div class="track mx-auto" style="width: 90%">
                <div class="{{$order->status==0||$order->status==1||$order->status==2?'step active':'step'}}"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Chờ xác nhận</span> </div>
                <div class="{{$order->status==1||$order->status==2?'step active':'step'}}"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Đã xác nhận </span> </div>
                <div class="{{$order->status==2?'step active':'step'}}"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Đã nhận hàng</span> </div>
            </div>
            @endif
            
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
            <a href="{{route('user.order')}}" class="btn btn-md btn-golden" data-abc="true"> <i class="fa fa-chevron-left"></i> Danh sách đơn hàng</a>
        </div>
    </article>
</div>
@endsection
           


