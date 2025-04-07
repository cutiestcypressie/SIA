<?php

namespace App\Http\Controllers;

use App\Models\UserJob;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use DB;
use App\Services\User2Service;

class User2Controller extends Controller
{
    use ApiResponser;

    public $user2Service;

    public function __construct(User2Service $user2Service){
        $this->user2Service = $user2Service;
    }

    public function index()
    {
        return $this->successResponse($this->user2Service->obtainUsers2());
    }

    public function add(Request $request)
    {
        return $this->successResponse($this->user2Service->create($request->all()));
    }

    public function show($id)
    {
        return $this->successResponse($this->user2Service->obtainUser($id));
    }

    public function update(Request $request, $id)
    {
        return $this->successResponse($this->user2Service->edit($request->all(), $id));
    }

    public function delete($id)
    {
        return $this->successResponse($this->user2Service->delete($id));
    }
}
