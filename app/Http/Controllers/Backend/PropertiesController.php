<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertiesRequest;
use App\Http\Requests\SpeciesRequest;
use App\Repositories\Interfaces\PropertiesRepositoryInterface;
use App\Repositories\Interfaces\SpeciesRepositoryInterface;
use App\Services\Traits\TResponse;
use Illuminate\Support\Facades\DB;

class PropertiesController extends Controller
{
    use TResponse;
    public function __construct(
        private PropertiesRepositoryInterface $propertiesRepo,
        private SpeciesRepositoryInterface $speciesRepo,
        private DB $db
    ) {
    }

    public function index()
    {
        $propertiesGetRquest = null;
        $properties = $this->propertiesRepo->getListAdmin();
        if (request()->has('properties')) {
            $propertiesGetRquest = $this->propertiesRepo->whereSlug(request('properties'));
        }
        return view('pages.properties.list', [
            'properties' => $properties,
            'propertiesGetRquest' => $propertiesGetRquest
        ]);
    }

    public function storeProperties(PropertiesRequest $request, Str $str)
    {
        // dd($request->all());
        $this->db::beginTransaction();
        try {
            $this->propertiesRepo->create([
                'name' => $request->name,
                'slug' => $str::slug($request->name),
            ]);
            $this->db::commit();
            return redirect()->back()->with('success', "Thêm thuộc tính :  $request->name  thành công !!");
        } catch (\Throwable $th) {
            //throw $th;
            $this->db::rollBack();
            return abort(500);
        }
    }

    public function storeSpecies(SpeciesRequest $request, Str $str)
    {
        $this->db::beginTransaction();
        try {
            if (request()->has('type') && request()->has('properties') && request('type') == 'species') {
                $properties = $this->propertiesRepo->whereSlug(request('properties'));
                if (!$properties) return redirect()->back()->with('error', "Lỗi !!");
                $this->speciesRepo->create(
                    [
                        'name' => $request->name,
                        'describe' => $request->describe,
                        'slug' => $str::slug($request->name),
                        'properties_id' => $properties->id
                    ]
                );
            } else {
                return redirect()->back()->with('error', "Lỗi !!");
            }
            $this->db::commit();
            return redirect()->back()->with('success', "Thêm giá trị thuộc tính thành công !!");
        } catch (\Throwable $th) {
            $this->db::rollBack();
            return abort(500);
        }
    }

    public function updateProperties(PropertiesRequest $request, $id, Str $str)
    {

        $this->db::beginTransaction();
        try {
            $this->propertiesRepo->find($id)->update([
                'name' => $request->name,
                'slug' => $str::slug($request->name),
            ]);
            $this->db::commit();
            return redirect()->route('admin.properties.list')->with('success', "Chỉnh sửa thuộc tính :  $request->name  thành công !!");
        } catch (\Throwable $th) {
            $this->db::rollBack();
            return abort(500);
        }
    }

    public function destroyProperties(Request $request)
    {
        $this->propertiesRepo->delete($request->id);
        return $this->responseApi(true, 'Xóa thành công !', ['urlTo' => route('admin.properties.list')]);
    }

    public function  destroySpecies(Request $request)
    {
        $this->speciesRepo->delete($request->id);
        return $this->responseApi(true, 'Xóa thành công !');
    }

    public function showSpecies()
    {
        if (!request()->has('id')) return $this->responseApi(true, ['error' => 'Lỗi !']);
        $species = $this->speciesRepo->find(request('id'));
        if (!$species) return $this->responseApi(true, ['error' => 'Lỗi !']);
        return $this->responseApi(true, $species);
    }

    public function updateSpecies(SpeciesRequest $request)
    {
        $this->db::beginTransaction();
        try {
            $species = $this->speciesRepo->find($request->id);
            if ($species) {
                $species->update($request->all());
            }
            $this->db::commit();
            return $this->responseApi(true, 'Cập nhập thành công !!');
        } catch (\Throwable $th) {
            $this->db::rollBack();
            return $this->responseApi(true, ['error' => 'Lỗi !']);
        }
    }
}