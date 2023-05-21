@extends('User.layout.main')

@section('title')
Chotsport - Vấn đề tồn kho
@endsection

@section('content')
<div class="col-6 mx-auto text-center m-10" >
    <img src="{{asset('/user/assets/images/error/errorcheckout.webp')}}" alt="">
    <h2>Vấn đề tồn kho</h2>
    <span>Một số sản phẩm đã vượt quá số lượng tồn kho</span>
</div>

<div class="order_table table-responsive col-8 mx-auto">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($id_overQty))
                                        @foreach($id_overQty as $over)   
                                        @foreach(session()->get('cart') as $key => $value )   
                                            @if($over['id_product_detail'] == $key)
                                        <tr>
                                            <td class="col-6">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <label><img src="{{$value['cartImg']}}" style="width:100%"></label>
                                                    </div>
                                                    <div class="col-10" style="padding:0">
                                                        {{$value['Name_product']}}
                                                        <br>
                                                        <span style="font-size: 13px">Kích thước: {{$value['Sizename']}}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span>{{$value['cartQty']}} </span><i class="fa-solid fa-arrow-right"></i><strong class="text-danger"> {{$over['realQty']}}</strong>
                                            </td>
                                            <td>{{number_format($value['cartPrice']*$value['cartQty'], 0, '.', ',')}}đ</td>
                                            <td class="text-center">Vượt tồn kho
                                                <a class="text-success" href="{{route('user.reducecart',['id'=>$key])}}"><i class="fa-solid fa-triangle-exclamation"></i>Giảm</a>
                                                <a class="text-danger" href="{{route('user.deletecart',['id'=>$key])}}"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                            @endif
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4"> <a href="{{route('user.cart')}}"><i class="fa-solid fa-chevron-left"></i> Quay lại giỏ hàng</a></th>
                                        </tr>
                                    </tfoot>
                                    @endif
                                </table>
                            </div>


@endsection
               