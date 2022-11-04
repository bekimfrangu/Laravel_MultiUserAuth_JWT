<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Get all users
    public function index()
    {
        return User::all();
    }

    //Insert a User
    public function store()
    {
        request()->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
    
        return User::create([
                'email'=> request('email'),
                'password'=> Hash::make(request('password'))
        ]);
    }

    //Get speicifc User
    public function user($id)
    {  
        $user = User::findorFail($id);
        return $user;
    }

    //update User
    public function update($id)
    {
        $user = User::findorFail($id);

        request()->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
    
        $updated = $user->update([
            'email'=> request('email'),
            'password'=> Hash::make(request('password'))
        ]);

        return ['User successfully updated'=> $updated, $user];
    }

    //delete User
    public function destroy($id)
    {
        $user = User::findorFail($id);

        $delete = $user->delete();
    
        return ['User successfully deleted'=> $delete];
    }
}
