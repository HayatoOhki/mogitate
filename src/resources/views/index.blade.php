@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
<link rel="stylesheet" href="{{ asset('css/paginate.css') }}" />
@endsection

@section('content')
<div class="title__area">
    <div class="page__title">
        <h2>
            @if(\Request::get('keyword'))
            "{{ \Request::get('keyword') }}"の商品一覧
            @else
            商品一覧
            @endif
        </h2>
    </div>
    <div class="product__create--button">
        <a href="{{ route('products.create') }}">＋商品を追加</a>
    </div>
</div>
<div class="main__content">
    <aside>
        <form class="search__form" action="{{ route('products.search') }}" method="get">
            <input type="text" name="keyword" placeholder="商品名で検索" value="{{ \Request::get('keyword') }}">
            <button type="submit">検索</button>
            <p>価格順で表示</p>
            <div class="select__wrapper">
                <select name="sort_order" id="sort_order" onchange="submit(this.form)">
                    <option value="{{ \SortOrder::LIST['default'] }}" disabled @if(!\Request::get('sort_order')) selected @endif>価格で並べ替え</option>
                    <option value="{{ \SortOrder::LIST['higherPrice'] }}"@if(\Request::get('sort_order') === \SortOrder::LIST['higherPrice']) selected @endif>高い順に表示</option>
                    <option value="{{ \SortOrder::LIST['lowerPrice'] }}"@if(\Request::get('sort_order') === \SortOrder::LIST['lowerPrice']) selected @endif>低い順に表示</option>
                </select>
            </div>
        </form>
    </aside>
    <article>
        <div class="product__area">
            @foreach($products as $product)
            <div class="product__card">
                <a href="{{ route('products.detail', ['product_id' => $product->id]) }}">
                    <div class="product__card--image">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product__card--info">
                        <p>{{ $product->name }}</p>
                        <p>￥{{ number_format($product->price) }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        {{ $products
            ->appends([
                'keyword' => \Request::get('keyword'),
                'sort_order' => \Request::get('sort_order'),
                ])
            ->links() }}
    </article>
</div>
@endsection