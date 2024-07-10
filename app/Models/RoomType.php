<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function PriceRateType(): HasMany
    {
        return $this->hasMany(PriceRateType::class, 'id_room_type', 'id');
    }

    public function Room(): HasMany
    {
        return $this->hasMany(Room::class, 'id_room_type', 'id');
    }

    public function Breakfast(): BelongsTo
    {
        return $this->belongsTo(Breakfast::class, 'breakfast_id', 'id');
    }
}
