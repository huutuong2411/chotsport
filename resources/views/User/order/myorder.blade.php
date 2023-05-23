@extends('User.layout.main')

@section('title')
Chotsport - Thanh toán đơn hàng
@endsection

@section('content')
<div class="breadcrumb-nav p-3 mb-2 text-dark" style="background-color:#e1e3e8!important;padding: 3px 20px!important; margin-bottom: 50px!important">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li class="active" aria-current="page">Tài khoản</li>
                                    <li class="active" aria-current="page">Đơn hàng</li>
                                </ul>
                            </nav>
</div>
						



<div class="cart-section" style="margin: 7% 0">
        <!-- Start Cart Table -->
        <div class="cart-table-wrapper"  data-aos="fade-up"  data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
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
                        <div class="table_desc">
                            <div class="table_page table-responsive">
                                <table>
                                    <!-- Start Cart Table Head -->
                                    <thead>
                                        <tr>
                                            <th class="col-1">STT</th>
                                            <th class="col-1">Mã đơn hàng</th>
                                            <th class="">Tên người nhận</th>
                                            <th class="">Ngày mua</th>
                                            <th class="">Tổng tiền</th>
                                            <th class="">Trạng thái</th>
                                            <th class="col-3">Thao tác</th>
                                        </tr>
                                    </thead> <!-- End Cart Table Head -->
                                    <tbody>
                                    @if(!empty($order))
                                    	@foreach($order as $key => $value)
                                        <tr>
                                            <td class="">{{$key+1}}</td>
                                            <td class="">{{$value->order_code}}</td>
                                            <td class="">{{$value->name}}</td>
                                            <td class="">{{$value->created_at}}</td>
                                            <td class="">{{number_format($value->sum_money, 0, '.', ',')}}đ</td>
                                            <td class="">
                                            	@if($value->status==0)
                                            		<span class="badge badge-info">Chờ xác nhận</span>
                                            	@elseif($value->status==1)
                                            		<span class="badge badge-warning">Đã xác nhận</span>
                                            	@elseif($value->status==2)
                                            		<span class="badge badge-success">Đã nhận hàng</span>
                                            	@elseif($value->status==3)
                                            		<span class="badge badge-danger">Đã huỷ</span>
                                            	@endif
                                            </td>
                                            <td class="text-align">
                                            	<a href="{{route('user.order.show',['id'=>$value->id])}}" class="btn btn-md btn-golden">Chi tiết</a>
                                            	@if($value->status!=3)
                                            	<a href="{{route('user.order.cancel',['id'=>$value->id])}}" class="btn btn-danger" style="color:white">hủy đơn hàng</a>
                                            	@endif
                                            </td>
                                        </tr> 
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_submit">
                                <a href="{{route('user.home')}}" style="color: #b1935e; text-decoration: underline;">Tiếp tục mua sắm</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Cart Table -->

    </div> <!-- ...:::: End Cart Section:::... -->

@endsection
           


