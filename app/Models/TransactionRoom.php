<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransactionRoom extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'id_guest', 'id');
    }

    public function PriceRateType(): BelongsTo
    {
        return $this->belongsTo(PriceRateType::class, 'id_price_rate_type', 'id');
    }

    public function Room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'id_room', 'id');
    }

    public function TravelAgent(): BelongsTo
    {
        return $this->belongsTo(TravelAgent::class, 'id_travel_agent', 'id');
    }

    public function SourceTravelAgent(): BelongsTo
    {
        return $this->belongsTo(SourceTravelAgent::class, 'id_source_travel_agent', 'id');
    }

    public function TotalPayment(): HasOne
    {
        return $this->hasOne(TotalPayment::class, 'id_transaction', 'id');
    }

    public function ProductBuying(): HasMany
    {
        return $this->hasMany(ProductBuying::class, 'id_transaction', 'id');
    }

    public function TransactionPos(): HasMany
    {
        return $this->hasMany(TransactionPos::class, 'id_transaction', 'id');
    }

    public function TransactionSewaRoom(): hasOne
    {
        return $this->hasOne(TransactionSewaRoom::class, 'id_transaction_room', 'id');
    }
    public function DetilTransactionRoomItem(): hasOne
    {
        return $this->hasOne(DetilTransactionRoomItem::class, 'id_transaction_room', 'id');
    }
}
