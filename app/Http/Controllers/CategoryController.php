<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
     //Get all categories
     public function index()
     {
         return Category::all();
     }
 
     //Insert a category
     public function store(Request $request)
     {
         $request->validate([
             'category'=>'required',
             'description'=>'required',
             'image'=>'required'
         ]);

         $category=new Category();
           
         $category->category = $request->category;
         $category->description = $request->description;

         $filename="";
         if($request->hasFile('image')){
             $filename=$request->file('image')->store('uploads','public');
         }else{
             $filename=Null;
         }
 
         $category->image=$filename;
         $result=$category->save();
         if($result){
             return response()->json(['success'=>true]);
         }else{
             return response()->json(['success'=>false]);
         }
     }
 
     //Get specific category
     public function category($id)
     {  
         $category = Category::findorFail($id);
         return $category;
     }
 
     //update category
     public function update(Request $request, $id)
     {
         $category = Category::findorFail($id);
 
         $request->validate([
            'category'=>'required',
            'description'=>'required',
            'image'=>'required'
        ]);

        $category->category = $request->category;
        $category->description = $request->description;

        $destination=public_path("storage\\".$category->image);
        $filename="";
        if($request->hasFile('new_image')){
            if(File::exists($destination)){
                File::delete($destination);
            }

            $filename=$request->file('new_image')->store('uploads','public');
        }else{
            $filename=$request->image;
        }

        $category->image=$filename;
        $result=$category->save();
        if($result){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }

     }
 
     //delete category
     public function destroy($id)
     {
         $category = Category::findorFail($id);
 
         $destination=public_path("storage\\".$category->image);
         if(File::exists($destination)){
             File::delete($destination);
         }
         $result=$category->delete();
         if($result){
             return response()->json(['success'=>true]);
         }else{
             return response()->json(['success'=>false]);
         }
     }
}
