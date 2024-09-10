<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // 商品一覧ページ表示
    public function index() {
        $products = Product::select('id', 'name', 'price', 'image')
        ->paginate(6);
        return view('index', compact('products'));
    }

    // 商品検索
    public function search(Request $request) {
        $products = Product::select('id', 'name', 'price', 'image')
        ->SearchKeyword($request->keyword)
        ->SortOrder($request->sort_order)
        ->paginate(6);
        return view('index', compact('products'));
    }

    // 商品登録ページ表示
    public function create() {
        dd('test_create');
    }

    // 商品登録
    public function store() {
        dd('test_store');
    }

    // 商品詳細ページ表示
    public function detail() {
        dd('test_detail');
    }

    // 商品更新
    public function update() {
        dd('test_update');
    }

    // 商品削除
    public function destroy() {
        dd('test_destroy');
    }
}
