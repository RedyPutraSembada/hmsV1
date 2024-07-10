<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetilRoomAmanities extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Room(): HasMany
    {
        return $this->hasMany(Room::class, 'id_room', 'id');
    }

    public function AdditionalItem(): BelongsTo
    {
        return $this->belongsTo(AdditionalItem::class, 'id_additional_item', 'id');
    }
}
