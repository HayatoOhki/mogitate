<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductSeason;
use App\Models\Season;

class ProductController extends Controller
{
    // 商品一覧ページ表示
    public function index()
    {
        $products = Product::select('id', 'name', 'price', 'image')
        ->paginate(6);

        return view('index', compact('products'));
    }

    // 商品検索
    public function search(Request $request)
    {
        $products = Product::select('id', 'name', 'price', 'image')
        ->SearchKeyword($request->keyword)
        ->SortOrder($request->sort_order)
        ->paginate(6);

        return view('index', compact('products'));
    }

    // 商品登録ページ表示
    public function create()
    {
        $seasons = Season::select('id', 'name')->get();

        return view('create', compact('seasons'));
    }

    // 商品登録
    public function store(ProductRequest $request)
    {
        $imageFile = $request->image;
        if(!is_null($imageFile) && $imageFile->isValid()) {
            $fileName = uniqid(rand().'_') . '.' . $imageFile->extension();
            $dirName = 'images/product/';
            $fileNameToStore = $dirName . $fileName;
            Storage::putFileAs('public/' . $dirName, $imageFile, $fileName);
        }

        try {
            DB::transaction(function () use($request, $fileNameToStore) {
                $product = Product::create([
                    'name' => $request->name,
                    'price' => $request->price,
                    'image' => $fileNameToStore,
                    'description' => $request->description,
                ]);

                foreach($request->seasons as $season) {
                    ProductSeason::create([
                        'product_id' => $product->id,
                        'season_id' => $season,
                    ]);
                }
            }, 2);
        } catch(Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()->route('products.index');
    }

    // 商品詳細ページ表示
    public function detail($id)
    {
        $product = Product::findOrFail($id);
        $seasons = Season::select('id', 'name')->get();

        return view('detail', compact('product', 'seasons'));
    }

    // 商品更新
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $image = $product->image;
        $filePath = 'public/' . $image;

        $imageFile = $request->image;
        if(!is_null($imageFile) && $imageFile->isValid()) {
            $fileName = uniqid(rand().'_') . '.' . $imageFile->extension();
            $dirName = 'images/product/';
            $fileNameToStore = $dirName . $fileName;
            Storage::putFileAs('public/' . $dirName, $imageFile, $fileName);
        }

        try {
            DB::transaction(function () use($request, $id, $product, $fileNameToStore) {
                $product->name = $request->name;
                $product->price = $request->price;
                $product->image = $fileNameToStore;
                $product->description = $request->description;
                $product->save();

                ProductSeason::where('product_id', $id)->delete();

                foreach($request->seasons as $season) {
                    ProductSeason::create([
                        'product_id' => $id,
                        'season_id' => $season,
                    ]);
                }
            }, 2);
        } catch(Throwable $e) {
            Log::error($e);
            throw $e;
        }

        if(Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        return redirect()->route('products.index');
    }

    // 商品削除
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image = $product->image;
        $filePath = 'public/' . $image;
        if(Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        Product::findOrFail($id)->delete();

        return redirect()->route('products.index');
    }
}
