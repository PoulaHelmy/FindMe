<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    protected $fillable = ['name'];
    protected $hidden=['created_at','updated_at'];


    public function subcats(){
        return $this->belongsToMany(Subcat::class,'inputs_subcats');
    }
}
