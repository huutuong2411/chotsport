@extends('admin.layout.main')

@section('title')
Quản lý người dùng
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý người dùng</h1>
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
                          <div class="card-header text-primary font-weight-bold">Danh sách người dùng 
                            @if(Auth::user()->id_role==1)
                            <a style="float:right" href="{{route('admin.user.addempoyee')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Tạo tài khoản nhân viên</a>
                            @endif
                          </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-1" style="text-align: center">ID</th>
                                            <th class="col-2" style="text-align: center">Tên</th>
                                            <th class="col-1" style="text-align: center">Avatar</th>
                                            <th class="col-2" style="text-align: center">Email</th>
                                            <th class="col-2" style="text-align: center">Vai trò</th>
                                            <th class="col-2" style="text-align: center">Trạng thái</th>
                                            <th class="col-2" style="text-align: center">Thao tác</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach($user as $value)
                                        <tr>   
                                            <th scope="row" style="text-align: center">{{$value->id}}</th>
                                            <td class="name" style="text-align: center">{{$value->name}}</td>
                                            <td class="name" style="text-align: center">
                                            @if($value->id_role==1)
                                               <img style="width: 90%" src="{{asset('admin/assets/img/user/'.$value->avatar)}}" alt=""class="img-profile">
                                            @else
                                                <img style="width: 90%" src="{{asset('user/assets/images/user/'.$value->avatar)}}" alt=""class="img-profile">
                                            @endif
                                            </td>
                                            <td class="name" style="text-align: center">{{$value->email}}</td>
                                            <td class="name" style="text-align: center">
                                                @if($value->id_role==1)
                                                <span class="badge badge-success">Quản trị viên</span>
                                                @elseif($value->id_role==2)
                                                 <span class="badge badge-warning">Người dùng</span>
                                                  @elseif($value->id_role==3)
                                                    <span class="badge badge-info">Nhân viên</span>
                                                  @endif
                                             </td>
                                            <td class="name" style="text-align: center">
                                                @if($value->status==0)
                                                <span class="badge badge-success">Kích hoạt</span>
                                                @else
                                                <span class="badge badge-danger">Vô hiệu hoá</span>
                                                @endif
                                            </td>

                                            <td style="text-align: center">
                                                <a href="{{route('admin.user.show',['id'=>$value->id])}}" class="btn btn-info btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-solid fa-eye"></i></a>
                                                @if(Auth::user()->id_role==1 && Auth::user()->id!=$value->id)
                                                @if($value->status==0)
                                                <a href="{{route('admin.user.disable',['id'=>$value->id])}}" class="btn btn-danger btn-circle btn-sm" style="margin-left:2%" title="Vô hiệu hoá"><i class="fas fa-sharp fa-solid fa-ban"></i></a>
                                                @else
                                                <a href="{{route('admin.user.enable',['id'=>$value->id])}}" class="btn btn-success btn-circle btn-sm" style="margin-left:2%" title="kích hoạt"><i class="fas fa-solid fa-check"></i></a>
                                                @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach              
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                        
                        

</div>


@endsection