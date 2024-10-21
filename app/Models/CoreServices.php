<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreServices extends Model
{
    use HasFactory;
    protected $table = 'core_services';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'image',
        'content',
    ];
}
