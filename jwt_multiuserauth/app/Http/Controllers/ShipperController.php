<?php

namespace App\Http\Controllers;

use App\Models\Shipper;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
     //Get all shippers
     public function index()
     {
         return Shipper::all();
     }
 
     //Insert a shipper
     public function store()
     {
         request()->validate([
             'company_name'=>'required',
             'phone'=>'required',
         ]);
     
         return Shipper::create([
                 'company_name'=> request('company_name'),
                 'phone'=> request('phone')
         ]);
     }
 
     //Get speicifc shipper
     public function shipper($id)
     {  
         $shipper = Shipper::findorFail($id);
         return $shipper;
     }
 
     //update shipper
     public function update($id)
     {
         $shipper = Shipper::findorFail($id);
 
         request()->validate([
             'company_name'=>'required',
             'phone'=>'required',
         ]);
     
         $sUpdated = $shipper->update([
             'company_name'=> request('company_name'),
             'phone'=> request('phone')
         ]);
 
         return ['Shipper successfully updated'=> $sUpdated, $shipper];
     }
 
     //delete shipper
     public function destroy($id)
     {
         $shipper = Shipper::findorFail($id);
 
         $sdelete = $shipper->delete();
     
         return ['Shipper successfully deleted'=> $sdelete];
     }
}
