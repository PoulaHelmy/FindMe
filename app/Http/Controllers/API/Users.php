<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Users extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth:api');
    }
    public function index(){
        $data=User::all();
        return response()->json($data,200);
    }

    public function show(User $user){
        $data=['data'=>$user];
        
        return response()->json($data,200);
    }


}
