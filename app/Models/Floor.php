<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Floor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Room(): HasMany
    {
        return $this->hasMany(Room::class, 'id_floor', 'id');
    }
}
