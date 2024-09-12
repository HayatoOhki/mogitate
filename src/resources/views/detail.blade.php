@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
<form class="update__form" action="{{ route('products.update', ['product_id' => $product->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form__link">
        <a href="{{ route('products.index') }}">商品一覧</a>
        <span>>{{ $product->name }}</span>
    </div>
    <div class="separate__content">
        <div class="left__side">
            <div class="form__item">
                <input class="form__file" type="file" id="fileElem" name="image" accept="image/*">
                <button class="form__file--button" type="button" id="fileSelect">ファイルを選択</button>
                <div class="form__error">
                    @error('image')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="right__side">
            <div class="form__item">
                <p class="form__item--name">商品名</p>
                <input class="form__input" type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__item">
                <p class="form__item--name">値段</p>
                <input class="form__input" type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}">
                <div class="form__error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__item">
                <p class="form__item--name">季節</p>
                <div class="checkbox">
                    @foreach($seasons as $season)
                    <div class="appearance">
                        <label class="form__checkbox--label" for="{{ $season->name }}">
                            <input class="form__checkbox" type="checkbox" id="{{ $season->name }}" name="seasons[]" value="{{ $season->id }}"
                            {{ !empty(old('seasons')) && in_array((string)$season->id, old('seasons'), true) ? 'checked' : ''}}>
                            {{ $season->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="form__error">
                    @error('seasons')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="form__item">
        <p class="form__item--name">商品説明</p>
        <textarea class="form__textarea" name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
        <div class="form__error">
            @error('description')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__button">
        <button class="back__button" type="button" onclick="location.href='{{ route('products.index') }}'">戻る</button>
        <button class="form__submit" type="submit">変更を保存</button>
    </div>
</form>
<form class="delete__form" action="{{ route('products.destroy', ['product_id' => $product->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('delete')
    <button class="delete__button" id="deleteBtn" type="submit"><i class="fa-regular fa-trash-can fa-2x"></i></button>
</form>

<script src="{{ asset('js/delete-confirmation.js') }}"></script>

@endsection