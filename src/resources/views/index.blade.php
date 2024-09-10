@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
<link rel="stylesheet" href="{{ asset('css/paginate.css') }}" />
@endsection

@section('content')
<div class="title__area">
    <div class="page__title">
        <h2>
            @isset($keyword)
            "{{ $keyword }}"の商品一覧
            @else
            商品一覧
            @endisset
        </h2>
    </div>
    <div class="product__create--button">
        <a href="{{ route('products.create') }}">＋商品を追加</a>
    </div>
</div>
<div class="main__content">
    <aside>
        <form class="search__form" action="{{ route('products.search') }}" method="post">
            @csrf
            <input type="text" name="keyword" placeholder="商品名で検索" @isset($keyword) value="{{ $keyword }}" @endisset>
            <button type="submit">検索</button>
            <p>価格順で表示</p>
            <select name="" id=""></select>
        </form>
    </aside>
    <article>
        <div class="product__area">
            @foreach($products as $product)
            <div class="product__card">
                <a href="{{ route('products.detail', ['product_id' => $product->id]) }}">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    <div class="product__card--info">
                        <p>{{ $product->name }}</p>
                        <p>￥{{ number_format($product->price) }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </article>
</div>
@endsection