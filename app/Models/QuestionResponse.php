<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionResponse extends Model
{
    protected $fillable = ['question','answer','request_id'];
    protected $hidden=['updated_at'];
    protected $table='questionresponses';


    public function itemRequest(){
        return $this->belongsTo(RequestItems::class,'request_id');
    }














}//end of Class
