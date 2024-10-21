<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function quotation() {
        return $this->hasMany(Quotation::class);
    }

    public function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function sale() {
        return $this->hasMany(Sale::class, 'service_id');
    }
}
