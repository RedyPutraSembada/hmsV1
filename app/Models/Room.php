<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function RoomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'id_room_type', 'id');
    }

    public function StatusRoom(): BelongsTo
    {
        return $this->belongsTo(StatusRoom::class, 'id_status_room', 'id');
    }

    public function Floor(): BelongsTo
    {
        return $this->belongsTo(Floor::class, 'id_floor', 'id');
    }

    public function TransactionRoom(): HasMany
    {
        return $this->hasMany(TransactionRoom::class, 'id_room', 'id');
    }

    public function DetilRoomAmanities(): HasMany
    {
        return $this->hasMany(DetilRoomAmanities::class, 'id_room', 'id');
    }
}
