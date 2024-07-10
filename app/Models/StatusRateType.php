<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusRateType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $table = "status_rate_types";

    public function PriceRateType(): HasMany
    {
        return $this->hasMany(PriceRateType::class, 'id_status_rate_type', 'id');
    }
}
