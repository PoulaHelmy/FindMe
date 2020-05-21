<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Item extends Model
{
    use Searchable;

    protected $fillable = ['name','user_id','category_id','subcat_id','location','des','is_found','date'];
    protected $hidden=['updated_at'];
    protected $table='items';


    public function photos(){
        return $this->morphMany('App\Models\Photo', 'photoable');
    }
    public function dynamicValues(){
        return $this->hasMany('App\Models\ItemOption','item_id');
    }
    public function questions(){
        return $this->hasMany('App\Models\Question','item_id');
    }
    public function itemRequests(){
        return $this->hasMany('App\Models\RequestItems','item_id');
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


    public function searchableAs()
    {
        return 'items_index';
    }
//    /**
//     * Get the indexable data array for the model.
//     *
//     * @return array
//     */
//    public function toSearchableArray()
//    {
//        $array = $this->toArray();
//
//        // Customize array...
//  $array = $this->toArray();
//
//  return array('id' => $array['id'],'name' => $array['name']);
//        return $array;
//    }





}//end of class
