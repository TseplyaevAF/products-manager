<?php


namespace App\Services;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductService {

    private function getStatusName($data) {
        if (isset($data['status'])) {
            if ($data['status'] == "on") {
                return config('products.statuses')['available']['name'];
            }
        } else {
            return config('products.statuses')['unavailable']['name'];
        }
    }

    private function getProductData($data) {
        $productData = [];

        if (isset($data['videoram'])) {
            $productData['videoram'] = $data['videoram'];
        }

        if (isset($data['ram_type'])) {
            $productData['ram_type'] = $data['ram_type'];
        }

        return $productData;
    }
    
    public function store($data) {
        try {
            DB::beginTransaction();

            $data['status'] = $this->getStatusName($data);
            $productData = $this->getProductData($data);
            
            $product = Product::firstOrCreate([
                'article' => $data['article'],
                'name' => $data['name'],
                'status' => $data['status'],
                'data' => json_encode($productData),
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
        return $product;
    }

    public function update($data, $product) {
        try {
            DB::beginTransaction();

            $data['status'] = $this->getStatusName($data);
            $productData = $this->getProductData($data);

            $product->update([
                'article' => $data['article'],
                'name' => $data['name'],
                'status' => $data['status'],
                'data' => json_encode($productData),
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }
}