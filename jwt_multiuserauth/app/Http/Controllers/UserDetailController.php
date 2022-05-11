<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserDetailController extends Controller
{
     //Get all users Details
     public function index()
     {
         return UserDetail::all();
     }
 
     //Insert a User Details
     public function store()
     {
     
         if(auth()->user())
         {
            return response()->json(['message' => 'Authorized'], 201);
         } else {
            return response()->json(['message' => 'Unauthorized'], 400);
         }
       
     }
 
     //Get speicifc User Details
     public function userDetail($id)
     {  
         $userDetail = UserDetail::findorFail($id);
         return $userDetail;
     }
 
     //update User Details
     public function update($id)
     {
         $userDetail = UserDetail::findorFail($id);
 
         request()->validate([
            'user_id'=>'required',
            'full_name'=>'required',
            'address'=>'required',
            'role'=>'required'
        ]);
     
         $updated = $userDetail->update([
            'user_id'=> request('user_id'),
            'full_name'=> request('full_name'),
            'address'=> request('address'),
            'role'=> request('role')
         ]);
 
         return ['User Details successfully updated'=> $updated, $userDetail];
     }
 
     //delete User Details
     public function destroy($id)
     {
         $userDetail = UserDetail::findorFail($id);
 
         $delete = $userDetail->delete();
     
         return ['User Details successfully deleted'=> $delete];
     }
}
