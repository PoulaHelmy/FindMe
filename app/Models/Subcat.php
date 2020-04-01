<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcat extends Model
{
    protected $table='subcats';
//    protected $primaryKey = 'subcats_id';
    protected $fillable = ['name','meta_keywords','meta_des','category_id'];
    protected $hidden=['created_at','updated_at'];


    public function cat(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function inputs(){
        return $this->belongsToMany(Input::class,'inputs_subcats');
    }

}
