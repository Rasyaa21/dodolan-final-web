<?php

namespace App\Providers;

use App\Http\Controllers\Admin\TransactionDetailController;
use App\Interfaces\ProductImageRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\PromoCodesRepositoryInterface as InterfacesPromoCodesRepositoryInterface;
use App\Interfaces\StoreRepositoryInterface;
use App\Interfaces\TransactionDetailRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\StoreRepository;
use App\Repositories\ImageProductRepository;
use App\Repositories\ProductImageRepository;
use App\Repositories\PromoCodeRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductImageRepositoryInterface::class, ProductImageRepository::class);
        $this->app->bind(InterfacesPromoCodesRepositoryInterface::class, PromoCodeRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(TransactionDetailRepositoryInterface::class, TransactionDetailController::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
