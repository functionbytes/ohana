<?php

namespace App\Models\Bundle;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleProduct extends Model
{
    use HasFactory;

    protected $table = 'bundle_product';

    protected $fillable = [
        'bundle_id',
        'product_id',
    ];

    public function product() : HasManyThrough
    {
        return $this->hasManyThrough('App\Models\Product\Product', 'App\Models\Bundle\Bundle');
    }

    public function bundle(): HasManyThrough
    {
        return $this->hasManyThrough('App\Models\Product\Product', 'App\Models\Bundle\Bundle');
    }


}
