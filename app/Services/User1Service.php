<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class User1Service{
    use ConsumesExternalService;

    public $baseUri;

    public function __construct()
    {
        // Set the baseUri property directly from the environment variable
        $this->baseUri = env('USERS1_SERVICE_BASE_URL', 'http://localhost:8000');
        
        // Debug: Log the base URI
        error_log("User1Service baseUri: " . $this->baseUri);
    }

    public function obtainUsers1(){
        return $this->performRequest('GET', '/users');
    }

    public function create($data){
        return $this->performRequest('POST', '/users', $data);
    }

    public function obtainUser($id){
        return $this->performRequest('GET', "/users/{$id}");
    }

    public function edit($data, $id){
        return $this->performRequest('PUT', "/users/{$id}", $data);
    }

    public function delete($id){
        return $this->performRequest('DELETE', "/users/{$id}");
    }
}
