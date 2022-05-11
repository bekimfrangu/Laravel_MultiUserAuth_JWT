<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    //Get all payment types
    public function index()
    {
        return PaymentType::all();
    }

    //Insert a payment type
    public function store()
    {
        request()->validate([
            'type'=>'required'
        ]);
    
        return PaymentType::create([
                'type'=> request('type')
        ]);
    }

    //Get speicifc payment type
    public function paymentType($id)
    {  
        $pType = PaymentType::findorFail($id);
        return $pType;
    }

    //update payment type
    public function update($id)
    {
        $pType = PaymentType::findorFail($id);

        request()->validate([
            'type'=>'required'
        ]);
    
        $updated = $pType->update([
            'type'=> request('type')
        ]);

        return ['Payment Type successfully updated'=> $updated, $pType];
    }

    //delete payment type
    public function destroy($id)
    {
        $pType = PaymentType::findorFail($id);

        $delete = $pType->delete();
    
        return ['Payment Type successfully deleted'=> $delete];
    }
}
