<?php

namespace App\Services\Back;

use App\Models\StockIn;
use App\Models\StockOut;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StockOutServices
{
    private StockOut $stockOutModel;
    private StockIn $stockInModel;

    public function __construct(StockIn $stockIn, StockOut $stockOut)
    {
        $this->stockOutModel = $stockOut;
        $this->stockInModel = $stockIn;
    }

    /**
     * @param array $validationData
     * @return JsonResponse
     * @throws Exception
     */
    public function storeStockOut(array $validationData): JsonResponse
    {

        try {
            DB::beginTransaction();

            $stockInId = $validationData['product'];
            $quantity = $validationData['exitCount'];

            $productId = $this->stockInModel::with(['product'])
                ->where('id', $stockInId)
                ->first()->product->id;

            $stockIns = $this->stockInModel::where('product_id', $productId)
                ->where('qty', '>', 0)
                ->orderBy('enter_date', 'asc')
                ->get();

            $remainQty = $quantity;

            foreach ($stockIns as $stockIn) {

                if ($remainQty <= 0) break;

                $availableQty = $stockIn->qty;

                $usedQty = min($availableQty, $remainQty);

                $this->createStockOutRecord($validationData, $stockIn->id, $usedQty);

                $stockIn->decrement('qty', $usedQty);
                $stockIn->increment('remain_qty', $usedQty);
                $remainQty -= $usedQty;
            }

            if ($remainQty > 0) {
                throw new Exception("Yetərli məhsul yoxdu: $remainQty ədəd  əksikdi.");
            }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        return response()->json(['success' => true]);

    }

    /**
     * @param $validationData
     * @param $stockInId
     * @param $usedQty
     * @return void
     */
    private function createStockOutRecord($validationData, $stockInId, $usedQty): void
    {
        $exitDate = Carbon::createFromFormat('m/d/Y', $validationData['date'])
            ->format('Y-m-d');

        $productName = $this->stockInModel::with(['product'])
            ->where('id', $validationData['product'])
            ->first()->product->product_name;

        $this->stockOutModel::create([
            'stock_in_id' => $stockInId,
            'warehouse_name' => $validationData['warehouse'],
            'product_name' => $productName,
            'category_name' => $validationData['category'],
            'model_name' => $validationData['model'],
            'customer_id' => $validationData['customer'],
            'product_img' => $validationData['image'],
            'product_description' => $validationData['description'],
            'product_code' => $validationData['code'],
            'qty' => $usedQty,
            'product_unit' => $validationData['unit'],
            'product_unit_sale_price' => $validationData['salesPrice'],
            'exit_date' => $exitDate,
        ]);
    }


    /**
     * @param array $validationData
     * @param string $id
     * @return JsonResponse
     * @throws Exception
     */
    public function updateStockOut(array $validationData, string $id): JsonResponse
    {
        $stockOut = $this->stockOutModel->findOrFail($id);

        $oldQty = $stockOut->qty;
        $differance = $validationData['exitCount'] - $oldQty;


        $productName = $this->stockInModel::with(['product'])
            ->where('id', $stockOut->stock_in_id)
            ->first()->product->product_name;
        if (!$stockOut) {
            throw new ModelNotFoundException("Hər hansı məlumat tapılmadı");
        }
        $exitDate = Carbon::createFromFormat('m/d/Y', $validationData['date'])->format('Y-m-d');

        if ($differance > 0) {

            $stockIns = $this->stockInModel::where('product_id', $stockOut->product->id)
                ->where('qty', '>', 0)
                ->orderBy('enter_date', 'asc')
                ->get();
            $remainQty = $differance;

            foreach ($stockIns as $stockIn) {
                if ($remainQty <= 0) break;

                $availableQty = $stockOut->qty;
                if ($availableQty >= $remainQty) {
                    $stockIn->decrement('qty', $remainQty);
                    $remainQty = 0;
                } else {
                    $stockIn->decrement('qty', $availableQty);
                    $remainQty -= $availableQty;
                }
            }
            if ($remainQty > 0) {
                throw new Exception("Yetərli məhsul yoxdu: $remainQty ədəd  əksikdi.");
            }
        } elseif ($differance < 0) {
            $stockIn = $this->stockInModel::where('product_id', $stockOut->product->id)
                ->orderBy('enter_date', 'asc')
                ->get();

            if ($stockIn) {
                $stockIn->increment('qty', abs($differance));
            }
        }

        $stockOut->update([
            'stock_in_id' => $validationData['product'],
            'warehouse_name' => $validationData['warehouse'],
            'product_name' => $productName,
            'category_name' => $validationData['category'],
            'model_name' => $validationData['model'],
            'customer_id' => $validationData['customer'],
            'product_img' => $validationData['image'],
            'product_description' => $validationData['description'],
            'product_code' => $validationData['code'],
            'qty' => $validationData['exitCount'],
            'product_unit' => $validationData['unit'],
            'product_unit_sale_price' => $validationData['salesPrice'],
            'exit_date' => $exitDate,
        ]);

        return response()->json(['success' => true]);
    }

}
