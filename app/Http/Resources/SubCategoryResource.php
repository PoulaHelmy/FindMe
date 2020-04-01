<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\SubCategory;
class SubCategoryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            =>$this->id,
            'category_id'   =>$this->category_id,
            'name'          =>$this->name,
            'meta_description'   =>$this->meta_des,
            'meta_keywords'  =>$this->meta_keywords
        ];
    }
}
