<?php

namespace App\Models\Bundle;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleCategory extends Model
{
    use HasFactory;

    protected $table = 'bundle_categories';

    protected $fillable = [
        'uid',
        'title',
        'bundle_id',
        'created_at',
        'updated_at',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product\Product' , 'bundle_category_product', 'category_id', 'product_id');
    }

    public function bundle()
    {
        return $this->belongsTo('App\Models\Bundle\Bundle');
    }


}
