<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CateProduct;
use App\Models\Product;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Traits\TResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use TResponse;
    private $categoryModel;
    private $productModel;
    public function __construct(
        Category $category,
        Product $product,
        private CategoryRepositoryInterface $categoryRepositoryInterface
    ) {
        $this->categoryModel = $category;
        $this->productModel = $product;
    }
    public function queryCategory()
    {
        $data = $this->categoryModel::query();
        $data->orderBy('order', 'desc');
        $data->where('status', config('util.ACTIVE_STATUS'));
        return $data;
    }
    public function getParent()
    {
        $datas = $this->categoryRepositoryInterface->getListApi();
        return $this->sendResponse($datas, trans('message.success'));
        // $categorys = $this->queryCategory()->parentCategory()->get();
        // return response()->json([
        //     'status' => true,
        //     'payload' =>   $categorys,
        // ]);
    }
    public function getCategoryProduct($slug)
    {
        $cateArray = [];
        $proId = [];
        $categoryParent_id = $this->queryCategory()->where('slug', $slug)->first()->id;
        if (is_null($categoryParent_id)) {
            return response()->json([
                'status' => false,
                'payload' =>  'Không tồn tại trên hệ thống !!',
            ]);
        } else {
            array_push($cateArray, $categoryParent_id);
        }
        $cateChilds = $this->queryCategory()->where('parent_id',  $categoryParent_id)->get('id');
        if (count($cateChilds) > 0) {
            foreach ($cateChilds as  $cateChild) {
                array_push($cateArray, $cateChild->id);
            }
        }

        $categoryPros = $this->categoryModel::whereIn('id', $cateArray)->with('products')->get();

        foreach ($categoryPros as $catePro) {
            if ($catePro->products) {
                foreach ($catePro->products as $product) {
                    array_push($proId, $product->id);
                }
            }
        }

        $products = $this->productModel::whereIn('id', $proId)->paginate(50);
        // dd($products->toArray());
        return response()->json([
            'status' => true,
            'payload' => $products,
        ]);


        ///////////////////////



        // $cateArray = [];
        // $categoryParent_id = $this->queryCategory()->where('slug', $slug)->first()->id;
        // if (is_null($categoryParent_id)) {
        //     return response()->json([
        //         'status' => false,
        //         'payload' =>  'Không tồn tại trên hệ thống !!',
        //     ]);
        // } else {
        //     array_push($cateArray, $categoryParent_id);
        // }
        // $cateChilds = $this->queryCategory()->where('parent_id',  $categoryParent_id)->get('id');
        // if (count($cateChilds) > 0) {
        //     foreach ($cateChilds as  $cateChild) {
        //         array_push($cateArray, $cateChild->id);
        //     }
        // }
        // $categoryId = $this->categoryModel::whereIn('id', $cateArray)->with('products')->get();
        // dd($categoryId->toArray());
        // try {
        //     //code...
        //     $catePro = CateProduct::whereIn('category_id', $cateArray)->get()->load('products');
        //     dd($catePro->toArray());
        // } catch (\Throwable $th) {
        //     dd($th);
        // }
    }
}