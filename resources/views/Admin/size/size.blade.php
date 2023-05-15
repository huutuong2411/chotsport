@extends('admin.layout.main')

@section('title')
Quản lý size giày
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý size giày</h1>
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
                          <div class="card-header text-primary font-weight-bold">Danh sách size giày</div>
                          @foreach($brand as $brand)
                              <div class="font-weight-bold">{{$brand->name}}</div>
                            <div class="card-body table-responsive">
                               
                                <table class="display table table-bordered" id="" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Chiều dài</th>
                                            <th>Size EU</th>
                                            <th class="col-3" style="text-align: center">Thao tác</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       @foreach($size as $Size)
                                         @if($Size->id_brand==$brand->id)
                                        <tr>
                                            <td class="length">{{$Size->length}}</td>
                                            <td class="size">{{$Size->size}}</td>
                                            <td style="text-align: center">
                                                <input type="hidden" class="id_size" value="{{$Size->id}}">
                                                <button  class="edit btn btn-warning btn-circle btn-sm" ><i class="fas fa-pencil-alt"></i></button>
                                                <a href="{{route('admin.size.delete',['id'=>$Size->id])}}" class="btn btn-danger btn-circle btn-sm" style="margin-left:10%"><i class="fas fa-trash"></i></a>
                                            </td>
                                            
                                        </tr>

                                        @endif
                                         @endforeach
                                    </tbody>
                                </table>
                                <button class="btn btn-primary add">Thêm size</button>
                                <form class="addsize" action="{{route('admin.size.add')}}" method="post" style="display: none">
                                     @csrf
                                    <div class="row">
                                    <div class="mb-3 col-4">
                                      <label class="small mb-1">Chiều dài</label>
                                      <input required class="form-control" type="text" name="newlength" value="">
                                    </div>
                                    <div class="mb-3 col-4">
                                      <label class="small mb-1">Size EU</label>
                                      <input required class="form-control" type="text" name="newsize" value="">
                                    </div>
                                    <div class="">
                                      <label class="small mb-1"></label>
                                      <input type="hidden" name="id_brand" value="{{$brand->id}}" >
                                      <button type="submit" class="btn btn-success form-control ">Lưu</button>
                                    </div>
                                    </div>
                                </form>
                                <form class="editsize" action="" method="post" style="display: none">
                                     @csrf
                                    <div class="row">
                                    <div class="mb-3 col-4">
                                      <label class="small mb-1">Chiều dài</label>
                                      <input class="form-control oldlength" type="text" name="length" value="" required>
                                    </div>
                                    <div class="mb-3 col-4">
                                      <label class="small mb-1">Size EU</label>
                                      <input class="form-control oldsize" type="text" name="size" value="" required>
                                    </div>
                                    <div class="">
                                      <label class="small mb-1"></label>
                                      <input type="hidden" name="id_brand" value="{{$brand->id}}" required>
                                      <button type="submit" class="btn btn-warning form-control ">Sửa</button>
                                    </div>
                                    </div>
                                </form>
                                <hr>
                                
                            </div>
                          @endforeach
                        </div>




                        <div class="card col-xl-5">
                           <div class="card-header text-danger font-weight-bold"><i class="fas fa-trash"></i> Thùng rác</div>
                           <div class="card-body table-responsive">
                               
                                <table class="table table-bordered" id="dataTable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Hãng giày</th>
                                            <th>Chiều dài</th>
                                            <th>Size</th>
                                            <th style="text-align: center">Thao tác</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                      @foreach($trash as $value)
                                        <tr>
                                            <td>{{$value->brand_name}}</td>
                                            <td>{{$value->length}}</td>
                                            <td>{{$value->size}}</td>
                                            <td style="text-align: center"><a href="{{route('admin.size.restore',['id'=>$value->id])}}" class="btn btn-warning"><i class="fas fa-retweet"></i> Khôi phục</a></td> 
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        </div>

</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("button.add").click(function() {
        $(this).closest('.card-body').find('form.addsize').toggle();
        $('form.editsize').hide();
     
       
    });


    $("button.edit").click(function() {
        $(this).closest('.card-body').find('form.editsize').toggle();
        $('form.addsize').hide();
        var id = $(this).closest('td').find('.id_size').val();
        var length = $(this).closest('tr').find('.length').text();
        var name = $(this).closest('tr').find('.size').text();
       $("form.editsize").attr("action", "{{ url('admin/size') }}/" + id + "/edit");
        $(".oldlength").val(length);
        $(".oldsize").val(name);
       
    });
  });
</script>


@endsection
 