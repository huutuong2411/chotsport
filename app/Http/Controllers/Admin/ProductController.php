<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Product_detail;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use App\Models\admin\Size;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return view ('admin.product.product', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    
        $brand=Brand::select('id','name')->get();
        $category=Category::select('id','name')->get();
        return view ('admin.product.addProduct',compact('brand','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // xử lý ajax trả về size của brand
        if(!empty($request->id_brand)) {
        $size= Brand::find($request->id_brand)->Size;
        return response()->json($size);
        }
        $product = new Product();
        $product->name= $request->name;
        $product->id_brand= $request->brand;
        $product->id_category= $request->category;
        $product->price= $request->price;
        $product->description= $request->description;
        $product->total_qty= $request->total;

        // nếu có discount thì lưu | không thì set = 0
        if(!empty($request->discount)){                  
            $product->discount= $request->discount;
        }else {
            $product->discount= 0;
        }
        // xử lý hình ảnh: 
        if($request->hasfile('image'))
        {
            foreach ($request->file('image') as $image) 
            {
               $time= time();
               $name = $time."_".$image->getClientOriginalName();
               // lưu tên ảnh vào mảng
               $data[] = $name;
            }
        }
        // json mảng và lưu vào product (hàn array_values để set thành mảng mới loại bỏ chỉ mục)
        $product->image = json_encode(array_values($data));
        if($product->save()){
            // lấy id product và lưu hình ảnh
            $id= $product->id;
            foreach ($request->file('image') as $image){
                $image->move(public_path('/admin/assets/img/product/'.$id), time()."_".$image->getClientOriginalName());
            }

            // xử lý lưu số lượng size vào product_detail nếu admin có điền vào
            foreach ($request->all() as $key => $value) {
                if (strpos($key,'size_qty_') === 0 && !empty($value)) {
                    // Lấy id_size từ tên của input
                    $id_size = str_replace('size_qty_', '', $key);
                    // Xử lý dữ liệu tương ứng với id_size
                    $quantity = $value;
                   
                    $product->Product_detail()->create([
                        'id_size' => $id_size,
                        'id_product' => $id,
                        'size_qty' => $quantity,
                    ]);
                }
            }

            return redirect()->route('admin.product')->with('success',__('Thêm sản phẩm thành công')); 
        } else {
            return redirect()->route('admin.product')->withErrors('Thêm sản phẩm không thành công');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if($product){
        $category= $product->Category->name;
        $brand= $product->Brand->name;
        $listsize=   Product_detail::where('id_product', $id)->join('size', 'id_size', '=', 'size.id')
        ->select('size.size','product_details.size_qty')
        ->get();
        return view('admin.product.productDetail',compact('product','category','brand','listsize'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product= Product::find($id);
        $brand=Brand::select('id','name')->get();
        $category=Category::select('id','name')->get();
        //  lấy các size của brand đó
        $size= $product->Brand->Size()->select('id','size')->get();
        //lấy list size kèm số lượng của product đó
        $listsize=  Product_detail::where('id_product', $id)->join('size', 'id_size', '=', 'size.id')
        ->select('size.id','product_details.size_qty')
        ->get();
        return view('admin.product.editProduct',compact('product','brand','category','size','listsize'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $product = Product::find($id);
        $product->name= $request->name;
        $product->id_brand= $request->brand;
        $product->id_category= $request->category;
        $product->price= $request->price;
        $product->description= $request->description;
        $product->total_qty= $request->total;
        // nếu có discount thì lưu | không thì set = 0
        if(!empty($request->discount)){                  
            $product->discount= $request->discount;
        }else {
            $product->discount= 0;
        }
        // xử lý hình ảnh: 
        $delete=json_decode($request->delete); // lấy ảnh cần xoá
        $oldimage=json_decode($product->image); // ảnh cũ lấy từ dtb ra
        // xóa ảnh đã chọn (nếu có)
        if(!empty($delete))
        {
            foreach ($oldimage as $key => $value) 
            {     
                if (in_array($value,$delete)) 
                {
                      unset($oldimage[$key]);
                      if (file_exists('admin/assets/img/product/'.$id.'/'.$value))
                      {
                        unlink('admin/assets/img/product/'.$id.'/'.$value);
                      }
                }   
            }
        } 
        // thêm ảnh mới (nếu có)
        if($request->hasfile('image'))
        {
            foreach ($request->file('image') as $image) 
            {
               $time= time();
               $name = $time."_".$image->getClientOriginalName();
               // move ảnh vào thư mục cũ
               $image->move(public_path('/admin/assets/img/product/'.$id),$name);
               // lưu tên ảnh vào mảng
               $oldimage[] = $name;
            }
        }
        $product->image = json_encode(array_values($oldimage));

        if($product->update()){
            // xử lý lưu số lượng size vào product_detail nếu admin có điền vào
            $product->Product_detail()->delete();
            $list_productdetail = Product_detail::onlyTrashed()->where('id_product', $id)->pluck('id_size')->toArray();

            foreach ($request->all() as $key => $value) 
            {  
                if (strpos($key, 'size_qty_') === 0 && !empty($value)) {
                    // Lấy id_size từ tên của input
                    $id_size = str_replace('size_qty_', '', $key);
                    // Xử lý dữ liệu tương ứng với id_size 
                    $quantity =$value;
                    if(in_array($id_size,$list_productdetail)){
                        Product_detail::withTrashed()->where('id_product', $id)->where('id_size', $id_size)->restore(); //khôi phục lại dữ liệu
                    } 
                    $product->Product_detail()->updateOrCreate(
                        [
                            'id_size' => $id_size,
                            'id_product' => $id,
                        ],
                        [
                            'id_size' => $id_size,
                            'id_product' => $id,
                            'size_qty' => $quantity,
                        ]); // lưu hoặc cập nhật       
                } 
            }
            return redirect()->route('admin.product')->with('success',__('Sửa sản phẩm thành công')); 
        } else {
            return redirect()->route('admin.product')->withErrors('Sửa sản phẩm không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect()->back()->with('delete',__('Đã xoá sản phẩm thành công'));
    }

    // thùng rác
    public function trash()
    {
        $trash=Product::onlyTrashed()->get();
        return view('Admin.product.trash',compact('trash'));
    }
    // khôi phục 
    public function restore(string $id)
    {
        Product::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success',__('khôi phục thành công')); 
    }
}
