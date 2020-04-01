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
        $subcat=SubCategory::create($request->all());
        return $this->sendResponse(new SubCategoryResource($subcat),'Created Successfully');
    }//end of store

    //There is Problem in updating
    public function update(Update $request,$id){

        $subcat=$this->model->find($id);
        if(!$subcat)
            return $this->sendError('This SubCategory Not Found',400);
        $subcat->update($request->all());
        return$this->sendResponse(new SubCategoryResource($subcat),'SubCategory Updated Successfully');


    }//end of update


}
