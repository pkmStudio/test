<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProductController;
use App\Http\Requests\Product\IndexRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $groupController;
    protected $productController;

    public function __construct(GroupController $groupController, ProductController $productController)
    {
        $this->groupController = $groupController;
        $this->productController = $productController;
    }

    public function index(IndexRequest $request)
    {
        $categories = $this->groupController->index(); // Получаем категории
        $products = $this->productController->index($request); // Получаем товары

        return view('home', compact('categories', 'products')); // Передаём в представление
    }
}
