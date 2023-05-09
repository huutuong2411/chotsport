@extends('admin.layout.main')

@section('title')
Quản lý nhà cung cấp
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý nhà cung cấp</h1>
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
                        <div class="card col-xl-8">
                          <div class="card-header text-primary font-weight-bold">Danh sách nhà cung cấp<a href="{{route('admin.vendor.trash')}}" class="btn btn-danger" style="float:right"><i class="fas fa-trash"></i> Thùng rác</a></div>
                            <div>
                                <table class="table table-bordered" id="dataTable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-1">ID</th>
                                            <th class="col-3">Tên</th>
                                            <th class="col-2">Số điện thoại</th>
                                            <th class="col-4">Email</th>
                                            <th class="col-2" style="text-align: center">Thao tác</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach($vendor as $value)
                                        <tr>
                                            <th scope="row" class="id">{{$value->id}}</th>
                                            <td class="name">{{$value->name}}</td>
                                            <td class="phone">{{$value->phone}}</td>
                                            <td class="email">{{$value->email}}</td>
                                            <td style="text-align: center">
                                                <button href="" class="btn btn-warning btn-circle btn-sm edit" ><i class="fas fa-pencil-alt"></i></button>
                                                <a href="{{route('admin.vendor.delete',['id'=>$value->id])}}" class="btn btn-danger btn-circle btn-sm" style="margin-left:10%"><i class="fas fa-trash"></i></a>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card col-xl-4">
                            <div class="card-header text-primary font-weight-bold" id="add_heading">Thêm nhà cung cấp</div>  
                            <!--form thêm danh mục  -->
                            <div class="card-body" id="addvendor">
                              <form action="{{route('admin.vendor.add')}}" method="post">
                                 @csrf
                                <div class=" mb-3">
                                  <label class="small mb-1">Tên nhà cung cấp</label>
                                  <input class="form-control" type="text" name="name" value="" required>
                                </div>
                                <div class=" mb-3">
                                  <label class="small mb-1">Số điện thoại</label>
                                  <input class="form-control" type="text" name="phone" value="" required>
                                </div>
                                <div class=" mb-3">
                                  <label class="small mb-1">Email</label>
                                  <input class="form-control" type="email" name="email" value="" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                
                              </form>
                            </div>
                            <!--đóng form thêm nhà cung cấp  -->

                            <div class="card-header text-warning font-weight-bold" id="edit_heading" style="display: none">Sửa nhà cung cấp</div>  
                            <!-- form edit danh mục -->
                            <div class="card-body" id="editvendor" style="display: none">
                              <form action="" method="post">
                                 @csrf
                                <div class=" mb-3">
                                  <label class="small mb-1">Tên nhà cung cấp</label>
                                  <input class="form-control new_name" type="text" name="new_name" value="" required>
                                </div>
                                <div class=" mb-3">
                                  <label class="small mb-1">Số điện thoại</label>
                                  <input class="form-control new_phone" type="text" name="new_phone" value="" required>
                                </div>
                                <div class=" mb-3">
                                  <label class="small mb-1">Số Email thoại</label>
                                  <input class="form-control new_email" type="text" name="new_email" value="" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Lưu</button>
                                <button type="button" class="btn btn-primary" id="add" style="margin-left:10%">Thêm mới NCC</button>
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
        $("#addvendor").hide();
        $("#edit_heading").show();
        $("#editvendor").show(); 
        var id = $(this).closest('tr').find('.id').text();
        var name = $(this).closest('tr').find('.name').text();
        var phone = $(this).closest('tr').find('.phone').text();
        var email = $(this).closest('tr').find('.email').text();
        $("#editvendor form").attr("action","{{ url('admin/vendor') }}/" + id + "/edit");
        $(".new_name").val(name);
        $(".new_phone").val(phone);
        $(".new_email").val(email);
    });
    $("#add").click(function() {
      $("#edit_heading").hide();
      $("#editvendor").hide();
      $("#add_heading").show();
      $("#addvendor").show(); 
    });
  });

</script>

@endsection
