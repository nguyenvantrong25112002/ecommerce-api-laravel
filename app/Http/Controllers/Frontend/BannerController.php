<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    private $bannerModel;
    public function __construct(Banner $banner)
    {
        $this->bannerModel = $banner;
    }
    protected function getListBanner()
    {
        $data = $this->bannerModel::query();
        $data->where('status', config('util.ACTIVE_STATUS'));
        return $data;
    }
    public function getBannerHome()
    {
        $banners = $this->getListBanner()->orderByDesc('id')->get();
        return response()->json([
            'status' => true,
            'payload' =>  $banners,
        ]);
    }
}