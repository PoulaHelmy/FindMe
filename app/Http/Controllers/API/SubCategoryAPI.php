<?php

namespace App\Http\Controllers\API;


use App\Http\Requests\BackEnd\SubCategories\Store;
use App\Http\Requests\BackEnd\SubCategories\Update;
use App\Http\Resources\SubCategoryResource;
use App\Models\Subcat;
use Illuminate\Http\Request;

class SubCategoryAPI extends ApiHome
{
    public function __construct(Subcat $model){
        parent::__construct($model);
    }//end of constructor

    public function index(Request $request){
        return SubCategoryResource::collection(Subcat::all());
    }//end of index

    public function store(Store $request){
        $row=Subcat::create($request->all());
        return $this->sendResponse(new SubCategoryResource($row),'Created Successfully');
    }//end of store

    public function update(Update $request,$id){
        $row=$this->model->find($id);
        if(!$row)
            return $this->sendError('This SubCategory Not Found',400);
        $row->update($request->all());
        return$this->sendResponse(new SubCategoryResource($row),'SubCategory Updated Successfully');
    }//end of update

    public function subcats_inputs(Request $request){
        $v = validator($request->only('subcat', 'inputs'), [
            'subcat' => 'required|integer',
            'inputs.*.*.id' => 'required|integer',
        ]);

        if ($v->fails())
            return $this->sendError('Validation Error.!',$v->errors()->all(),400);

        $row=$this->model->find($request->subcat);
        if(!$row)
            return $this->sendError('This SubCategory Not Found',400);
        $row->inputs()->sync($request->inputs);
        return$this->sendResponse(new SubCategoryResource($row),'Attachment the inputs to this subcategory is Successfully');

    }//end of update

}
