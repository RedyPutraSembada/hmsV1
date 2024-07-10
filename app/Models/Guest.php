<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Accupation(): BelongsTo
    {
        return $this->belongsTo(Accupation::class, 'id_occupation', 'id');
    }

    public function TransactionRoom(): HasMany
    {
        return $this->hasMany(TransactionRoom::class, 'id_guest', 'id');
    }

    public function TransactionPos(): HasMany
    {
        return $this->hasMany(TransactionPos::class, 'id_guest', 'id');
    }
}
