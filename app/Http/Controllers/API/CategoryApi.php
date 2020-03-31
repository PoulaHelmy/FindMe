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
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }//end of constructor

    public function index(Request $request)
    {
        return CategoryResource::collection(Category::all());
    }//endof index

    public function store(Store $request)
    {
        $cat=Category::create($request->all());
        return $this->sendResponse(new CategoryResource($cat), 'Created Successfully');
    }//end of store

    //There is Problem in updating
    public function update(Store $request, $id)
    {
        $cat=$this->model->find($id);
        if (!$cat) {
            return $this->sendError('This Category Not Found', 400);
        }
        $cat->update($request->all());
        return$this->sendResponse(new CategoryResource($cat), 'Category Updated Successfully');
    }//end of update

    public function destroy($id)
    {
        $cat=Category::find($id);
        if (!$cat) {
            return $this->sendError('This Category Not Found', 400);
        }
        $cat->delete();
        return$this->sendResponse(null, 'Category Deleted Successfully');
    }//end of store
}//end of controller
