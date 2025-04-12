<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kardex;

class Product extends Model
{

    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'uid',
        'title',
        'slug',
        'reference',
        'barcode',
        'stock',
        'available',
        'created_at',
        'updated_at'
    ];

    public function scopeId($query ,$id)
    {
        return $query->where('id', $id)->first();
    }

    public function scopeBarcode($query, $barcode)
    {
        return $query->where('barcode',$barcode)->first();
    }

    public function scopeBarcodeExits($query, $barcode)
    {
        return $query->where('barcode',$barcode)  ->exists();
    }

    public function scopeUid($query, $uid)
    {
            return $query->where('uid', $uid)->first();
    }

    public function scopeSlug($query ,$slug)
    {
        return $query->where('slug', $slug)->first();
    }

    public function scopeAvailable($query)
    {
        return $query->where('available', 1);
    }

}
