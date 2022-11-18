<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CateProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $categoryModel;
    private $productModel;
    public function __construct(Category $category, Product $product)
    {
        $this->categoryModel = $category;
        $this->productModel = $product;
    }
    protected  function listProduct()
    {
        $data = $this->productModel::query();
        $data->select(['id', 'name', 'image', 'price', 'price_sale', 'sale_off', 'view', 'slug'])->inRandomOrder();
        $data->where('status', config('util.ACTIVE_STATUS'));
        return $data;
    }
    public function getProductNewHome()
    {
        $products = $this->listProduct()->orderBy('id', 'DESC')->limit(5)
            ->get();
        return response()->json([
            'status' => true,
            'payload' =>  $products,
        ]);
    }

    public function getProductSaleHome()
    {
        $products = $this->listProduct()
            ->where('sale_off', '>', 0)->orderBy('sale_off', 'DESC')
            ->limit(8)
            ->get();
        return response()->json([
            'status' => true,
            'payload' =>  $products,
        ]);
    }

    public function testUpfile(Request $request)
    {
        # code...
    }

    protected function show($slug)
    {
        try {
            $data = $this->productModel::whereSlug($slug)
                ->first()
                ->load(['gallerys', 'properties', 'species']);
        } catch (\Throwable $th) {
            dd($th);
        }
        return $data;
    }
    public function detailProduct($slug)
    {
        $products = $this->show($slug);
        if (is_null($products)) {
            return response()->json([
                'status' => false,
                'payload' => 'Không tồn tại !!',
            ]);
        }
        return response()->json([
            'status' => true,
            'payload' => $products,
        ]);
    }
    public function productRelateTo($slug)
    {
        $proId = [];
        $id = $this->productModel::where('slug', $slug)->first()->id;
        $idcate = CateProduct::where('product_id', $id)->pluck('category_id');
        $categoryPros = $this->categoryModel::whereIn('id',  $idcate)->with('products')->get();
        foreach ($categoryPros as $catePro) {
            if ($catePro->products) {
                foreach ($catePro->products as $product) {
                    array_push($proId, $product->id);
                }
            }
        }
        $products = $this->productModel::select(
            'name',
            'slug',
            'image',
            'price',
            'price_sale',
            'sale_off',
            'quantity',
            'status',
        )
            ->whereIn('id', $proId)->paginate(5);
        return response()->json([
            'status' => true,
            'payload' => $products,
        ]);
    }
}