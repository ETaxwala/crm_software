<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationTasksModel extends Model
{
    use HasFactory;
    protected $table = 'operation_tasks';
    protected $primarykey = 'task_id ';
    protected $fillable = [
        'cust_id',
        'service_id',
        'task_name',
        'original_task_status',
        'is_assign',
        'is_return',
        'added_by',
        'assign_date',
    ];
}
