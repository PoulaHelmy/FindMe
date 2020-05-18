<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiHome;

use App\Models\RequestItems;
use Illuminate\Http\Request;

class ItemsRequests extends ApiHome
{
    public function __construct(RequestItems $model){
        parent::__construct($model);
    }//end of constructor



}//end of Class
