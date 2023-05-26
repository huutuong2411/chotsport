<!DOCTYPE html>
<html>
<head>

</head>
<body>
	
	<div style="margin: 0 auto;width: 50%;">
        <h3>Xin chào {{$data['name']}}, Cảm ơn bạn đã đặt hàng</h3>
        <span>Chúng tôi đã nhận được đơn hàng của bạn và sẵn sàng gửi đi</span>
        <hr>                
        <h3>Đơn hàng của bạn: {{$data['order_code']}}</h3>
        <div>
            <table>
                <thead style="background-color:#f2f2f2">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach(session()->get('cart') as $key => $value )   
                                        <tr>
                                            <td>
                                                <div style="padding:0">
                                                    {{$value['Name_product']}}
                                                    <br>
                                                    <span style="font-size: 13px">Kích thước: {{$value['Sizename']}}  x({{$value['cartQty']}})</span>
                                                </div>
                                            </td>
                                            <td>{{number_format($value['cartPrice']*$value['cartQty'], 0, '.', ',')}}đ</td>
                                        </tr>
                     @endforeach           
                </tbody>
                <tfoot>	
                    <tr>
                        <th>Phí vận chuyển:</th>
                        <td><strong>Miễn phí</strong></td>
                    </tr>
                    <tr >
                    	<th>Tổng tiền thanh toán:</th>
                        <td><strong style="color:green ">{{number_format($data['sum_money'], 0, '.', ',')}}đ</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <h4>Thông tin khách hàng</h4>
        <div>
            <label><strong>Số điện thoại:</strong>{{$data['phone']}}</label>
            <label><strong>Địa chỉ giao hàng:</strong>{{$data['address']}}</label>
            <label><strong>Phương thức thanh toán:</strong>{{$data['payment_status']==0?'Thanh toán khi nhận hàng':'Thanh toán online'}}</label>
        </div>
    </div>
</body>
</html>