<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // 商品一覧ページ表示
    public function index() {
        $products = Product::select('id', 'name', 'price', 'image')->paginate(6);
        $keyword = "ストロベリー";
        return view('index', compact(
            'products',
            'keyword',
        ));
    }

    // 商品詳細ページ表示
    public function detail($id) {
        //
    }

    // 商品更新
    public function update() {
        //
    }

    // 商品登録ページ表示
    public function create() {
        //
    }

    // 商品登録
    public function store() {
        //
    }

    // 商品検索
    public function search() {
        //
    }

    // 商品削除
    public function destroy() {
        //
    }
}
