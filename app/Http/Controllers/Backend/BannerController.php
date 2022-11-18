<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    private $URL_IMG_BANNER = 'image/banner';

    public function index()
    {
        $banner = Banner::orderBy('id_banner', 'desc')->get();
        return view('backend.page.banner.list-banner', compact('banner'));
    }


    public function create()
    {
        return view('backend.page.banner.add-banner');
    }


    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title_banner' => "required",
                'img_banner' => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
                'url_banner' => 'nullable|url',
                "order_banner" => 'nullable|integer',
            ],
            [
                'title_banner.required' => 'Chưa nhập tiêu đề !!',
                'img_banner.required' => 'Chưa chọn ảnh !!',
                'url_banner.url' => 'Phải là url !!',
                'order_banner.integer' => 'Phải là số !!',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $banner = new Banner();
        if ($request->hasFile('img_banner')) {
            $image = $request->file('img_banner');
            $filename = time() . '_' . rand(01, 99) . '_banner.' . $image->getClientOriginalExtension();
            $request->img_banner->move(public_path("$this->URL_IMG_BANNER"), $filename);
            $banner->img_banner = $filename;
        }
        $banner->title_banner = $request->title_banner;
        $banner->url_banner = $request->url_banner;
        $banner->slug_banner = $request->slug_banner;
        $banner->description_banner = $request->description_banner;
        $banner->status_banner = $request->status_banner;
        $banner->order_banner = $request->order_banner;
        $banner->save();
        return Redirect::route('admin.banner.list')->with('mes', 'Thêm thành công !!');
    }


    public function show(Banner $banner)
    {
        //
    }


    public function edit(Banner $banner, $id_banner)
    {
        $banner = Banner::find($id_banner);
        return view('backend.page.banner.edit-banner', compact('banner'));
    }


    public function update(Request $request, Banner $banner, $id_banner)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title_banner' => "required",
                'img_banner' => "image|mimes:jpeg,png,jpg,gif|max:2048",
                'url_banner' => 'nullable|url',
                "order_banner" => 'nullable|integer',
            ],
            [
                'title_banner.required' => 'Chưa nhập tiêu đề !!',
                'url_banner.url' => 'Phải là url !!',
                'order_banner.integer' => 'Phải là số !!',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $banner = Banner::find($id_banner);
        $banner->title_banner = $request->title_banner;
        $banner->url_banner = $request->url_banner;
        $banner->slug_banner = $request->slug_banner;
        $banner->description_banner = $request->description_banner;
        $banner->status_banner = $request->status_banner;
        $banner->order_banner = $request->order_banner;


        if ($request->hasFile('img_banner')) {
            $oldFilename = $banner->img_banner;
            if (File::exists(public_path("$this->URL_IMG_BANNER/$oldFilename"))) {
                File::delete(public_path("$this->URL_IMG_BANNER/$oldFilename"));
            }
            $image = $request->file('img_banner');
            $filename = time() . '_' . rand(01, 99) . '_img.' . $image->getClientOriginalExtension();
            $request->img_banner->move(public_path("$this->URL_IMG_BANNER"), $filename);
            $banner->img_banner = $filename;
        }
        $banner->save();
        return Redirect::route('admin.banner.list')->with('mes', 'Sửa thành công !!');
    }


    public function destroy(Banner $banner, $id_banner)
    {
        $ban = Banner::find($id_banner);
        if ($ban) {

            $oldFilename = $ban->img_banner;
            if (File::exists(public_path("$this->URL_IMG_BANNER/$oldFilename"))) {
                File::delete(public_path("$this->URL_IMG_BANNER/$oldFilename"));
            }
            Banner::destroy($id_banner);
        }
        return Redirect::route('admin.banner.list')->with('mes', 'Xóa thành công!!');
    }
}