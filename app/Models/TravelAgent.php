<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TravelAgent extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function SourceTravelAgent(): HasMany
    {
        return $this->hasMany(SourceTravelAgent::class, 'id_travel_agent', 'id');
    }

    public function TransactionRoom(): HasMany
    {
        return $this->hasMany(TransactionRoom::class, 'id_travel_agent', 'id');
    }
}
