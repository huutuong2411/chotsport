<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Purchase;
use App\Models\admin\Purchase_detail;
use App\Models\admin\Vendor;
use App\Models\admin\Product;
use App\Models\admin\Product_detail;
use PDF;
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $purchase = Purchase::join('vendor', 'purchase.id_vendor', '=', 'vendor.id')
        ->select('purchase.*','vendor.name as vendor')->get();
      
        return view('Admin.purchase.purchase',compact('purchase'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendor= Vendor::select('id','name')->get();
        $product= Product::select('id','name','image')->get();
        return view('Admin.purchase.addPurchase',compact('vendor','product'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // xử lý ajax trả về size của brand theo id_product
        if(!empty($request->id_product)) {
        $size= Product::find($request->id_product)->Brand->Size;
        return response()->json($size);
        }
       
        $purchase= new Purchase();
        $purchase->id_vendor= $request->vendor;
        $purchase->date= $request->date;
        $purchase->sum_money= array_sum($request->sum_money);
        
        if($purchase->save()){ 
            $id_purchase= $purchase->id; //lấy id purchase vừa lưu
                foreach ($request->product as $key => $product) {   
                    $price = $request->price[$key];
                    $id_product=$request->product[$key];
                    foreach ($request->all() as $index => $value) {
                        if (strpos($index,"{$id_product}_size_") === 0 && !empty($value)) {
                            // Lấy id_size từ tên của input
                            $id_size = explode('_', $index)[2];
                            // Xử lý dữ liệu tương ứng với id_size
                            $quantity = $value;
                            $sum_money = $price*$quantity;

                            // check xem đã tồn tại id_sze+id_product này trong product_detail chưa - lấy id_product_deatail
                            $check_product_detail  = Product_detail::withTrashed()->where('id_product', $product)->where('id_size', $id_size)->first();
                            if(!empty($check_product_detail)){
                                    Purchase_detail::create([
                                    'id_product_detail' => $check_product_detail->id,
                                    'id_purchase' => $id_purchase,
                                    'qty' => $quantity,
                                    'price'=> $price,
                                    'sum_money'=>$sum_money,
                                    ]);
                                // nếu id_product_detail đó đã bị xoá trước đó thì khôi phục rồi tăng số lượng
                                $check_product_detail->restore();
                                // tăng size_qty lên $quantity
                                $check_product_detail->increment('size_qty', $quantity); 
                            }else{
                                // Tạo mới Product_detail
                                $new_product_detail = Product_detail::create([
                                    'id_product' => $id_product,
                                    'id_size' => $id_size,
                                    'size_qty' => $quantity
                                ]);
                                // Tạo mới Purchase_detail
                                Purchase_detail::create([
                                    'id_product_detail' => $new_product_detail->id,
                                    'id_purchase' => $id_purchase,
                                    'qty' => $quantity,
                                    'price'=> $price,
                                    'sum_money'=>$sum_money,
                                ]);

                            }
                        }
                    } 
                    // Cập nhật số lượng trong bảng product
                                $totalQty = Product_detail::where('id_product', $id_product)->sum('size_qty');
                                $product = Product::find($id_product);
                                $product->total_qty = $totalQty;
                                $product->save();    
                }
            return redirect()->route('admin.purchase')->with('success',__('Thêm đơn nhập hàng thành công')); 
        }else{
            return redirect()->route('admin.purchase')->withErrors('Thêm đơn nhập hàng không thành công');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // xử lý trả về ajax
        if(!empty($id)) {
            $purchase = Purchase::join('vendor', 'purchase.id_vendor', '=', 'vendor.id')
            ->select('purchase.sum_money','purchase.date','vendor.name as vendor')->find($id);  

            $purchaseDetail = Purchase_detail::where('id_purchase', $id)
            ->join('product_details', 'purchase_details.id_product_detail', '=', 'product_details.id')
            ->join('products', 'product_details.id_product', '=', 'products.id')
            ->join('size', 'product_details.id_size', '=', 'size.id')
            ->select('purchase_details.*','products.id as id_product', 'products.name as product_name', 'size.size as size_name')
            ->get();

            $groupDetails = $purchaseDetail->groupBy('id_product');

            return response()->json(['purchase' => $purchase,'groupDetails' => $groupDetails]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Remove the specified resource from storage.
     */



}
