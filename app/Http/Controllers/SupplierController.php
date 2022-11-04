<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //Get all suppliers
    public function index()
    {
        return Supplier::all();
    }

    //Insert a supplier
    public function store()
    {
        request()->validate([
            'company_name'=>'required',
            'phone'=>'required',
        ]);
    
        return Supplier::create([
                'company_name'=> request('company_name'),
                'phone'=> request('phone')
        ]);
    }

    //Get speicifc supplier
    public function supplier($id)
    {  
        $supplier = Supplier::findorFail($id);
        return $supplier;
    }

    //update supplier
    public function update($id)
    {
        $supplier = Supplier::findorFail($id);

        request()->validate([
            'company_name'=>'required',
            'phone'=>'required',
        ]);
    
        $sUpdated = $supplier->update([
            'company_name'=> request('company_name'),
            'phone'=> request('phone')
        ]);

        return ['Supplier successfully updated'=> $sUpdated, $supplier];
    }

    //delete supplier
    public function destroy($id)
    {
        $supplier = Supplier::findorFail($id);

        $sdelete = $supplier->delete();
    
        return ['Supplier successfully deleted'=> $sdelete];
    }
}
