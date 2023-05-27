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
            $purchase = Purchase::find($id)->join('vendor', 'purchase.id_vendor', '=', 'vendor.id')
            ->select('purchase.sum_money','purchase.date','vendor.name as vendor')->first();  

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
    public function edit(string $id)
    {
        $purchase = Purchase::find($id);  
        $vendor= Vendor::select('id','name')->get();
        $product= Product::select('id','name')->get();
        $purchaseDetail = Purchase_detail::where('id_purchase', $id)
            ->join('product_details', 'purchase_details.id_product_detail', '=', 'product_details.id')
            ->join('products', 'product_details.id_product', '=', 'products.id')
            ->join('size', 'product_details.id_size', '=', 'size.id')
            ->select('purchase_details.*','products.id as id_product', 'products.name as product_name', 'size.size as size_name','size.id as id_size')->get();
        $groupDetails = $purchaseDetail->groupBy('id_product');


        $listsize= Purchase_detail::where('id_purchase', $id)
            ->join('product_details', 'purchase_details.id_product_detail', '=', 'product_details.id')
            ->join('products', 'product_details.id_product', '=', 'products.id')
            ->join('brand', 'products.id_brand', '=', 'brand.id')
            ->join('size', 'size.id_brand', '=', 'brand.id')
            ->select('products.id as id_product', 'size.size','size.id')->groupBy('id_product','size.id')->get();
        return view ('Admin.purchase.editPurchase',compact('purchase','vendor','product','groupDetails','listsize'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $purchase= Purchase::find($id);
        // lấy số lượng cũ ra
        $oldQty=  Purchase_detail::where('id_purchase', $id)->pluck('qty', 'id_product_detail')->toArray();
        $oldProduct= Purchase_detail::where('id_purchase', $id)
            ->join('product_details', 'purchase_details.id_product_detail', '=', 'product_details.id')
            ->join('products', 'product_details.id_product', '=', 'products.id')->groupBy('products.id')->pluck('products.id')->toArray();
        $purchase->id_vendor= $request->vendor;
        $purchase->date= $request->date;
        $purchase->sum_money= $request->total_payment;
        if($purchase->update()){ 
                foreach ($request->product as $key => $product) {   
                    $price = $request->price[$key];

                    foreach ($request->all() as $index => $value) {
                        if (strpos($index,"{$product}_size_") === 0 && !empty($value)) //hàm tìm kiếm vị trí 
                        {
                            // Lấy id_size từ tên của input
                            $id_size = explode('_', $index)[2];
                            // Xử lý dữ liệu tương ứng với id_size
                            $quantity = $value;
                            $sum_money = $price*$quantity;
                            // check xem đã tồn tại id_sze+id_product này trong product_detail chưa - lấy id_product_deatail
                            $check_product_detail  = Product_detail::withTrashed()->where('id_product', $product)->where('id_size', $id_size)->first();

                            if(!empty($check_product_detail)){       //trường hợp nếu chỉ sửa/thêm số lượng những size có trước
                                    // tạo mới hoặc cập nhật dữ liệu cho purchase_detail
                                    Purchase_detail::updateOrCreate(
                                    [
                                        'id_purchase' => $id,
                                        'id_product_detail' => $check_product_detail->id,
                                    ],
                                    [
                                        'id_product_detail' => $check_product_detail->id,
                                        'id_purchase' => $id,
                                        'qty' => $quantity,
                                        'price'=> $price,
                                        'sum_money'=>$sum_money,
                                    ]); // lưu hoặc cập nhật   
                                // nếu id_product_detail đó đã bị xoá trước đó thì khôi phục rồi tăng số lượng
                                $check_product_detail->restore();
                                // check xem id_product_detail này có được lưu trước đó không, nếu có thì - số cũ + số mới
                                // nếu chưa được lưu trước đó thì tăng lên 1 đơn vị Qty
                                if(array_key_exists($check_product_detail->id, $oldQty)){  
                                    $i = $oldQty[$check_product_detail->id];
                                    // tăng size_qty lên $quantity- số lượng cũ
                                    $check_product_detail->increment('size_qty', $quantity-$i); 
                                    if ($check_product_detail->size_qty <= 0) {
                                    $check_product_detail->delete();
                                    }
                                }else{
                                // tăng size_qty lên $quantity
                                $check_product_detail->increment('size_qty', $quantity); 
                                }
                            }else{  //trường hợp không thêm số lượng những size có trước
                                // Tạo mới Product_detail
                                $new_product_detail = Product_detail::create([
                                    'id_product' => $product,
                                    'id_size' => $id_size,
                                    'size_qty' => $quantity
                                ]);
                                // Tạo mới Purchase_detail
                                Purchase_detail::create([
                                    'id_product_detail' => $new_product_detail->id,
                                    'id_purchase' => $id,
                                    'qty' => $quantity,
                                    'price'=> $price,
                                    'sum_money'=>$sum_money,
                                ]);

                            }
                        }elseif (strpos($index,"{$product}_size_") === 0 && empty($value)) {
                            // Lấy id_size từ tên của input
                            $id_size = explode('_', $index)[2];
                            // check xem đã tồn tại id_sze+id_product này trong product_detail chưa - lấy id_product_deatail
                            $check_product_detail  = Product_detail::withTrashed()->where('id_product', $product)->where('id_size', $id_size)->first();
                            if(!empty($check_product_detail)&&array_key_exists($check_product_detail->id, $oldQty)){
                                // Xoá dữ liệu trong purchase_detail
                                $i = $oldQty[$check_product_detail->id];
                                Purchase_detail::where('id_purchase', $id)->where('id_product_detail', $check_product_detail->id)->delete();
                                // Trừ số lượng trong product_detail
                                $check_product_detail->decrement('size_qty', $i);
                                // Kiểm tra nếu số lượng sau khi giảm là 0, xoá bản ghi
                                if ($check_product_detail->size_qty === 0) {
                                    $check_product_detail->delete();
                                }
                                
                            }
                        }

                    }

                    foreach($oldProduct as $key => $value)  {   //lặp qua danh sách đã lọc ở trên        
                                    if(in_array($product,$oldProduct)){
                                        $index = array_search($product, $oldProduct);
                                        unset($oldProduct[$index]);
                                }
                    }    // thu được mảng chứa sản phẩm lúc trước có mà giờ không có 
                    // Cập nhật số lượng trong bảng product
                                $totalQty = Product_detail::where('id_product', $product)->sum('size_qty');
                                $product = Product::find($product);
                                $product->total_qty = $totalQty;
                                $product->save();
                }

            foreach($oldProduct as $key => $value)  {  //lặp qua mảng để xoá đơn nhập của sản phẩm đó
                
                $list_id_product = Purchase_detail::where('id_purchase', $id)
                ->join('product_details', 'purchase_details.id_product_detail', '=', 'product_details.id')
                ->join('products', 'product_details.id_product', '=', 'products.id')->where('products.id', $value)->select('product_details.id as id_product')->get();
                    foreach($list_id_product as $key => $id_product) {
                        Purchase_detail::where('id_purchase', $id)->where('id_product_detail', $id_product->id_product)->delete();
                        if(array_key_exists($id_product->id_product, $oldQty)){
                            $i = $oldQty[$id_product->id_product];
                            $thisProductDetail = Product_detail::find($id_product->id_product);
                            $thisProductDetail->decrement('size_qty', $i);
                            if ($thisProductDetail->size_qty === 0) {
                                    $thisProductDetail->delete();
                                }
                        }
                    }
                // Cập nhật số lượng trong bảng product
                                $totalQty = Product_detail::where('id_product', $value)->sum('size_qty');
                                $product = Product::find($value);
                                $product->total_qty = $totalQty;
                                $product->save();
            }  
            
            return redirect()->route('admin.purchase')->with('success',__('Sửa đơn nhập hàng thành công')); 
        }else{
            return redirect()->route('admin.purchase')->withErrors('Sửa đơn nhập hàng không thành công');
        }

    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $listSizeQty = Purchase_detail::where('id_purchase',$id)
                ->join('product_details', 'purchase_details.id_product_detail', '=', 'product_details.id')
                ->join('products', 'product_details.id_product', '=', 'products.id')
                ->join('size', 'product_details.id_size', '=', 'size.id')
                ->select('purchase_details.id as id_purchase_detail', 'purchase_details.qty as purchase_detail_qty', 'product_details.id', 'product_details.size_qty as product_detail_qty', 'products.id as id_product')
                ->groupBy('product_details.id')
                ->get();
            
            Purchase_detail::where('id_purchase',$id)->delete(); 
            Purchase::destroy($id);
            foreach ($listSizeQty as $key => $value) {
                $thisProduct_detail = Product_detail::findOrFail($value->id);
                $thisProduct_detail->decrement('size_qty', $value->purchase_detail_qty);
                if ($thisProduct_detail->size_qty <= 0) //nếu số lượng = 0 thì xoá luôn product_detail đó (xoá mềm)
                {
                    $thisProduct_detail->size_qty = 0;
                    $thisProduct_detail->delete();
                }
                // Cập nhật số lượng trong bảng product
                    $totalQty = Product_detail::where('id_product', $value->id_product)->sum('size_qty');
                    $product = Product::find($value->id_product);
                    $product->total_qty = $totalQty;
                    $product->save();
            }
            
        return redirect()->back()->with('delete',__('Đã xoá đơn nhập thành công'));
    }





}
