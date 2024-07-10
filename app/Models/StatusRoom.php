<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusRoom extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $table = "status_rooms";

    public function Room(): HasMany
    {
        return $this->hasMany(Room::class, 'id_status_room', 'id');
    }
}
