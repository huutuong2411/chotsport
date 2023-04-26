@extends('admin.layout.main')

@section('title')
Quản lý nhãn hàng
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý nhãn hàng</h1>
        @if(session('delete'))
            <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              {{session('delete')}}
            </div>
        @endif
<div class="card shadow mb-4">
                        
                        <div class="row">
                        <div class="card col-xl-6">
                          <div class="card-header text-primary font-weight-bold">Danh sách nhãn hàng</div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="dataTable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width:10%">ID</th>
                                            <th>Tên</th>
                                            <th style="width:17%">Thao tác</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach($brand as $value)
                                        <tr>
                                            <th scope="row">{{$value->id}}</th>
                                            <td class="name">{{$value->name}}</td>
                                            <td>
                                                <button href="#" class="btn btn-warning btn-circle btn-sm edit" ><i class="fas fa-pencil-alt"></i></button>
                                                <a href="{{route('admin.brand.delete',['id'=>$value->id])}}" class="btn btn-danger btn-circle btn-sm" style="margin-left:10%"><i class="fas fa-trash"></i></a>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card col-xl-6">
                            <div class="card-header text-primary font-weight-bold" id="add_heading">Thêm nhãn hàng giày</div>  
                            <!--form thêm danh mục  -->
                            <div class="card-body" id="addbrand">
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
                              <form action="{{route('admin.brand.add')}}" method="post">
                                 @csrf
                                <div class=" mb-3">
                                  <label class="small mb-1">Tên danh mục</label>
                                  <input class="form-control" type="text" name="brand" value="" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                
                              </form>
                            </div>
                            <!--đóng form thêm danh mục  -->

                            <div class="card-header text-warning font-weight-bold" id="edit_heading" style="display: none">Sửa nhãn hàng giày</div>  
                            <!-- form edit danh mục -->
                            <div class="card-body" id="editbrand" style="display: none">
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
                              <form action="" method="post">
                                 @csrf
                                <div class=" mb-3">
                                  <label class="small mb-1">Tên danh mục cũ</label>
                                  <input class="form-control old_brand" type="text" value="" readonly>
                                </div>
                                <div class=" mb-3">
                                  <label class="small mb-1">Tên danh mục mới</label>
                                  <input class="form-control new_brand" type="text" name="new_name" value="" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Lưu</button>
                                <button type="button" class="btn btn-primary" id="add" style="margin-left:10%">Thêm mới danh mục</button>
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
        $("#addbrand").hide();
        $("#edit_heading").show();
        $("#editbrand").show(); 
        var id = $(this).closest('tr').find('.id').text();
        var name = $(this).closest('tr').find('.name').text();
        $("#editbrand form").attr("action", "{{route('admin.brand.edit','') }}/" + id);
        $(".old_brand").val(name);
        $(".new_brand").val(name);
    });
    $("#add").click(function() {
      $("#edit_heading").hide();
      $("#editbrand").hide();
      $("#add_heading").show();
      $("#addbrand").show(); 
    });
  });

</script>

@endsection
