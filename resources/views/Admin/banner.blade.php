@extends('admin.layout.main')

@section('title')
Quản lý bảng hiệu
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý bảng hiệu</h1>
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
                        <div class="row">
                        <div class="card col-xl-7">
                          <div class="card-header text-primary font-weight-bold">Danh sách bảng hiệu</div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="dataTable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nhãn hàng</th>
                                            <th>Hình ảnh</th>
                                            <th style="width:14%">Thao tác</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                      @foreach($banner as $value)
                                        <tr>
                                            <th scope="row" class="id">{{$value->id}}</th>
                                            <td class="brand_name">{{$value->brand_name}}</td>
                                            <td ><img style="max-width:100%;" src="{{asset('admin/assets/img/banner/'.$value->image)}}" alt=""></td>
                                            <td>
                                                <button href="#" class="btn btn-warning btn-circle btn-sm edit" ><i class="fas fa-pencil-alt"></i></button>
                                                <a href="{{route('admin.banner.delete',['id'=>$value->id])}}" class="btn btn-danger btn-circle btn-sm" style="margin-left:6%"><i class="fas fa-trash"></i></a>
                                            </td>  
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card col-xl-5">

                            <div class="card-header text-primary font-weight-bold" id="add_heading">Thêm bảng hiệu</div>  
                            <!--form thêm danh mục  -->
                            <div class="card-body" id="addbanner">
                              
                              <form action="{{route('admin.banner.add')}}" method="post" enctype="multipart/form-data">
                                 @csrf
                                <div class=" mb-3">
                                  <label class="small mb-1">Chọn nhãn hàng</label>
                                </div>
                                
                                <select name="brand">
                                  @foreach($brand as $value)
                                  <option value="{{$value->id}}">{{$value->name}}</option>
                                  @endforeach
                                </select>
                                <div class=" mb-3">
                                  <label class="small mb-1">Hình ảnh (đề xuất kích thước 1903 X 680)</label>
                                  <input class="form-control" type="file" name="image" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                
                              </form>
                            </div>
                            <!--đóng form thêm danh mục  -->

                            <div class="card-header text-warning font-weight-bold" id="edit_heading" style="display: none">Sửa nhãn hàng giày</div>  
                            <!-- form edit danh mục -->
                            <div class="card-body" id="editbanner" style="display: none">
                          
                              <form action="" method="post" enctype="multipart/form-data">
                                 @csrf
                                <div class=" mb-3">
                                  <label class="small mb-1">Chọn nhãn hàng</label>
                                </div>
                                <select name="brand" id="brand">
                                  @foreach($brand as $value)
                                  <option value="{{$value->id}}">{{$value->name}}</option>
                                  @endforeach
                                </select>
                                <div class=" mb-3">
                                  <label class="small mb-1">Hình ảnh</label>
                                  <img style="max-width:100%;" id="img" src="" alt="">
                                </div>
                                <div class=" mb-3">
                                  <label class="small mb-1">Hình ảnh mới (đề xuất kích thước 1903 X 680)</label>
                                  <input class="form-control" type="file" name="image" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Lưu</button>
                                <button type="button" class="btn btn-primary" id="add" style="margin-left:10%">Thêm mới nhãn hàng</button>
                              </form>
                            </div>
                            <!-- đóng form edit danh mục -->
                        </div>
                        </div>

</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(".edit").click(function() {
        $("#add_heading").hide();
        $("#addbanner").hide();
        $("#edit_heading").show();
        $("#editbanner").show(); 
        var brand= $(this).closest('tr').find('td.brand_name').text();
        var urlIMG = $(this).closest('tr').find('img').attr('src');
        var id = $(this).closest('tr').find('.id').text();
        $('#brand option').each(function() {
            if ($(this).text() == brand) {
              $(this).attr('selected', 'selected');
            } else {
              $(this).removeAttr('selected');
            }
        });
        $('#img').attr('src',urlIMG)
        $("#editbanner form").attr("action", "{{ url('admin/banner') }}/" + id + "/edit");
       
    });
    $("#add").click(function() {
      $("#edit_heading").hide();
      $("#editbanner").hide();
      $("#add_heading").show();
      $("#addbanner").show(); 
    });
  });

</script>

@endsection
