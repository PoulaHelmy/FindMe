<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackEnd\Inputs\Store;
use App\Http\Resources\InputsResource;
use App\Models\Input;
use Illuminate\Http\Request;

class InputsAPI extends ApiHome
{
    public function __construct(Input $model){
        parent::__construct($model);
    }//end of constructor

    public function index(Request $request){
        return InputsResource::collection(Input::all());
    }//end of index

    public function store(Store $request){
        $row=Input::create($request->all());
        return $this->sendResponse(new InputsResource($row),'Created Successfully');
    }//end of store


    public function update(Store $request,$id){
        $row=$this->model->find($id);
        if(!$row)
            return $this->sendError('This Input Not Found',400);
        $row->update($request->all());
        return$this->sendResponse(new InputsResource($row),'Input Updated Successfully');
    }//end of update
}
