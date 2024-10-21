<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsModel extends Model
{
    use HasFactory;
    protected $table = 'leads';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'email',
        'contact',
        'service',
        'state',
        'city',
        'added_by',
        'lead_type',
        'company_id',
    ];


    public function quotation() {
        return $this->hasMany(Quotation::class);
    }
}
