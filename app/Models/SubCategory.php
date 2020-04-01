<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table='subcats';
    protected $fillable = ['name','meta_keywords','meta_des','category_id'];
    protected $hidden=['created_at','updated_at'];


    public function cat(){
        return $this->belongsTo(Category::class,'category_id');
    }

    
}
