<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;
class CategoryResource extends JsonResource
{

    public function toArray($request){

       //return parent::toArray($request);
        return [
            'id'            =>$this->id,
            'name'          =>$this->name,
            'meta_description'   =>$this->meta_des,
            'meta_keywords'  =>$this->meta_keywords
        ];

    }


}
