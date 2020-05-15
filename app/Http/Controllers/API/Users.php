<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Users extends ApiHome
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getAllUsers(){
        $data=User::all();
        return $this->sendResponse($data,'Success Retrive ALL Users');
    }



}
