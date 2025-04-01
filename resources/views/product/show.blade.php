@extends('layouts.app')

@section('title', 'Карточка товара: ' . $product->name)

@section('content')
    <div class="product-card">
        <!-- Хлебные крошки -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach ($breadcrumbs as $breadcrumb)
                    <li class="breadcrumb-item">
                        <a href="{{ route('group.index.products', ['group' => $breadcrumb->id]) }}">
                            {{ $breadcrumb->name }}
                        </a>
                    </li>
                @endforeach
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <!-- Информация о товаре -->
        <h1>{{ $product->name }}</h1>
        <p>Цена: {{ $product->price->price ?? 'Не указана' }} руб.</p>
    </div>
@endsection
