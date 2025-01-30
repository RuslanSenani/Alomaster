<?php

namespace App\Http\Controllers\Back;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class HelperController extends Controller
{


    public function getStockDetails(Request $request)
    {
        $validate = $request->validate([
            'stock_id' => 'required|integer|min:1',
        ]);


        if ($validate) {
            return getStock($validate['stock_id']);
        } else {
            return response()->json(['error' => 'Invalid request'], 400);
        }
    }

    public function getProductDetails(Request $request)
    {
        $validate = $request->validate([
            'product_id' => 'required|integer|min:1',
        ]);


        if ($validate) {
            return getProduct($validate['product_id']);
        } else {
            return response()->json(['error' => 'Invalid request'], 400);
        }
    }


}
