<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SourceTravelAgent extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function TravelAgent(): BelongsTo
    {
        return $this->belongsTo(TravelAgent::class, 'id_travel_agent', 'id');
    }

    public function TransactionRoom(): HasMany
    {
        return $this->hasMany(TransactionRoom::class, 'id_source_travel_agent', 'id');
    }
}
