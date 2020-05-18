<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name','user_id','category_id','subcat_id','location','des','is_found','date'];
    protected $hidden=['updated_at'];
    protected $table='items';


    public function photos(){
        return $this->morphMany('App\Models\Photo', 'photoable');
    }
    public function dynamicValues(){
        return $this->hasMany('App\Models\ItemOption');
    }
    public function questions(){
        return $this->hasMany('App\Models\Question');
    }
    public function itemRequests(){
        return $this->hasMany('App\Models\RequestItems');
    }
    public function cat(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subcat(){
        return $this->belongsTo(Subcat::class,'subcat');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }









}//end of class
