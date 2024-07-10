<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductBuying extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function TransactionRoom(): BelongsTo
    {
        return $this->belongsTo(TransactionRoom::class, 'id_transaction', 'id');
    }
}
