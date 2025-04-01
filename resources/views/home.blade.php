@extends('layouts.app')

@section('title', 'Главная')

@section('aside')
    @foreach($categories as $category)
        @include('group.partials.groupItem', ['group' => $category])
    @endforeach
@endsection

@section('content')
    <h1>Список товаров</h1>

    <!-- Форма для сортировки -->
    <form method="GET" action="{{ route('home') }}" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <select name="sort_by" class="form-select">
                    <option value="" disabled selected>Сортировать по</option>
                    <option value="price" {{ request('sort_by') === 'price' ? 'selected' : '' }}>По цене</option>
                    <option value="name" {{ request('sort_by') === 'name' ? 'selected' : '' }}>По названию</option>
                </select>
            </div>
            <div class="col-md-6">
                <select name="order" class="form-select">
                    <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>По возрастанию</option>
                    <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>По убыванию</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Применить</button>
    </form>

    <!-- Список товаров -->
    <div class="row">
        @foreach ($products as $product)

            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="{{ route('product.show', ['product' => $product->id]) }}">
                        <div class="card-body">
                            <h5>{{ $product->name }}</h5>
                            <p>Цена: {{ $product->price->price ?? 'Не указана' }}</p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>


    <div>
        {{ $products->links() }}
    </div>
@endsection
