<?php

namespace App\Validators;
use App\Validators\Validator;
use Illuminate\Validation\Rule;
class UserValidator extends Validator
{

    public function __construct($validationFor = 'createUser',$id = NULL)
    {


        switch ($validationFor) {
            case 'createUser':
            $additionalRules = [
                'name'        =>    'required|max:25',
                'email'       =>    'required|email|unique:users',
                'phone'       =>    'required|regex:/[0-9]{9}/',
            ];
            break;
            case 'updateUser':
            $additionalRules = [
                'name'        =>    'required|max:25',
                'email'       =>    'required|email|unique:users,email,'.$id,
                'phone'       =>    'required|regex:/[0-9]{9}/',
            ];
            break;
            default:
            $additionalRules = [];
            break;
        }
        $this->rules = $additionalRules;
    }

}
