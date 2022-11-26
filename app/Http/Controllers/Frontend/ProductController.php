<?php

namespace App\Http\Controllers\Frontend;

use App\Exceptions\NotFoundApiException;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CateProduct;
use App\Models\Product;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Traits\TResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use TResponse;
    public function __construct(
        private ProductRepositoryInterface $productRepositoryInterface,
        private CategoryRepositoryInterface $categoryRepositoryInterface
    ) {
    }

    public function getProductNewHome()
    {
        $datas = $this->productRepositoryInterface->getNew();
        return $this->sendResponse($datas, trans('message.success'));
    }

    public function getProductSaleHome()
    {
        $datas = $this->productRepositoryInterface->getSale();
        return $this->sendResponse($datas, trans('message.success'));
    }

    public function detailProduct($slug)
    {
        $data = $this->productRepositoryInterface->showApi($slug);
        if (is_null($data)) throw new NotFoundApiException();
        return $this->sendResponse($data, trans('message.success'));
    }

    public function productRelateTo($slug)
    {
        $proId = [];
        $product = $this->productRepositoryInterface->whereSlug($slug)->load('categorys:id');
        $idcate = $product->categorys->map(function ($value) {
            return $value->id;
        });
        $categoryPros = $this->categoryRepositoryInterface->findMany($idcate)->load('products:id');
        foreach ($categoryPros as $catePro) {
            if ($catePro->products)  foreach ($catePro->products as $product) {
                array_push($proId, $product->id);
            }
        }
        $datas = $this->productRepositoryInterface->getExceptInByID($product->id, $proId);
        return $this->sendResponse($datas, trans('message.success'));
    }
}