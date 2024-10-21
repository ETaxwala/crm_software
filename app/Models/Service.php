<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function sale() {
        return $this->hasMany(Sales::class);
    }

    public function quotation() {
        return $this->belongsTo(Quotation::class);
    }
}
