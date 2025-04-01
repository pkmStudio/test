<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\IndexRequest;
use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class GroupController extends Controller
{
    public function index(): Collection
    {
        return Group::with('children')->where('id_parent', 0)->get();
    }

    public function show(Group $group): View
    {
        $group = Group::with('children')->findOrFail($group->id);
        return view('group.show', compact('group'));
    }

    public function indexProducts(Group $group, IndexRequest $request)
    {
        $data = $request->validationData();
        $children = $group->children;

        $products = GroupService::indexProducts($group, $data);
        return view('group.products.index', compact('children', 'group', 'products'));
    }
}
