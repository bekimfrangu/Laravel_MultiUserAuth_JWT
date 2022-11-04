<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
      //Get all orders
      public function index()
      {
          return Order::all();
      }
  
      //Insert order
      public function store()
      {
          request()->validate([
              'user_id'=>'required',
              'shipper_id'=>'required',
              'order_date'=>'required',
              'status'=>'required',
              'address'=>'required'
          ]);
      
          return Order::create([
                  'user_id'=> request('user_id'),
                  'shipper_id'=> request('shipper_id'),
                  'order_date'=> request('order_date'),
                  'status'=> request('status'),
                  'address'=> request('address')
          ]);
      }
  
      //Get speicifc order
      public function order($id)
      {  
          $order = Order::findorFail($id);
          return $order;
      }
  
      //update order
      public function update($id)
      {
          $order = Order::findorFail($id);
  
          request()->validate([
            'user_id'=>'required',
            'shipper_id'=>'required',
            'order_date'=>'required',
            'status'=>'required',
            'address'=>'required'
        ]);
      
          $updated = $order->update([
                  'user_id'=> request('user_id'),
                  'shipper_id'=> request('shipper_id'),
                  'order_date'=> request('order_date'),
                  'status'=> request('status'),
                  'address'=> request('address')
          ]);
  
          return ['Order successfully updated'=> $updated, $order];
      }
  
      //delete order
      public function destroy($id)
      {
          $order = Order::findorFail($id);
  
          $delete = $order->delete();
      
          return ['Order successfully deleted'=> $delete];
      }
}
