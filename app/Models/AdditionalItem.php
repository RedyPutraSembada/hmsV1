<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AdditionalItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function DetilRoomAmanities(): HasOne
    {
        return $this->HasOne(DetilRoomAmanities::class, 'id_additional_item', 'id');
    }
    public function DetilTransactionRoomItem(): HasMany
    {
        return $this->HasMany(DetilTransactionRoomItem::class, 'id_additional_item', 'id');
    }
}
