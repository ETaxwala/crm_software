<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDocument extends Model
{
    use HasFactory;
    protected $table = 'customer_documents';
    protected $primarykey = 'cd_id';
    protected $fillable = [
        'customer_id',
        'cd_name',
        'cd_doc',
    ];
}
