@extends('layout')

@section('title', $product['name'])

@section('extra-css')

@endsection

@section('content')

<div class="breadcrumbs">
    <div class="container">
        <a href="{{route('home')}}">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <a href="{{route('shop.index')}}">Shop</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Macbook Pro</span>
    </div>
</div> <!-- end breadcrumbs -->

<div class="product-section container">
    <div>
        <div class="product-section-image">
            <img src="{{$product->getImagePath()}}" alt="product" id="currentImage">
        </div>
        @if($product->images)
        <div class="product-section-images">
            @foreach($product->getImageGalleryPaths() as $image)
            <div class="product-section-thumbnail {{ $loop->index == 0 ? 'selected' : ''  }}">
                <img src="{{$image}}" alt="">
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <div class="product-section-information">
        <h1 class="product-section-title">{{$product['name']}}</h1>
        <div class="product-section-subtitle">{{$product['details']}}</div>
        <div class="product-section-price">{{$product->getFormattedPrice()}}</div>
        <p>{!! $product['description'] !!}</p>
        <p>&nbsp;</p>
        <form action="{{route('cart.store')}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$product['id']}}">
            <input type="hidden" name="name" value="{{$product['name']}}">
            <input type="hidden" name="price" value="{{$product['price']}}">
            <button type="submit" class="button button-plain">Add to Cart</button>
        </form>
    </div>
</div> <!-- end product-section -->

@include('partials.might-like')


@endsection

@section('extra-js')
<script>
    (function(){
        const currentImage = document.querySelector('#currentImage');
        const images = document.querySelectorAll('.product-section-thumbnail');

        images.forEach((element)=> element.addEventListener('click', thumbnailClick))

        function thumbnailClick(e){
            currentImage.src = this.querySelector('img').src;
            images.forEach((element)=> element.classList.remove('selected'));
            this.classList.add('selected');
        }
    })();
</script>
@endsection