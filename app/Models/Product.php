<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ProductBuying(): HasMany
    {
        return $this->hasMany(ProductBuying::class, 'id_product', 'id');
    }

    public function ProductCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'id_product_category', 'id');
    }
}
