<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{

    public function __construct(
        private CategoryRepositoryInterface $categoryRepo,
        protected DB $db
    ) {
    }


    private function getCategoryParent()
    {
        return  $this->categoryRepo->getParent();
    }

    public function index()
    {
        try {
            $categorys = $this->categoryRepo->getListAdmin();
        } catch (\Throwable $th) {
            dd($th);
        }
        return view('pages.category.list-category', [
            'categoryParent' => $categorys
        ]);
    }



    public function create()
    {
        $categoryParent = $this->getCategoryParent();
        return view('pages.category.add-category', compact('categoryParent'));
    }


    public function store(CategoryRequest $request)
    {

        $this->db::beginTransaction();
        try {
            $this->categoryRepo->create($request->all());
            $this->db::commit();
            return redirect()->route('admin.category.list');
        } catch (\Throwable $th) {
            $this->db::rollBack();
            return abort(500);
        }
    }


    public function show(Category $category)
    {
    }


    public function edit(Category $category, $id)
    {
        // dd($category::whereSlug('nguyen-van-trong-dx')->firstOrFail()->toArray());
        $category = $this->categoryRepo->find($id);
        $categoryParent = $this->getCategoryParent();
        if (!$category) {
            return redirect()->back()->with('error', 'Lỗi không tìm được id!!!');
        }
        return view('pages.category.edit-category', compact(
            'categoryParent',
            'category',
        ));
    }

    public function update(CategoryRequest $request, $id, Str $str)
    {
        $category = $this->categoryRepo->find($id);

        if ($category->id > $request->parent_id || $category->id < $request->parent_id) {
            $category->parent_id = $request->parent_id;
        } else {
            return redirect()->back()->with('error', 'Không thể làm cha của chính nó!!!');
        }
        $category->slug = $str::slug($request->name);
        $category->fill($request->all());
        $category->save();
        return redirect()->route('admin.category.list')->with('mes', 'Sửa thành công!!!');
    }


    public function destroy(Category $category, $id_category)
    {
        if ($id_category == null && !$id_category) {
            return redirect()->back()->with('error', 'Lỗi không tìm được id!!!');
        }
        $category = Category::find($id_category);
        if (!$category) {
            return redirect()->back()->with('error', 'Lỗi không tìm được id!!!');
        }

        if ($category->parent_id >= 0) {
            Category::where('parent_id', $category->id_category)->delete();
        }
        Category::destroy($id_category);
        return redirect()->back()->with('mes', 'Xóa thành công!!!');
    }


    public function destroyAll(Request $request, Category $category, $id_category)
    {
        // if (!empty($request->id_categorys)) {
        print_r($request->id_categorys);
        // }
        // die;
        // if ($id_category == null && !$id_category) {
        //     return redirect()->back()->with('error', 'Lỗi không tìm được id!!!');
        // }
        // $category = Category::find($id_category);
        // if (!$category) {
        //     return redirect()->back()->with('error', 'Lỗi không tìm được id!!!');
        // }

        // if ($category->parent_id >= 0) {
        //     Category::where('parent_id', $category->id_category)->delete();
        // }
        // Category::destroy($id_category);
        // return redirect()->back()->with('mes', 'Xóa thành công!!!');
    }
}