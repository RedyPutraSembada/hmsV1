<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TotalPayment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function TransactionRoom(): BelongsTo
    {
        return $this->belongsTo(TransactionRoom::class, 'id_transaction', 'id');
    }
}
