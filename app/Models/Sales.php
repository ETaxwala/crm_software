<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    public function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
