<?php

namespace App\Services;

use App\Http\Requests\Product\IndexRequest;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public static function index($data): LengthAwarePaginator
    {
        $query = Product::query();
        $query->join('prices', 'products.id', '=', 'prices.id_product');

        // Сортировка
        if ($data['sort_by'] === 'price') {
            $query->orderBy('prices.price', $data['order'] ?? 'asc'); // Сортируем по price
        } elseif ($data['sort_by'] === 'name') {
            $query->orderBy('products.name', $data['order'] ?? 'asc'); // Сортируем по name
        }

        // Пагинация с сохранением параметров сортировки
        $products = $query->select('products.*')->paginate(6)->appends([
            'sort_by' => $data['sort_by'],
            'order' => $data['order'],
        ]);

        return $products;
    }
}
