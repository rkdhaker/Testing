<?php

namespace App\Services;


use App\Models\User;

use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponse;
class UserService extends Service
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    use ApiResponse;

    public function errorResponse($message)
    {
        return $this->failResponse([
            "message" => $message,
        ], 200);
    }

    // all user
    public function allUser()
    {
        try{

            $user = User::all();
            return $this->successResponse([
                'data'=>$user,
                'message' => "User Lisitng SuccesFully"
            ]);

        }catch (\Exception | ServiceException $e) {
            $message="Error occur in fatching data";
            return $this->errorResponse($message);

        }

    }

    // create user
    public function createUser(Request $request)
    {
        try{

            $user = new User();
            $user->name         =    $request->name;
            $user->email        =    $request->email;
            $user->phone        =    $request->phone;
            $user->save();
            return $this->successResponse([
                'message' => "User Create SuccesFully"
            ]);

        }catch (\Exception | ServiceException $e) {
            $message="Error occur in fatching data";
            return $this->errorResponse($message);

        }

    }

    // update user
    public function updateUser(Request $request,$id)
    {
        try{
            $user =  User::findOrFail($id);
            $user->name         =    $request->name;
            $user->email        =    $request->email;
            $user->phone        =    $request->phone;
            $user->update();
            return $this->successResponse([
                'data'=> $user,
                'message' => "User Update SuccesFully"
            ]);

        }catch (\Exception | ServiceException $e) {
            $message="Error occur in fatching data";
            return $this->errorResponse($message);
        }

    }

    // delete user
    public function deleteUser($id)
    {
        try{
           $user = User::where('id',$id)->first();
            if($user){
                $user->delete();
                return $this->successResponse([
                    'message' => "User Delete SuccesFully"
                ]);
            }else{
                $message="User not Exists";
                return $this->errorResponse($message);
            }
        }catch (\Exception | ServiceException $e) {
            $message="Error occur in fatching data";
            return $this->errorResponse($message);
        }

    }


    // show user
    public function showUser($id)
    {
        try{
             $user = User::where('id',$id)->first();
             if($user){
                return $this->successResponse([
                    'data'=>$user,
                    'message' => "User Show SuccesFully"
                ]);
             }else{
                $message="User not Exists";
                return $this->errorResponse($message);
             }
         }catch (\Exception | ServiceException $e) {
             $message="Error occur in fatching data";
             return $this->errorResponse($message);
        }

    }


}
