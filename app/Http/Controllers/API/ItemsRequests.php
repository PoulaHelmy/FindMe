<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiHome;

use App\Http\Requests\BackEnd\Requests\Store;
use App\Http\Requests\BackEnd\Requests\Update;
use App\Http\Resources\RequestsItems\ItemRequest;
use App\Http\Resources\RequestsItems\ItemRequestDetails;
use App\Models\QuestionResponse;
use App\Models\RequestItems;
use App\Models\User;
use Illuminate\Http\Request;

class ItemsRequests extends ApiHome
{
    public function __construct(RequestItems $model){
        parent::__construct($model);
    }//end of constructor
    public function index(Request $request){
        return ItemRequest::collection(
            $this->model->where('user_id','=',auth()->user()->id)->get());
    }//end of index
    public function show($id){
        $row=$this->model->findOrFail($id);
        if($row) {
            return $this->sendResponse(new ItemRequestDetails($row),
                'Data Retrieved Successfully');
        }
        return $this->sendError('Not Found',400);
    }
    public function store(Store $request)
    {
        $item_id=$request->item_id;
        $reqNum=User::find(auth()->user()->id)->itemRequests()->where(
            'item_id','=',$item_id
        )->count();
        if($reqNum>0){
            return $this->sendError('You Already Requested this Item So You can not make Request again ',404);
        }
        $requestArray=[
            'user_id' => auth()->user()->id,
            'item_id'=>$request->item_id,
            'name'=>$request->name,
            'des'=>$request->des
        ];
        $row = $this->model->create($requestArray);
        for($i=0;$i<sizeof($request->questions);$i++){
            $questionRes=[
                'question'=>$request->questions[$i]['question'],
                'answer'=>$request->questions[$i]['answer'],
                'request_id'=>$row->id,
            ];
            $rowData=QuestionResponse::create($questionRes);
        }
        return $this->sendResponse($row,
            'Request Created Successfully');
    }
    public function update(Update $request,$id){
        $row=$this->model->find($id);
        if(!$row)
            return $this->sendError('This Request Not Found',404);
        $row->name=$request->get('name');
        $row->des=$request->get('des');
        $row->save();
        foreach ($row->questionResponses as $quesRes){
            $quesResData=QuestionResponse::find($quesRes->id);
            $quesResData->delete();
        }
        for($i=0;$i<sizeof($request->questions);$i++){
            $questionRes=[
                'question'=>$request->questions[$i]['question'],
                'answer'=>$request->questions[$i]['answer'],
                'request_id'=>$row->id,
            ];
            $rowData=QuestionResponse::create($questionRes);
        }
        return $this->sendResponse('',
            'Request Updated Successfully');
    }
    public function destroy($id){
        $row=$this->model->find($id);
        if(!$row)
            return $this->sendError('This Request Not Found',400);
        $row->delete();
        return$this->sendResponse(null,'ITEM Deleted Successfully');
    }//end of destroy
    public function changeStatus(Request $request){
        $v = validator($request->all(), [
            'req_id' => 'integer',
            'status' => ['digits_between:0,1','integer'],
        ]);
        if ($v->fails())
            return $this->sendError('Validation Error.!',$v->errors()->all(),400);
        $row=$this->model->find($request->req_id);
        if (!$row)
            return $this->sendError('this Request Not Found',400);
        $row->status=$request->status;
        $row->save();
        return $this->sendResponse(new ItemRequest($row),
            'Request Updated Successfully');

    }
    public function indexWithFilter(Request $request){
        if($request->get('filter')==''||$request->get('filter')==null){
            return ItemRequest::collection(
                RequestItems::orderBy($request->get('order'), $request->get('sort'))->
                paginate($request->get('pageSize')));
        }
        else{
            return
                ItemRequest::collection(RequestItems::when($request->filter,function ($query)use($request){
                    return $query->where('name','like','%'.$request->filter.'%');})
                    ->orderBy($request->get('order'), $request->get('sort'))
                    ->paginate($request->get('pageSize')));
        }
    }//end of indexWithFilter


}//end of Class

