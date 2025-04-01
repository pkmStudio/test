<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\IndexRequest;
use App\Models\Group;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index(IndexRequest $request)
    {
        $data = $request->validationData();
        return ProductService::index($data);
    }

    public function show(Product $product)
    {
        $group = $product->group;
        $breadcrumbs = $this->getBreadcrumbs($group);

        return view('product.show', compact('product', 'breadcrumbs'));
    }

    private function getBreadcrumbs(?Group $group)
    {
        $breadcrumbs = [];
        while ($group) {
            $breadcrumbs[] = $group;
            $group = $group->parent;
        }

        return array_reverse($breadcrumbs);
    }

}
