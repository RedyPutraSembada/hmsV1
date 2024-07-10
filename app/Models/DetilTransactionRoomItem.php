<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DetilTransactionRoomItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function TransactionRoom(): BelongsTo
    {
        return $this->belongsTo(TransactionRoom::class, 'id_transaction_room');
    }
    public function AdditionalItem(): BelongsTo
    {
        return $this->BelongsTo(AdditionalItem::class, 'id_additional_item', 'id');
    }
}
