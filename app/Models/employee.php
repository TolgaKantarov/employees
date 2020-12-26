<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    //4.1 Основни полета: имена, адрес, телефон, отдел, длъжност, заплата и други по избор;
    protected $fillable = ['name', 'email', 'address', 'phone', 'department', 'position', 'salary', 'created_by'];
}
