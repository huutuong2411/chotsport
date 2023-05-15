@extends('admin.layout.main')

@section('title')
Chi tiết đơn nhập
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Chi tiết đơn nhập<a style="float:right;" href="{{route('admin.purchase')}}" class="btn btn-danger col-1"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></h1>
                        @if ($errors->any())
                                    <div class="alert alert-danger">
                                       <ul>
                                        @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                        @endif   
<div class="card shadow mb-4">
                        
                        
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header text-primary font-weight-bold">Thông tin chi tiết đơn nhập</div>
                                        <div class="card-body"> 
                                            <div class="mb-3 row">
                                                <div class="col-3">
                                                        <label class="mb-1 font-weight-bold" >Nhà cung cấp:</label>
                                                        <label class="">{{$purchase->vendor}}</label>
                                                </div>
                                                <div class="col-3">
                                                        <label class="mb-1 font-weight-bold" >Ngày nhập:</label>
                                                        <label class="">{{date('d/m/Y', strtotime($purchase->date))}}</label>
                                                        
                                                </div>
                                                @php
                                                $totalQty = 0;
                                                @endphp
                                                @foreach($groupDetails as $value) 
                                                    @php
                                                        $totalQty += $value->sum('qty');
                                                    @endphp
                                                @endforeach
                                                <div class="col-3">
                                                        <label class="mb-1 font-weight-bold" >Tổng số lượng:</label>
                                                        <label class="" >{{$totalQty}}</label>
                                                        
                                                </div>    
                                            </div>    
                                                <hr class="primary"> 
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center">STT</th>
                                                        <th>Tên sản phẩm</th>
                                                        <th>Size</th>
                                                        <th>Số lượng</th>
                                                        <th>Đơn giá</th>
                                                        <th>Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i=1 ?>
                                                    @foreach($groupDetails as $value)
                                                        @foreach($value as $detail)
                                                    <tr>
                                                        <td style="text-align: center">{{$i}}</td>
                                                        <td>{{$value[0]['product_name']}}</td>
                                                        <td>{{$detail->size_name}}</td>
                                                        <td>{{$detail->qty}}</td>
                                                        <td>{{number_format($detail->price, 0, ',', '.')}}</td>
                                                        <td>{{number_format($detail->sum_money, 0, ',', '.')}}</td>
                                                    </tr>
                                                        <?php $i++ ?>
                                                        @endforeach
                                                    @endforeach
                                                    <tr class="font-weight-bold">
                                                        <td colspan="6">Tổng tiền thanh toán:<p class="float-right">{{number_format($purchase->sum_money, 0, ',', '.')}} (VNĐ)</p></td>   
                                                    </tr>
                                                </tbody>
                                            </table>
                                                <a class="btn btn-success" href="{{route('admin.purchase.print')}}">in PDF</a>
                                        </div>
                                    </div>
                     
                        

</div>
@endsection
