<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table='subcats';
    protected $fillable = ['name','meta_keywords','des'];
}
