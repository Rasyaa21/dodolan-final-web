<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\StoreRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private StoreRepository $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }
    public function index()
    {
        $stores = $this->storeRepository->getAllStores();

        return view('pages.admin.dashboard', compact('stores'));
    }
}

