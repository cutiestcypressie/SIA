<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use DB;
use App\Services\User1Service;

class User1Controller extends Controller
{
    use ApiResponser;

    /**
    * The service to consume the User1 Microservice
    * @var User1Service
    */
    public $user1Service;
    /**
    * Create a new controller instance
    * @return void
    */
    public function __construct(User1Service $user1Service)
    {
        $this->user1Service = $user1Service;
        
    }


    public function getUsers()
    {
        
    }

    public function index()
    {
        return $this->successResponse($this->user1Service->obtainUsers1());
    }

    public function add(Request $request ){
        return $this->successResponse($this->user1Service->createUser1($request->all(), Response::HTTP_CREATED));
    }

    public function show($id)
    {
    return $this->successResponse($this->user1Service->obtainUser1($id));
    }

    public function update(Request $request,$id)
    {
    return $this->successResponse($this->user1Service->editUser1($request->all(),$id));
    }

    public function delete($id)
    {
        return $this->successResponse($this->user1Service->deleteUser1($id));
    }

}
  