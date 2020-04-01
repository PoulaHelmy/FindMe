<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackEnd\Categories\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
class CategoryApi extends ApiHome
{
    public function __construct(Category $model){
        parent::__construct($model);
    }//end of constructor

    public function index(Request $request){
        return CategoryResource::collection(Category::all());
    }//endof index

    public function store(Store $request){
        $row=Category::create($request->all());
        return $this->sendResponse(new CategoryResource($row),'Created Successfully');
    }//end of store


    public function update(Store $request,$id){
        $row=$this->model->find($id);
        if(!$row)
            return $this->sendError('This Category Not Found',400);
        $row->update($request->all());
        return$this->sendResponse(new CategoryResource($row),'Category Updated Successfully');
    }//end of update



}//end of controller
