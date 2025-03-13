<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get(); // Lấy sản phẩm kèm theo thông tin danh mục
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getByCategory($categoryId)
    {
        // Lấy tất cả sản phẩm thuộc danh mục với categoryId
        $products = Product::where('category_id', $categoryId)->get();
        return response()->json($products);
    }

    public function getRelatedProducts($id)
    {
        // Tìm sản phẩm hiện tại
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }

        // Giả sử sản phẩm liên quan là cùng danh mục
        $relatedProducts = Product::where('category_id', $product->category_id)
                                  ->where('id', '!=', $id)
                                  ->take(4) 
                                  ->get();

        return response()->json($relatedProducts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);
    
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
    
        // Lưu ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = asset('storage/' . $imagePath);  // Trả về URL của ảnh
        }
    
        $product->save();
        return response()->json($product, 201); // Trả lại sản phẩm với thông tin đã lưu
    }

    // Hàm cập nhật sản phẩm
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'category_id' => 'required|integer|exists:categories,id',
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
    ]);

    $product = Product::findOrFail($id);

    $product->category_id = $validated['category_id'];
    $product->name = $validated['name'];
    $product->description = $validated['description'];
    $product->price = $validated['price'];
    $product->quantity = $validated['quantity'];

    if ($request->hasFile('image')) {
        // Xóa ảnh cũ nếu có
        if ($product->image) {
            Storage::disk('public')->delete(str_replace(asset('storage/'), '', $product->image));
        }

        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = asset('storage/' . $imagePath);
    }

    $product->save();

    return response()->json($product, 200);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->find($id); // Lấy sản phẩm và thông tin danh mục
        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }
        return response()->json($product);
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
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
