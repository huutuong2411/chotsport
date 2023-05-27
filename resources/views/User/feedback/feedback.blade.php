@extends('User.layout.main')

@section('title')
Chotsport - Thanh toán đơn hàng
@endsection

@section('content')
<div class="breadcrumb-nav p-3 mb-2 text-dark" style="background-color:#e1e3e8!important;padding: 3px 20px!important; margin-bottom: 50px!important">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li class="active" aria-current="page"><a href="{{route('user.order')}}">Đơn hàng</a></li>
                                    <li class="active" aria-current="page">Đánh giá</li>
                                </ul>
                            </nav>
</div>
<div class="checkout_form">
	<form action="{{route('user.feedback.post',['id'=>$id_order])}}" method="POST">
        @csrf
      <div class="col-6 mx-auto">
        <h3 style="margin-bottom: 30px">Đánh giá đơn hàng của bạn</h3>
       @foreach($Product as $value)
        <div class="row col-12">
                        <div class="col-2">
                            <img src="{{asset('/admin/assets/img/product/'.$value->id.'/'.json_decode($value->image)[0])}}" style="width:66%">
                        </div>
                        <div class="col-8" style="padding:0">
                             {{$value->name}}
                            <br>
                            <span>{{number_format($value->orderprice, 0, '.', ',')}}đ</span>
                        </div>
        
        <!-- start feedback -->
            <div class="default-form-box">
                <br>
                <label for="comment-review-text">Đánh giá của bạn<span>*</span></label>
                <div class="rating-css float-left">
                    <div class="star-icon">
                        <input type="radio" value="1" name="product_rating{{$value->id}}" checked="" id="rating1{{$value->id}}">
                        <label for="rating1{{$value->id}}" class="fa fa-star"></label>
                        <input type="radio" value="2" name="product_rating{{$value->id}}" id="rating2{{$value->id}}">
                        <label for="rating2{{$value->id}}" class="fa fa-star"></label>
                        <input type="radio" value="3" name="product_rating{{$value->id}}" id="rating3{{$value->id}}">
                        <label for="rating3{{$value->id}}" class="fa fa-star"></label>
                        <input type="radio" value="4" name="product_rating{{$value->id}}" id="rating4{{$value->id}}">
                        <label for="rating4{{$value->id}}" class="fa fa-star"></label>
                        <input type="radio" value="5" name="product_rating{{$value->id}}" id="rating5{{$value->id}}">
                        <label for="rating5{{$value->id}}" class="fa fa-star"></label>
                    </div>
                </div>

                <textarea id="comment-review-text" name="product_comment{{$value->id}}" placeholder="Viết bình luận..." required=""></textarea>
            </div>
        </div>
        @endforeach
        <!-- end feedback -->
        <div class="col-12">
        <button class="btn btn-md btn-black-default-hover" type="submit">Gửi</button>
        </div>
      </div>
      
    </form>					
</div>

@endsection
           


