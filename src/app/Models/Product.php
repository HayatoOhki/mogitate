<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];

    public function productSeason()
    {
        return $this->hasMany(ProductSeason::class);
    }

    //受け取ったseason_idを選択しているか判定
    public function is_season($season_id)
    {
        return $this->productSeason()->where('season_id', $season_id)->exists();
    }

    // キーワード検索
    public function scopeSearchKeyword($query, $keyword)
    {
        if(!is_null($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }

    // 価格で並べ替え
    public function scopeSortOrder($query, $sort_order)
    {
        if(!is_null($sort_order)) {
            if($sort_order === \SortOrder::LIST['higherPrice']) {
                $query->orderBy('price', 'desc');
            } elseif($sort_order === \SortOrder::LIST['lowerPrice']) {
                $query->orderBy('price', 'asc');
            }
        }
    }
}
