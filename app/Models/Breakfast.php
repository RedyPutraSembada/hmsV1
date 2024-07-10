<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Breakfast extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function RoomType(): HasMany
    {
        return $this->hasMany(RoomType::class, 'id_breakfast', 'id');
    }
}
