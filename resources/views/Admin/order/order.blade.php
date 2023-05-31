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
                                            <th class="col-1" style="text-align: center;">Trạng thái</th>
                                            <th class="col-1">Ngày đặt</th>
                                            <th class="col-1">Tổng tiền</th>
                                            <th class="col-2" style="text-align: center;">Xử lý</th>
                                            <th class="col-1" style="text-align: center">Chi tiết</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                      @foreach($order as $value)  
                                        <tr>   
                                            <td class="id_order" style="display: none">{{$value->id}}</td>
                                            <th scope="row" >{{$value->order_code}}</th>
                                            <td class="name">{{$value->name}}</td>
                                            <td class="name">{{$value->phone}}</td>
                                            <td class="name">{{$value->payment_status==0?"Thanh toán sau khi nhận hàng":"Thanh toán online"}}</td>
                                            <td class="name" style="text-align: center;">
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
                                            <td class="name"><span style="display: none">{{$value->created_at}}</span>{{date('d/m/Y', strtotime($value->created_at))}}</td>
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
                                                <a type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-info btn-circle btn-sm showorder" style="margin-left:2%"><i class="fas fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                        
</div>
<div class="modal bd-example-modal-lg" id="showdetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style='max-width: 80%;'>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Chi tiết đơn hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $('#mytable').dataTable( {
            order: [[0, 'desc']],
            "aLengthMenu": [[5,10,20,50,-1], [5,10,20,50, "All"]],
            "pageLength": 5,
            "language": {
            "lengthMenu": "Hiển thị _MENU_ hàng",
            "zeroRecords": "Nothing found - sorry",
            "info": "Trang _PAGE_ của _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
           "search":         "Tìm kiếm:",
           "paginate": {
                    "first":      "First",
                    "last":       "Last",
                    "next":       ">",
                    "previous":   "<"
                },
            },
            } );


         //xử lý show order_detail
    $('.showorder').click(function(){
        var id_order=$(this).closest('tr').find('td.id_order').text();
        // Bắt đầu gửi AJAX
        $.ajax({
            url:"{{ route('admin.order') }}" + '/' + id_order,
            method: 'GET', // phương thức GET
            data: { // dữ liệu gửi đi
               
            },
            success: function(data){ // nhận kết quả trả về
                console.log(data);
                if(data != ""){
                    var status="";
                    if(data.order.status==0){
                        status="<span class='badge badge-info'>Chờ xác nhận</span>";
                    }else if(data.order.status==1) {
                        status="<span class='badge badge-warning'>Đã xác nhận</span>";
                    }else if(data.order.status==2) {
                        status="<span class='badge badge-success'>Đã nhận hàng</span>";
                    }else if(data.order.status==3) {
                        status="<span class='badge badge-danger'>Đã huỷ</span>";
                    }                          
                    var date = moment(data.order.created_at).format('DD/MM/YYYY'); // định dạng lại ngày
                    var sum_money = data.order.sum_money.toLocaleString('en-US');
                    var note = data.order.note !== null ? data.order.note : "Không";
                    var payment_status= data.order.payment_status==0? "Thanh toán sau khi nhận hàng":"Thanh toán online (đã thanh toán)";
                    $('#showdetail').find('.modal-body').html(
                        "<div class='card shadow mb-4'>"+
                            "<div class='card'>"+
                                "<div class='card-body'>"+
                                    "<h6>Mã đơn hàng:"+data.order.order_code+"</h6>"+
                                    "<article class='card mb-4 py-3 border-left-info'>"+
                                        "<div class='card-body row'>"+
                                            "<div class='col'> <strong>Ngày mua:</strong><br>"+date+"</div>"+
                                            "<div class='col'> <strong>Thôn tin nhận hàng</strong> <br>"+data.order.name+"  | <i class='fa fa-phone'></i>"+data.order.phone+"</div>"+
                                            "<div class='col'> <strong>Trạng thái:</strong> <br>"+
                                                status+
                                            "</div>"+
                                            "<div class='col'> <strong>Phương thức thanh toán:</strong> <br>"+payment_status+"</div>"+
                                            "<div class='col'> <strong>Tổng tiền:</strong> <br>"+sum_money+"đ</div>"+
                                        "</div>"+
                                        "<div class='card-body row'>"+
                                            "<div class='col-12'> <strong>Địa chỉ nhận hàng:</strong>"+data.full_address+"</div>"+
                                            "<div class='col-12'> <strong>Ghi chú:</strong> "+note+"</div>"+
                                        "</div>"+
                                    "</article>"+
                                    "<hr>"+
                                    "<ul class='row' style='list-style-type:none;'>"+
                                    "</ul>"+
                                   "<hr>"+
                               "</div>"+     
                           "</div>"+
                       "</div>"
                        );
                    $.each(data.orderDetail, function(key, value) {
                        var price = value.price.toLocaleString('en-US');
                        var image = JSON.parse(value.image);
                        var URL="{{url('admin/assets/img/product/')}}"+"/"+value.id_product+"/"+image[0];
                            $('#showdetail').find('.modal-body').find('ul.row').append(
                                "<li class='col-md-6'>"+
                                            "<div class='row col-12'>"+
                                                "<div class='col-4'>"+
                                                    "<label><img src='"+URL+"' style='width:66%'><span>×"+value.qty+" </span></label>"+
                                                "</div>"+
                                                "<div class='col-8' style='padding:0'>"+value.product_name+
                                                   "<br>"+
                                                   "<span style='font-size: 13px'>Kích thước:"+value.size_name+"</span>"+
                                                   "<br>"+
                                                   "<span>"+price+"</span>"+
                                               "</div>"+
                                           "</div>"+
                                       "</li>"
                                );
                    
                    });
                }
               
            }
        }); // đấu đóng ajax
        
    });


    }); // đóng hàm ready
</script>
@endsection
