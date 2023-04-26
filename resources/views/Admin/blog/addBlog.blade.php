@extends('admin.layout.main')

@section('title')
Thêm bài viết
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Thêm bài viết</h1>
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


                        <form action="{{route('admin.blog.store')}}" method="post" enctype="multipart/form-data" id="form">
                           @csrf
                                
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header text-primary font-weight-bold">Thông tin bài viết</div>
                                        <div class="card-body">
                                            
                                               
                                                <div class="mb-3">
                                                    <label class="small mb-1" >Tiêu đề</label>
                                                    <input name="title" class="form-control" id="inputUsername" type="text" placeholder="Nhập tiêu đề" value="">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1" >Mô tả</label>
                                                    <textarea  name="description" class="form-control" id="inputUsername" type="text" placeholder="Nhập mô tả" value=""> </textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1">Hình ảnh</label>
                                                    <input name="image" class="form-control col-2" id="inputUsername" type="file"  value="">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="inputUsername">Nội dung</label>
                                                    <textarea name="content" id="editor" style="min-height: 400px"></textarea>
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


@endsection
