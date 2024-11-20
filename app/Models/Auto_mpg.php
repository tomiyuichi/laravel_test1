<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto_mpg extends Model
{
    use HasFactory;

    // テーブル名を明示的に指定
    protected $table = 'auto_mpg_table';

    protected $fillable = ['displacement', 'mpg', 'cylinders', 'horsepower', 'weight', 'acceleration', 'model_year', 'origin', 'car_name']; // 必要なカラム名
}

