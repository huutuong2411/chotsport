@extends('admin.layout.main')

@section('title')
Thêm đơn nhập hàng
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Thêm đơn nhập hàng <a style="float:right;" href="{{route('admin.purchase')}}" class="btn btn-danger col-1"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></h1>
<div class="card shadow mb-4">

                        
                        @if ($errors->any())
                                    <div class="alert alert-danger">
                                       <ul>
                                        @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                        @endif

                        <form action="{{route('admin.purchase.store')}}" method="post" enctype="multipart/form-data" id="form">
                           @csrf
                                
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header text-primary font-weight-bold">Thông tin đơn nhập</div>
                                        <div class="card-body"> 
                                            <div class="receipt">
                                                    <div class="mb-3 row">
                                                        <div class="col-3">
                                                            <label class="text-primary" >Chọn nhà cung cấp: </label>
                                                                <select required class="form-select form-control" name="vendor" >
                                                                        <option value="">--Chọn--</option>  
                                                                    @foreach($vendor as $value)
                                                                        <option value="{{$value->id}}">{{$value->name}}</option>  
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                        <div class="col-2">
                                                            <label class="text-primary" >Chọn ngày nhập: </label>
                                                            <input required name="date" class="form-control" type="date" >
                                                        </div>  
                                                        <div class="col-2">
                                                            <label class="text-primary" >Tổng tiền thanh toán: </label>
                                                            <input readonly id="total_payment" name="total_payment" class="form-control" type="text" >
                                                        </div>       
                                                    </div>    
                                                    <hr class="primary"> 
                                                    <div class="card border-left-info addproduct">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-5">
                                                                    <label class="small mb-1">Chọn sản phẩm: </label>
                                                                        <select required class="form-select form-control product" name="product[]">
                                                                                <option value="">--Chọn--</option>  
                                                                            @foreach($product as $value)
                                                                                <option value="{{$value->id}}">{{$value->name}}</option>  
                                                                            @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-2">
                                                                    <label class="small mb-1" >Đơn giá</label>
                                                                    <input required name="price[]" class="form-control price" type="text" placeholder="Nhập giá sản phẩm" >
                                                                </div>
                                                                <div class="col-2">
                                                                    <label class="small mb-1">Số lượng tổng</label>
                                                                    <input name="total[]" class="form-control total" type="text" value="0"  readonly>
                                                                </div>
                                                                <div class="col-2">
                                                                    <label class="small mb-1">Tổng tiền</label>
                                                                    <input name="sum_money[]" class="form-control sum_money" type="text" value="0" readonly>
                                                                </div>
                                                                <div class="col-1">
                                                                    <label class="small mb-1"></label>
                                                                    <button class="btn btn-sm btn-danger form-control cancel" type="button">Huỷ bỏ</button>
                                                                </div>
                                                            </div>
                                                            <div class="col-2 table_size">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>  
                                                </div>     
                                            <hr>
                                                <button class="btn btn-success buttonadd" type="button">Thêm sản phẩm khác</button>
                                                <button class="btn btn-primary" type="submit">Lưu thông tin</button>
                                        </div>

                                    </div>
                        </form>                  
                        
                        

</div>


<script type="text/javascript">
 
    $(document).ready(function(){
    var firstAddProduct = $(".addproduct").first().clone(); //copy div addproduct để nếu cần sẽ add thêm
    // xử lý gọi size theo product
       $(document).on('change', '.product', function(){
            var $this = $(this); // tạo biến trung gian để lưu trữ đối tượng $('.product')
            var id_product=$(this).val();
            $.ajax({
                url: '{{route('admin.purchase.store') }}', // đường dẫn đến controller
                method: 'POST', // phương thức POST
                data: { // dữ liệu gửi đi
                    id_product: id_product, // giá trị id_brand
                    _token: '{{ csrf_token() }}' // token để bảo vệ form
                },
                success: function(data){ // nhận kết quả trả về
                    if(data != ""){
                    // xoá hết bảng cũ thêm bảng mới
                      $this.closest('.addproduct').find('.table_size').html("<table class='table-bordered'>"+
                                        "<thead>"+
                                            "<tr>"+
                                                "<th class='col-6'>size</th>"+
                                                "<th class='col-6'>số lượng</th>"+
                                            "</tr>"+
                                        "</thead>"+ 
                                        "<tbody>"+
                                        "</tbody>"+
                                    "</table>");
                    } else {
                         $('.table_size').html("");
                    }
                  $.each(data, function(index, size) {
                    $this.closest('.addproduct').find('.table_size').find('tbody').append("<tr>"+
                                                                "<td>"+size.size+"</td>"+
                                                                "<td >"+
                                                                "<input class='size_qty col-12' type='text' name='"+id_product+"_size_"+size.id+"'></td>" + 
                                                                "</tr>");
                  });

                }
            });  // dấu đóng AJAX
        
      });

      $('.buttonadd').click(function(){  //sự kiện click thêm sản phẩm
            var newAddProduct = firstAddProduct.clone();
            $(".receipt").append(newAddProduct); // Thêm div B sao chép vào div A
        });
       
        $(document).on('keyup', '.size_qty, .price', function() {  // gán sự kiện keyup cho class size_qty 
            var total = 0;
            var price = parseInt($(this).closest('.addproduct').find('.price').val()); price = isNaN(price) ? 0 : price; //lấy giá của sản
            $(this).closest('.addproduct').find('input.size_qty').each(function(){        
                var val = parseInt($(this).val());
                total += isNaN(val) ? 0 : val;
            });
            $(this).closest('.addproduct').find('.total').val(total); //gán total và input readonly
            
            $(this).closest('.addproduct').find('.sum_money').val(total*price); //gán sum_money và input readonly 
            var total_payment = 0; //tính tổng tiền thanh toán gán vào input
            $('input.sum_money').each(function() {
                var val = parseInt($(this).val());
                if (!isNaN(val)) {
                    total_payment += val;
                }
            });
            $('#total_payment').val(total_payment);
        });


        
        
        $(document).on('click','.cancel:not(:first)', function(){ // nút xoá sản 
            var deletemoney = parseInt($(this).closest('.addproduct').find('.sum_money').val());
            var oldpayment = parseInt($('#total_payment').val());
            $('#total_payment').val(oldpayment-deletemoney);
            $(this).closest('.addproduct').remove();
        });

        $('#form').submit(function(){
            var totalCount = 0;
            $('.addproduct').each(function() {
               if($(this).find('.total').val()==0){
                    totalCount++;
                }
              });
            if (totalCount!=0) {
                alert('Bạn phải nhập ít nhất 1 số lượng của size mỗi sản phẩm');
                return false;
              }
        });
// dấu đóng hàm ready
});

</script>
@endsection
         