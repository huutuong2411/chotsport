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
                                </ul>
                            </nav>
</div>
<!-- ...:::: Start Blog List Section:::... -->
    <div class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-wrapper">
                        <div class="row mb-n6">
                        @foreach($blog as $value)
                            <div class="col-xl-4 col-md-6 col-12 mb-6">
                                <!-- Start Product Default Single Item -->
                                <div class="blog-list blog-grid-single-item blog-color--golden"  data-aos="fade-up"  data-aos-delay="0">
                                    <div class="image-box">
                                        <a href="{{route('user.blog_detail',['id'=>$value->id])}}" class="image-link">
                                            <img class="img-fluid" src="{{asset('/admin/assets/img/blog/'.$value->image)}}" alt="">
                                        </a>
                                    </div>
                                    <div class="content">
                                    		<ul class="post-meta">
                                           	<li>Ngày viết : {{$value->updated_at}}</li> 
                                        	</ul>
                                            
                                            <h6 style="min-height: 81px;" class="title"><a href="{{route('user.blog_detail',['id'=>$value->id])}}">{{$value->title}}</a></h6>
                                            <p>{{ \Illuminate\Support\Str::limit($value->description, 100, '...')}}</p>
                                            <div class="inner">
                                                <a href="{{route('user.blog_detail',['id'=>$value->id])}}" class="read-more-btn icon-space-left">Xem thêm<span><i class="ion-ios-arrow-thin-right"></i></span></a>
                                                
                                            </div>
                                    </div>
                                </div>
                                <!-- End Product Default Single Item -->
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <!-- Start Pagination -->
                     <div class="" data-aos="fade-up"  data-aos-delay="0">
                      {{$blog->links('pagination::bootstrap-4')}}
                    </div> <!-- End Pagination -->
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Blog List Section:::... -->
@endsection



































