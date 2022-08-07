<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use File;

class CategoryController extends Controller
{
    public function index(){

      $categories=Category::all();
      return view('back.categories.index',compact('categories'));
    }

                           //dışarıdan veri alırken kullanıyoruz
    public function create(Request $request){

      $isExist=Category::whereSlug(str_slug($request->category))->first();
      if($isExist){

        return redirect()->back()->with('error',$request->category.' adında bir kategori zaten mevcut.');
      }
      $category= new Category;
      $category->name=$request->category;
      $category->slug=str_slug($request->category);
      $category->save();

      return redirect()->back()->with('success','Kategori Başarıyla Oluşturuldu');
    }

    public function getData(Request $request){

      $category= Category::findOrFail($request->id);
      return response()->json($category);


    }

    public function switch(Request $request){

      $category= Category::findOrFail($request->id);
      $category->status=$request->statu=="true" ? 1 : 0;
      $category->save();

    }

}
