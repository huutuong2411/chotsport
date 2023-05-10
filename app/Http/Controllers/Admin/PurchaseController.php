<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Purchase;
use App\Models\admin\Purchase_detail;
use App\Models\admin\Vendor;
use App\Models\admin\Product;
use App\Models\admin\Product_detail;
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase = Purchase::join('vendor', 'purchase.id_vendor', '=', 'vendor.id')
        ->select('purchase.*','vendor.name as vendor')->paginate(5);
      
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
                            $check_product_detail  = Product_detail::where('id_product', $product)->where('id_size', $id_size)->first();
                            if(!empty($check_product_detail)){
                                    Purchase_detail::create([
                                    'id_product_detail' => $check_product_detail->id,
                                    'id_purchase' => $id_purchase,
                                    'qty' => $quantity,
                                    'price'=> $price,
                                    'sum_money'=>$sum_money,
                                    ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
