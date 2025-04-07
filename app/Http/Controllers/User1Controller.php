<?php

namespace App\Http\Controllers;

use App\Models\UserJob;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use DB;
use App\Services\User1Service;

class User1Controller extends Controller
{
    use ApiResponser;

    public $user1Service;

    public function __construct(User1Service $user1Service){
        $this->user1Service = $user1Service;
    }

    public function index()
    {
        return $this->successResponse($this->user1Service->obtainUsers1());
    }

    public function add(Request $request)
    {
        return $this->successResponse($this->user1Service->create($request->all()));
    }

    public function show($id)
    {
        return $this->successResponse($this->user1Service->obtainUser($id));
    }

    public function update(Request $request, $id)
    {
        return $this->successResponse($this->user1Service->edit($request->all(), $id));
    }

    public function delete($id)
    {
        return $this->successResponse($this->user1Service->delete($id));
    }
}
