<?php

namespace App\Http\Controllers;

use App\Models\PaymentProvider;
use Illuminate\Http\Request;

class PaymentProviderController extends Controller
{
    //Get all payment providers
    public function index()
    {
        return PaymentProvider::all();
    }

    //Insert a payment provider
    public function store()
    {
        request()->validate([
            'provider'=>'required'
        ]);
    
        return PaymentProvider::create([
                'provider'=> request('provider')
        ]);
    }

    //Get speicifc payment provider
    public function paymentProvider($id)
    {  
        $pProvider = PaymentProvider::findorFail($id);
        return $pProvider;
    }

    //update payment provider
    public function update($id)
    {
        $pProvider = PaymentProvider::findorFail($id);

        request()->validate([
            'provider'=>'required'
        ]);
    
        $updated = $pProvider->update([
            'provider'=> request('provider')
        ]);

        return ['Payment Provider successfully updated'=> $updated, $pProvider];
    }

    //delete payment provider
    public function destroy($id)
    {
        $pProvider = PaymentProvider::findorFail($id);

        $delete = $pProvider->delete();
    
        return ['Payment Provider successfully deleted'=> $delete];
    }
}
