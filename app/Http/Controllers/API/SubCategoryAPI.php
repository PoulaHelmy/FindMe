<?php

namespace App\Http\Controllers\API;


use App\Http\Requests\BackEnd\SubCategories\Store;
use App\Http\Requests\BackEnd\SubCategories\Update;
use App\Http\Resources\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryAPI extends ApiHome
{
    public function __construct(SubCategory $model){
        parent::__construct($model);
    }//end of constructor

    public function index(Request $request){
        return SubCategoryResource::collection(SubCategory::all());
    }//end of index

    public function store(Store $request){
        $row=SubCategory::create($request->all());
        return $this->sendResponse(new SubCategoryResource($row),'Created Successfully');
    }//end of store


    public function update(Update $request,$id){

        $row=$this->model->find($id);
        if(!$row)
            return $this->sendError('This SubCategory Not Found',400);
        $row->update($request->all());
        return$this->sendResponse(new SubCategoryResource($row),'SubCategory Updated Successfully');


    }//end of update


}
