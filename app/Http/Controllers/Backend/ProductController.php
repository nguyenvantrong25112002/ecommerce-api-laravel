<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Gallery;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\Traits\TResponse;
use Illuminate\Support\Facades\DB;
use App\Events\File\DeleteFileEvent;

use App\Http\Controllers\Controller;
use App\Services\Traits\TUploadFile;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Redirect;
use App\Events\Admin\CreateGalleryProductEvent;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\GallerryRepositoryInterface;
use App\Repositories\Interfaces\PropertiesRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use TUploadFile, TResponse;
    public function __construct(
        private DB $db,
        private CategoryRepositoryInterface $categoryRepo,
        private ProductRepositoryInterface $productRepo,
        private GallerryRepositoryInterface $galleryRepo,
        private PropertiesRepositoryInterface $propertiesRepo,
    ) {
    }
    private function getCategoryParent()
    {
        return  $this->categoryRepo->getParent();
    }

    public function index()
    {
        $categoryParent = $this->getCategoryParent();
        $products = $this->productRepo->loadListAdmin();
        return view(
            'pages.product.list-product',
            [
                'products' => $products,
                'categoryParent' => $categoryParent
            ]
        );
    }

    public function create()
    {
        $categoryParent = $this->getCategoryParent();
        return view(
            'pages.product.add-product',
            [
                'categoryParent' => $categoryParent
            ]
        );
    }

    public function store(ProductRequest $request)
    {
        $this->db::beginTransaction();
        try {
            $filename =   $this->uploadFile($request->file('image'));
            if (!$filename) {
                return redirect()->back()->with('error', "Lỗi thêm ảnh !!");
            }
            $product = $this->productRepo->create([
                'name' => $request->name,
                'slug' => $request->slug,
                'image' =>  $filename,
                'price' => $request->price,
                'price_sale' => $request->price_sale,
                'sale_off' => $request->sale_off,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'details' => $request->details,
                'status' => $request->status,
            ]);
            $product->categorys()->syncWithoutDetaching($request->category_id);
            if (isset($request->gallerys) && $product) {
                event(new CreateGalleryProductEvent($request->gallerys, $product->id));
            }
            $this->db::commit();
            return redirect()->route('admin.product.list')->with('success', "Thêm sản phẩm :  $request->name  thành công !!");
        } catch (\Throwable $th) {
            $this->db::rollBack();
            event(new DeleteFileEvent($filename));
            return abort(500);
        }
    }


    public function show($id)
    {
        $product = $this->productRepo->find($id)
            ->load([
                'gallerys',
                'properties',
                'properties.species',
                'species'
            ]);
        // dd($product->toArray());
        $properties = $this->propertiesRepo->all();
        $properties_id = $product->properties->map(function ($value) {
            return $value->id;
        });
        $species_id = $product->species->map(function ($value) {
            return $value->id;
        });
        return view('pages.product.details-product', [
            'product' => $product,
            'properties' => $properties,
            'properties_id' => $properties_id,
            'species_id' => $species_id,
        ]);
    }

    public function listGallery($id)
    {
        $product = $this->productRepo->find($id);
        if (!$product) return $this->responseApi(false, 'Đã xảy ra lỗi !!');
        return $this->sendResponse($product->gallerys()->get(), 'Thành công !!');
    }

    public function addGallery(Request $request, $id)
    {
        $product = $this->productRepo->find($id);
        if (!$product) return $this->responseApi(false, 'Đã xảy ra lỗi !!');
        $this->db::beginTransaction();
        try {
            foreach ($request->image as  $image) {
                $filename =   $this->uploadFile($image);
                if (!$filename) return $this->responseApi(false, 'Đã xảy ra lỗi !!');
                $this->galleryRepo->create([
                    'product_id' => $id,
                    'order' => 0,
                    'image' => $filename,
                ]);
            }
            $this->db::commit();
            return $this->sendResponse($product->gallerys()->get(), 'Thêm thành công !!');
        } catch (\Throwable $th) {
            $this->db::rollBack();
            event(new DeleteFileEvent($filename));
            return $this->responseApi(false, 'Đã xảy ra lỗi !!');
        }
    }

    public function removeGallery(Request $request)
    {
        $gallery =  $this->galleryRepo->find($request->id);
        if (!$gallery) return $this->responseApi(false, 'Đã xảy ra lỗi !!');
        event(new DeleteFileEvent($gallery->image));
        $gallery->delete();
        return $this->responseApi(true, 'Xóa thành công !');
    }

    public function edit($id)
    {
        $product = $this->productRepo->find($id)->load(['gallerys', 'categorys:id']);
        if (is_null($product)) return abort(404);
        $category_id = [];
        foreach ($product->categorys as $key => $value) {
            array_push($category_id, $value->id);
        }
        $categoryParent = $this->getCategoryParent();
        return view('pages.product.edit-product', compact(
            'product',
            'categoryParent',
            'category_id'

        ));
    }

    public function update(ProductRequest $request, $id_product)
    {
        $this->db::beginTransaction();
        try {
            $product = $this->productRepo->find($id_product);
            if ($product) {
                $product->name = $request->name;
                $product->slug = $request->slug;
                $product->price = $request->price;
                $product->price_sale = $request->price_sale;
                $product->sale_off = $request->sale_off;
                $product->quantity = $request->quantity;
                $product->description = $request->description;
                $product->details = $request->details;
                $product->status = $request->status;
                if ($request->hasFile('image')) {
                    $img = $this->uploadFile($request->file('image'), $product->image);
                    if (!$img) {
                        return redirect()->back()->with('error', "Lỗi cập nhập ảnh !!");
                    }
                    $product->image =  $img;
                }
                $product->save();
                $product->categorys()->sync($request->category_id);
                $this->db::commit();
                return redirect()->route('admin.product.list')->with('success', 'Cập nhật thành công !!');
            } else {
                return abort(404);
            }
        } catch (\Throwable $th) {
            $this->db::rollBack();
            //throw $th;
            return abort(500);
        }
    }

    public function destroy(Product $product)
    {
    }



    public function addProperties(Request $request, $id_product)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "properties.*"  => "required|integer",
            ]
        );
        if ($validator->fails()) return $this->sendResponseError('Lỗi validation', $validator->errors(), Response::HTTP_BAD_REQUEST);

        $product = $this->productRepo->find($id_product);
        $product->properties()->sync($request->properties);
        $product->save();
        return $this->sendResponse('', 'Cập nhập thành công !');
    }

    public function addSpecies(Request $request, $id_product)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "species.*"  => "required|integer",
            ]
        );
        if ($validator->fails()) return $this->sendResponseError('Lỗi validation', $validator->errors(), Response::HTTP_BAD_REQUEST);
        $product = $this->productRepo->find($id_product);
        $product->species()->sync($request->species);
        $product->save();
        return $this->sendResponse('', 'Cập nhập thành công !');
    }

    public function listSpeciesProduct($id)
    {
        $product = $this->productRepo->find($id)
            ->load([
                'properties',
                'properties.species',
                'species'
            ]);
        $species_id = $product->species->map(function ($value) {
            return $value->id;
        });
        return $this->sendResponse([
            'properties' => $product->properties,
            'species_id' => $species_id
        ], 'Thành công !');
    }
}