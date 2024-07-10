<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionPos extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'id_guest', 'id');
    }

    public function TransactionRoom(): BelongsTo
    {
        return $this->belongsTo(TransactionRoom::class, 'id_transaction', 'id');
    }

    public function ProductBuying(): HasMany
    {
        return $this->hasMany(ProductBuying::class, 'id_transaction_pos', 'id');
    }
}
