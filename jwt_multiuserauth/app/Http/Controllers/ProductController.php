<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
      //Get all products
      public function index()
      {
          return Product::all();
      }
  
      //Insert a product
      public function store(Request $request)
      {
          $request->validate([
              'product'=>'required',
              'category_id'=>'required',
              'supplier_id'=>'required',
              'price'=>'required',
              'weight'=>'required',
              'description'=>'required',
              'stock_status'=>'required',
              'image'=>'required'
          ]);
 
          $product=new Product();
            
          $product->product = $request->product;
          $product->category_id = $request->category_id;
          $product->supplier_id = $request->supplier_id;
          $product->price = $request->price;
          $product->weight = $request->weight;
          $product->stock_status = $request->stock_status;
          $product->description = $request->description;
 
          $filename="";
          if($request->hasFile('image')){
              $filename=$request->file('image')->store('uploads','public');
          }else{
              $filename=Null;
          }
  
          $product->image=$filename;
          $result=$product->save();
          if($result){
              return response()->json(['success'=>true]);
          }else{
              return response()->json(['success'=>false]);
          }
      }
  
      //Get specific product
      public function product($id)
      {  
          $product = Product::findorFail($id);
          return $product;
      }
  
      //update product
      public function update(Request $request, $id)
      {
          $product = Product::findorFail($id);

            $request->validate([
                'product'=>'required',
                'category_id'=>'required',
                'supplier_id'=>'required',
                'price'=>'required',
                'weight'=>'required',
                'description'=>'required',
                'stock_status'=>'required',
                'image'=>'required'
            ]);
 
            $product->product = $request->product;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->price = $request->price;
            $product->weight = $request->weight;
            $product->stock_status = $request->stock_status;
            $product->description = $request->description;
 
         $destination=public_path("storage\\".$product->image);
         $filename="";
         if($request->hasFile('new_image')){
             if(File::exists($destination)){
                 File::delete($destination);
             }
 
             $filename=$request->file('new_image')->store('uploads','public');
         }else{
             $filename=$request->image;
         }
 
         $product->image=$filename;
         $result=$product->save();
         if($result){
             return response()->json(['success'=>true]);
         }else{
             return response()->json(['success'=>false]);
         }
      }

      //delete product
      public function destroy($id)
      {
          $product = Product::findorFail($id);
  
          $destination=public_path("storage\\".$product->image);
          if(File::exists($destination)){
              File::delete($destination);
          }
          $result=$product->delete();
          if($result){
              return response()->json(['success'=>true]);
          }else{
              return response()->json(['success'=>false]);
          }
      }
}
