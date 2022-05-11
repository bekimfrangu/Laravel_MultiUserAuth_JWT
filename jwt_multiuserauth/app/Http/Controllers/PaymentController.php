<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
     //Get all payments
     public function index()
     {
         return Payment::all();
     }
 
     //Insert a payment
     public function store()
     {
         request()->validate([
             'type_id'=>'required',
             'provider_id'=>'required',
             'amount'=>'required',
             'status'=>'required'
         ]);
     
         return Payment::create([
                 'type_id'=> request('type_id'),
                 'provider_id'=> request('provider_id'),
                 'amount'=> request('amount'),
                 'status'=> request('status')
         ]);
     }
 
     //Get speicifc payment
     public function payment($id)
     {  
         $payment = Payment::findorFail($id);
         return $payment;
     }
 
     //update payment
     public function update($id)
     {
         $payment = Payment::findorFail($id);
 
         request()->validate([
            'type_id'=>'required',
            'provider_id'=>'required',
            'amount'=>'required',
            'status'=>'required'
        ]);
     
         $updated = $payment->update([
            'type_id'=> request('type_id'),
            'provider_id'=> request('provider_id'),
            'amount'=> request('amount'),
            'status'=> request('status')
         ]);
 
         return ['Payment successfully updated'=> $updated, $payment];
     }
 
     //delete payment
     public function destroy($id)
     {
         $payment = Payment::findorFail($id);
 
         $delete = $payment->delete();
     
         return ['Payment successfully deleted'=> $delete];
     }
}
