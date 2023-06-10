@extends('Admin.layout.main')

@section('title')
Thêm sản phẩm
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Thêm sản phẩm <a style="float:right;" href="{{route('admin.product')}}" class="btn btn-danger col-1"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></h1>
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

                        <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data" id="form">
                           @csrf
                                
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header text-primary font-weight-bold">Thông tin sản phẩm</div>
                                        <div class="card-body"> 
                                                <div class="mb-3">
                                                    <label class="small mb-1" >Tên sản phẩm</label>
                                                    <input required name="name" class="form-control" type="text" placeholder="Nhập tên sản phẩm" value="">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1">Hình ảnh</label>
                                                    <input required name="image[]" class="form-control col-3" id="inputUsername" type="file"  multiple>
                                                </div>
                                                <div class="mb-3">  
                                                    <label class="small mb-1" >Danh mục: </label>
                                                        <select required class="form-select" name="category" >
                                                                <option value="">--Chọn--</option>  
                                                            @foreach($category as $value)
                                                                <option value="{{$value->id}}">{{$value->name}}</option>  
                                                            @endforeach
                                                        </select>
                                                    <label style="margin-left: 5%" class="small mb-1">Nhãn hàng: </label>
                                                        <select required class="form-select" name="brand" id="brand">
                                                                <option value="">--Chọn--</option>  
                                                            @foreach($brand as $value)
                                                                <option value="{{$value->id}}">{{$value->name}}</option>  
                                                            @endforeach
                                                        </select>
                                                </div>
                                                <div class="col-4" id="table_size">
                                                    
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1" >Giá</label>
                                                    <input required name="price" class="form-control" type="text" placeholder="Nhập giá sản phẩm" >
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1" >Giảm giá (%):</label>
                                                    <select id="sale" name="" >
                                                        <option value="no">Không</option>  
                                                        <option value="yes">Có</option>
                                                    </select>
                                                    <input style="display:none" id="discount" name="discount" class="form-control" type="text" placeholder="Nhập phần trăm giảm giá" >
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1">Số lượng</label>
                                                    <input name="total" class="form-control" type="text" value="0"  id="total" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputUsername">Mô tả</label>
                                                    <textarea name="description" id="editor"></textarea>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Thêm</button>
                                            
                                        </div>
                                    </div>
                        </form>                  
                        
                        

</div>

<script src="{{asset('ckeditor5/ckeditor.js')}}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>


<script type="text/javascript">
    $(document).ready(function(){
    // xử lý gọi size theo brand
       $('#brand').change(function(){
        var id_brand=$(this).val();
        $.ajax({
            url: '{{route('admin.product.store') }}', // đường dẫn đến controller
            method: 'POST', // phương thức POST
            data: { // dữ liệu gửi đi
                id_brand: id_brand, // giá trị id_brand
                _token: '{{ csrf_token() }}' // token để bảo vệ form
            },
            success: function(data){ // nhận kết quả trả về
                if(data != ""){
                // xoá hết bảng cũ thêm bảng mới
                  $('#table_size').html("<table class='table table-bordered'>"+
                                    "<thead>"+
                                        "<tr>"+
                                            "<th class='col-5'>size</th>"+
                                            "<th class='col-7'>số lượng <button class='btn-outline-dark' type='button' style='float:right' id='none_qty'>Chưa có sẵn</button></th>"+
                                        "</tr>"+
                                    "</thead>"+ 
                                    "<tbody>"+
                                    "</tbody>"+
                                "</table>");
                } else {
                     $('#table_size').html("");
                }
              $.each(data, function(index, size) {
                $('#table_size').find('tbody').append("<tr>"+
                                                            "<td>"+size.size+"</td>"+
                                                            "<td >"+
                                                            "<input class='size_qty col-10' type='text' name='size_qty_"+size.id+"'></td>" + 
                                                            "</tr>");
              });

            }
        });  // dấu đóng AJAX
        
      });

       $('#sale').change(function(){                //sự kiện chọn sale hay không
            if($(this).val()=="yes"){
                $('#discount').show();
                $("#discount").attr("required", true);
            }
            else{
                $("#discount").attr("required", false);
                $('#discount').hide();
            }
       })

        $(document).on('click', '#none_qty', function() {  // gán sự kiện button chưa nhập hàng
            $('#table_size').html("");
            $('#total').val(0);
        });

        $(document).on('keyup', '.size_qty', function() {  // gán sự kiện keyup cho class size_qty 
            var total = 0;
            $('input.size_qty').each(function(){        
                 var val = parseInt($(this).val());
                total += isNaN(val) ? 0 : val;
            });
            $('#total').val(total); //gán total và input readonly
        });
              
// dấu đóng hàm ready
});

</script>
@endsection
         