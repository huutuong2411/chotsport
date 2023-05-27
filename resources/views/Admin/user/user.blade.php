@extends('admin.layout.main')

@section('title')
Quản lý người dùng
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý bài viết</h1>
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
                          <div class="card-header text-primary font-weight-bold">Danh sách người dùng</div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="dataTable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-1">ID</th>
                                            <th class="col-2">Tên</th>
                                            <th class="col-1">Avatar</th>
                                            <th class="col-2">Email</th>
                                            <th class="col-2">Vai trò</th>
                                            <th class="col-2">Phân quyền</th>
                                            <th class="col-2" style="text-align: center">Thao tác</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach($user as $value)
                                        <tr>   
                                            <th scope="row">{{$value->id}}</th>
                                            <td class="name">{{$value->name}}</td>
                                            <td class="name">
                                            @if($value->id_role==1)
                                               <img style="width: 90%" src="{{asset('admin/assets/img/user/'.$value->avatar)}}" alt=""class="img-profile">
                                            @else
                                                <img style="width: 90%" src="{{asset('user/assets/images/user/'.$value->avatar)}}" alt=""class="img-profile">
                                            @endif
                                            </td>
                                            <td class="name">{{$value->email}}</td>
                                             <td class="name">
                                                @if($value->id_role==1)
                                                <span class="badge badge-info">Quản trị viên</span>
                                                @elseif($value->id_role==2)
                                                 <span class="badge badge-warning">Người dùng</span>
                                                  @elseif($value->id_role==3)
                                                    <span class="badge badge-success">Nhân viên</span>
                                                  @endif


                                             </td>
                                              <td class="name">
                                                <form action="{{route('admin.user.change',['id'=>$value->id])}}" method="post">
                                                    @csrf
                                                    <select class="form-select form-control" name="role" id="speed" onchange="this.form.submit()">
                                                        <option value="2" {{$value->id_role==2?'selected':''}}>Người dùng</option>
                                                        <option value="3" {{$value->id_role==3?'selected':''}}>Nhân viên</option>
                                                        <option value="1" {{$value->id_role==1?'selected':''}}>Admin</option>
                                                    </select>
                                                </form>
                                              </td>

                                            <td style="text-align: center">
                                                <a href="" class="btn btn-info btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-solid fa-eye"></i></a>
                                                <a href="" class="btn btn-warning btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="" class="btn btn-danger btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach              
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                        
                        

</div>


@endsection