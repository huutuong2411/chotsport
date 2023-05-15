<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin\Purchase;
use App\Models\admin\Purchase_detail;
use PDF;
class PrintPDFController extends Controller
{
    public function printPDF($id_purchase)
    { 
        $pdf= \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_purchase_detail($id_purchase));
        return $pdf->stream();
        
    }
    public function print_purchase_detail($id_purchase){
        $purchase = Purchase::find($id_purchase)->join('vendor', 'purchase.id_vendor', '=', 'vendor.id')
            ->select('purchase.sum_money','purchase.date','vendor.name as vendor')->first();  

            $purchaseDetail = Purchase_detail::where('id_purchase', $id_purchase)
            ->join('product_details', 'purchase_details.id_product_detail', '=', 'product_details.id')
            ->join('products', 'product_details.id_product', '=', 'products.id')
            ->join('size', 'product_details.id_size', '=', 'size.id')
            ->select('purchase_details.*','products.id as id_product', 'products.name as product_name', 'size.size as size_name')
            ->get();


            $groupDetails = $purchaseDetail->groupBy('id_product');

        $output='';
        $output.= '
       <div class="card-body"> 
                                            <div class="mb-3 row">
                                                <div class="col-3">
                                                        <label class="mb-1 font-weight-bold" >Nhà cung cấp:</label>
                                                        <label class="">'.$purchase->vendor.'</label>
                                                </div>
                                                <div class="col-3">
                                                        <label class="mb-1 font-weight-bold" >Ngày nhập:</label>
                                                        <label class="">'.date('d/m/Y', strtotime($purchase->date)).'</label>
                                                        
                                                </div>';
                                               
                                                $totalQty = 0;
                                               
                                                foreach($groupDetails as $value){
                                                   
                                                        $totalQty += $value->sum('qty');
                                                }
    
        $output.=  '
                            <style>
                    body{
                        font-family: Dejavu Sans;
                    }
                    .table{
                        border:1px solid #000;
                    }
                    .chuky{
                        float: right;
                    }
                    </style>



        <div class="col-3">
                                                        <label class="mb-1 font-weight-bold" >Tổng số lượng:</label>
                                                        <label class="" >'.$totalQty.'</label>
                                                        
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
                                                <tbody>';
                                                    $i=1 ;
                                                    foreach($groupDetails as $value){
                                                        foreach($value as $detail){
                                                    $output.= '
                                                    <tr>
                                                        <td style="text-align: center">'.$i.'</td>
                                                         <td>'.$value[0]['product_name'].'</td>
                                                        <td>'.$detail->size_name.'</td>
                                                        <td>'.$detail->qty.'</td>
                                                        <td>'.number_format($detail->price, 0, ',', '.').'</td>
                                                        <td>'.number_format($detail->sum_money, 0, ',', '.').'</td>
                                                    </tr>';
                                                        $i++;
                                                        }
                                                    }
                                        $output.=   '<tr class="font-weight-bold">
                                                        <td colspan="6">Tổng tiền thanh toán:<p class="float-right">'.number_format($purchase->sum_money, 0, ',', '.').'(VNĐ)</p></td>   
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <label class="chuky">Chữ ký người nhận</label>
                                        </div>';

        return ($output);
    }
}
