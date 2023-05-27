@extends('User.layout.main')

@section('title')
Chotsport-Bài viết
@endsection

@section('content')
<div class="breadcrumb-nav p-3 mb-2 text-dark" style="background-color:#e1e3e8!important;padding: 3px 20px!important; margin-bottom: 50px!important">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li class="active" aria-current="page"><a href="{{route('user.home')}}">Trang chủ</a></li>
                                    <li class="active" aria-current="page"><a href="{{route('user.blog')}}">Bài viết</a></li>
                                    <li class="active" aria-current="page">{{$blog->title}}</li>
                                </ul>
                            </nav>
</div>
<!-- ...:::: Start Blog Single Section:::... -->
    <div class="blog-section">
        <div class="container">
                <div class="col-9 mx-auto">
                    <!-- Start Blog Single Content Area -->
                    <div class="blog-single-wrapper">
                        <div class="blog-single-img" data-aos="fade-up"  data-aos-delay="0">
                            <img class="img-fluid" src="{{asset('/admin/assets/img/blog/'.$blog->image)}}" alt="">
                        </div>
                        <ul class="post-meta" data-aos="fade-up"  data-aos-delay="200">
                            <li>Ngày viết : {{$blog->updated_at}}</li> 
                         </ul>
                        <h4 class="post-title" data-aos="fade-up"  data-aos-delay="400">{{$blog->title}}</h4>
                        <div class="para-content" data-aos="fade-up"  data-aos-delay="600">
                            {!!$blog->content!!}
                        </div>
                        
                    </div> <!-- End Blog Single Content Area -->
                </div>
            
        </div>
    </div> <!-- ...:::: End Blog Single Section:::... -->
@endsection



































