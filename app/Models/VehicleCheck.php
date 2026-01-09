<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCheck extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'previous_date' => 'date',
        ];
    }

    public function oilChangeIsDue(): bool
    {
        return $this->previous_date->diffInMonths(now()) > 6
            || ($this->current_odometer - $this->previous_odometer) > 5000;
    }
}
