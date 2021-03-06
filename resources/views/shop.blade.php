@extends('layout')

@section('title', 'Products')

@section('extra-css')

@endsection

@section('content')

<x-breadcrumbs>
    <a href="{{route('landing')}}">Home</a>
    <i class="fa fa-chevron-right breadcrumb-separator"></i>
    <span>Shop</span>
</x-breadcrumbs>

<div class="products-section container">
    <div class="sidebar">
        <h3>By Category</h3>
        <ul>
            @foreach($categories as $category)
            <li class="{{ setActiveItem(request()->category, $category['slug']) }}"><a href="{{ route('shop.index', ['category' => $category['slug']]) }}">{{$category['name']}}</a></li>
            @endforeach
        </ul>
    </div> <!-- end sidebar -->
    <div>
        <div class="products-header">
            <h1 class="stylish-heading">{{$categoryName}}</h1>
            <div class="price-sort-options">
                <span class="font-weight-bold">Price:</span>
                <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'low_high']) }}">Low to High</a> |
                <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'high_low']) }}">High to Low</a>
            </div>
        </div>

        <div class="products text-center">
            @forelse($products as $product)
            <div class="product">
                <a href="{{route('shop.show', $product['slug'])}}"><img src="{{$product->getImagePath()}}" alt="product"></a>
                <a href="{{route('shop.show', $product['slug'])}}">
                    <div class="product-name">{{$product['name']}}</div>
                </a>
                <div class="product-price">{{$product->getFormattedPrice()}}</div>
            </div>
            @empty
            <div class="text-left">No items found</div>
            @endforelse
        </div> <!-- end products -->
        {{ $products->appends(request()->input())->links() }}
    </div>
</div>


@endsection

@section('extra-js')
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{ asset('js/algolia-client.js') }}"></script>
@endsection