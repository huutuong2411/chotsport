@extends('admin.layout.main')

@section('title')
Quản lý đơn hàng
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý đơn hàng</h1>
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
                          <div class="card-header text-primary font-weight-bold">Danh sách đơn hàng</div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="mytable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-1" style="display: none">id</th>
                                            <th  class="col-1">Mã đơn hàng</th>
                                            <th class="col-1">Khách hàng</th>
                                            <th class="col-1">Số điện thoại</th>
                                            <th class="col-2">Phương thức thanh toán</th>
                                            <th class="col-1">Trạng thái</th>
                                            <th class="col-1">Ngày đặt</th>
                                            <th class="col-1">Tổng tiền</th>
                                            <th class="col-2" style="text-align: center;">Xử lý</th>
                                            <th class="col-1" style="text-align: center">Chi tiết</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                      @foreach($order as $value)  
                                        <tr>   
                                            <td class="name" style="display: none">{{$value->id}}</td>
                                            <th scope="row" >{{$value->order_code}}</th>
                                            <td class="name">{{$value->name}}</td>
                                            <td class="name">{{$value->phone}}</td>
                                            <td class="name">{{$value->payment_status==0?"Thanh toán sau khi nhận hàng":"Thanh toán online"}}</td>
                                            <td class="name">
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
                                            <td class="name">{{$value->created_at}}</td>
                                            <td class="name">{{number_format($value->sum_money, 0, '.', ',')}}</td>
                                            <td class="name">
                                                <form action="{{route('admin.order.change',['id'=>$value->id])}}" method="post">
                                                    @csrf
                                                        <select class="form-select form-control" name="status" id="speed" onchange="this.form.submit()">
                                                            <option class="btn btn-info"  value="0" {{$value->status==0?'selected':''}}>Chờ xác nhận</option>
                                                            <option class="btn btn-warning"  value="1" {{$value->status==1?'selected':''}}>Xác nhận đơn hàng</option>
                                                            <option class="btn btn-danger"  value="3" {{$value->status==3?'selected':''}}>Huỷ đơn hàng</option>
                                                            <option class="btn btn-success"  value="2" {{$value->status==2?'selected':''}}>Đã giao hàng</option>
                                                        </select>
                                                </form>
                                            </td>
                                           
                                            <td style="text-align: center">
                                                <a href="{{route('admin.orderdetail',['id'=>$value->id])}}" class="btn btn-info btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                        
                        

</div>


<script>
    $(document).ready(function() {
        $('#mytable').dataTable( {
            // Cấu hình DataTables
            order: [[0, 'desc']], // Sắp xếp giảm dần theo cột đầu tiên
        });
    });
</script>
@endsection