<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Subcat;

class SubCategoryResource extends JsonResource
{

    public function toArray($request)
    {
        $AllInputs=[];
        foreach($this->inputs as $input){
            array_push($AllInputs,['id'=>$input->id,'name'=>$input->name]);
    }
        return [
            'id'                 =>$this->id,
            'category_id'        =>$this->category_id,
            'name'               =>$this->name,
            'meta_description'   =>$this->meta_des,
            'meta_keywords'      =>$this->meta_keywords,
            'number_inputs'      =>sizeof($AllInputs),
            'inputs'             =>$AllInputs,

        ];
    }
}
