<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponse;
use App\Validators\UserValidator;
use App\Services\UserService;
class UserController extends Controller
{
    use ApiResponse;

    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;

    }

    // error response
    public function errorResponse($message)
    {
        return $this->failResponse([
            "message" => $message,
        ], 200);
    }

    // User Create
    public function index()
    {
        return $this -> UserService -> allUser();
    }



    // User Create
    public function store(Request $request)
    {

        $UserValidator = new UserValidator('createUser');
        $input = $request->all();
        if (!$UserValidator ->with($input) ->passes()) {
            return $this->errorResponse($UserValidator->getErrors()[0]);
        }else{
            return $this -> UserService -> createUser($request);
        }
    }

    // User Update
    public function update(Request $request,$id)
    {
        $UserValidator = new UserValidator('updateUser',$id);
        $input = $request->all();
        if (!$UserValidator ->with($input) ->passes()) {
            return $this->errorResponse($UserValidator->getErrors()[0]);
        }else{
            return $this -> UserService -> updateUser($request,$id);
        }
    }

    // User Update
    public function destroy($id)
    {
       return $this -> UserService -> deleteUser($id);

    }

     // User show
     public function show($id)
     {
        return $this -> UserService -> showUser($id);

     }
}
