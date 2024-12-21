<?php


use App\Models\Product;
use App\Models\StockIn;
use Illuminate\Http\JsonResponse;

// Ajax  deyerlerini kontrol etmek ucun olan bolme sadece ajax deyerleri istifade  olunacaq


if (!function_exists('getStock')) {
    function getStock($id):JsonResponse
    {
        $stockList =StockIn::with(['product.unit', 'warehouse', 'category', 'model'])->findOrFail($id);

        if ($stockList) {
            return response()->json([
                'unit' => $stockList->product_unit,
                'description' => $stockList->product_desc,
                'image' => asset($stockList->product_img),
                'imagePath' => $stockList->product_img,
                'code' => $stockList->product_code,
                'warehouse' => $stockList->warehouse->name,
                'category' => $stockList->category->name,
                'model' => $stockList->model->name,
            ]);
        }
        return response()->json(['error' => 'Product not found'], 404);
    }
}


if(!function_exists('getProduct')){
    function getProduct($id):JsonResponse{


        $product =Product::with(['unit'])->findOrFail($id);

        if ($product) {
            return response()->json([
                'unit' => $product->unit->name,
                'description' => $product->product_description,
                'image' => asset($product->product_img),
                'imagePath' => $product->product_img,
                'code' => $product->product_code,
            ]);
        }
        return response()->json(['error' => 'Product not found'], 404);
    }
}
