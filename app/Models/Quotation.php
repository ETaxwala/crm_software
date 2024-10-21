<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    

    public function sales() {
        return $this->hasMany(Sales::class);
    }

    public function lead() {
        return $this->belongsTo(LeadsModel::class);
    }
    
}
