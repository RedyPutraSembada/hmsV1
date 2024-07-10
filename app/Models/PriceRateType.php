<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PriceRateType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function RoomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'id_room_type', 'id');
    }

    public function StatusRateType(): BelongsTo
    {
        return $this->belongsTo(StatusRateType::class, 'id_status_rate_type', 'id');
    }

    public function TransactionRoom(): HasMany
    {
        return $this->hasMany(TransactionRoom::class, 'id_price_rate_type', 'id');
    }
}
