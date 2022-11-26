<?php

namespace App\Services\Traits;

use App\Models\Address\AdministrativeRegion;
use App\Models\Address\District;
use App\Models\Address\Provinces;
use App\Models\Address\Ward;
use App\Models\AddresUser;
use App\Models\Product;
use App\Models\Category;
use App\Models\GalleryProducts;
use App\Models\Properties;
use App\Models\Species;
use App\Models\User;
use App\Repositories\Eloquents\AddresUserRepository;
use App\Repositories\Eloquents\CategoryRepository;
use App\Repositories\Eloquents\DistrictRepository;
use App\Repositories\Eloquents\GallerryRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\PropertiesRepository;
use App\Repositories\Eloquents\ProvincesRepository;
use App\Repositories\Eloquents\SpeciesRepository;
use App\Repositories\Eloquents\UserRepository;
use App\Repositories\Eloquents\VietnameseProvincesRepository;
use App\Repositories\Eloquents\WardRepository;
use App\Repositories\Interfaces\AddresUserRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\DistrictRepositoryInterface;
use App\Repositories\Interfaces\GallerryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\PropertiesRepositoryInterface;
use App\Repositories\Interfaces\ProvincesRepositoryInterface;
use App\Repositories\Interfaces\SpeciesRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\VietnameseRepositoryProvincesInterface;
use App\Repositories\Interfaces\WardRepositoryInterface;

trait RepositorySetup
{
    public function callApp()
    {

        $this->callRepositoryApp();
    }



    private function callRepositoryApp()
    {
        $this->app->singleton(GallerryRepositoryInterface::class, function () {
            return new GallerryRepository(new GalleryProducts());
        });

        $this->app->singleton(ProductRepositoryInterface::class, function () {
            return new ProductRepository(new Product());
        });

        $this->app->singleton(CategoryRepositoryInterface::class, function () {
            return new CategoryRepository(new Category());
        });

        $this->app->singleton(PropertiesRepositoryInterface::class, function () {
            return new PropertiesRepository(new Properties());
        });

        $this->app->singleton(SpeciesRepositoryInterface::class, function () {
            return new SpeciesRepository(new Species());
        });

        $this->app->singleton(UserRepositoryInterface::class, function () {
            return new UserRepository(new User());
        });

        $this->app->singleton(ProvincesRepositoryInterface::class, function () {
            return new ProvincesRepository(new Provinces());
        });

        $this->app->singleton(DistrictRepositoryInterface::class, function () {
            return new DistrictRepository(new District());
        });

        $this->app->singleton(WardRepositoryInterface::class, function () {
            return new WardRepository(new Ward());
        });

        $this->app->singleton(AddresUserRepositoryInterface::class, function () {
            return new AddresUserRepository(new AddresUser());
        });
    }
}