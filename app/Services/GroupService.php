<?php

namespace App\Services;


use App\Models\Group;
use App\Models\Product;
use Illuminate\Support\Collection;

class GroupService
{
    public static function indexProducts(Group $group, array $data)
    {
        // Собираем детей
        $groupsIds = array_merge(
            [$group->id],
            self::getAllCategoryIdsRecursia($group->children)
        );

        // Инициализируем запрос к таблице товаров
        $query = Product::query();
        $query->join('prices', 'products.id', '=', 'prices.id_product')
            ->whereIn('id_group', $groupsIds);

        // Сортировка
        if (!empty($data['sort_by']) && $data['sort_by'] === 'price') {
            $query->orderBy('prices.price', $data['order'] ?? 'asc'); // Сортировка по цене
        } elseif (!empty($data['sort_by']) && $data['sort_by'] === 'name') {
            $query->orderBy('products.name', $data['order'] ?? 'asc'); // Сортировка по названию
        }

        // Пагинация с сохранением параметров сортировки
        return $query->select('products.*')->paginate(6)->appends([
            'sort_by' => $data['sort_by'],
            'order' => $data['order'],
        ]);
    }


    public static function getAllCategoryIdsRecursia(Collection $children)
    {
        $ids = $children->pluck('id')->toArray();

        foreach ($children as $child) {
            if ($child->children->isNotEmpty()) {
                $ids = array_merge($ids, self::getAllCategoryIdsRecursia($child->children));
            }
        }

        return $ids;
    }
}
