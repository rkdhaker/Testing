<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class HomeController extends Controller
{
    // user index
    public function index(){
        $users = User::orderBy('id','desc')->get();
        return view('index',compact('users'));
    }

    // edit user form
    public function edit($id){
        $user  = User::findOrFail($id);
        return view('edit',compact('user'));
    }
}
