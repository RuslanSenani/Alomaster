<?php

namespace App\Http\Controllers\Back;

use App\Models\Front\FProduct;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class HelperController extends Controller
{

    private FProduct $productModel;

    public function __construct(FProduct $productModel)
    {
        $this->productModel = $productModel;
    }

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

    public function rankSetter(Request $request)
    {
        $data = $request->post('data');
        parse_str($data, $order);
        $items = $order['ord'];
        foreach ($items as $rank => $id) {
            $this->productModel::where('id', $id)->where('rank', '!=', $rank)->update(['rank' => $rank]);
        }
    }
}
