<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use File;

class PageController extends Controller
{
    public function index(){
      $pages=Page::all();

      return view('back.pages.index',compact('pages'));
    }

    public function orders(Request $request){
     foreach($request->get('page') as  $key => $order ){
       Page::where('id',$order)->update(['order'=>$key]);
     }
   }

    public function create(){

      return view('back.pages.create');
    }

    public function update($id){

      $page=Page::findOrFail($id);
      return view('back.pages.update',compact('page'));
    }

    public function updatePost(Request $request, $id) //güncellemeleri gerçekleştirir.
    {
      $request->validate([
        'title'=>'min:3',
        'image'=>'image'
      ]);

      $page= page::findOrFail($id); //new page'ı silip onun yerine var olan id'yi kontrol ettik.
      $page->title=$request->title;
      $page->content=$request->content;
      $page->slug=str_slug($request->title);

      if($request->hasFile('image')){
      $imageName=str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
      $request->image->move(public_path('uploads'),$imageName);
      $page->image='uploads/'.$imageName;
      }
      $page->save();
      return redirect()->route('admin.page.index')->with('success','Sayfa Başarıyla Güncellendi.');

    }

        public function delete($id) //silme.
        {
          $page=Page::find($id);
           if(File::exists($page->image)){
             File::delete(public_path($page->image));
           }     //veriyi silince resim uploads ta kalıyordu bu nedenle resmide bul dosyadan sil dedik.

           $page->delete();   //forceDelete veriyi tamamen siler.

           return redirect()->route('admin.page.index')->with('success','Sayfa başarıyla silindi.');
        }



        public function post(Request $request){
          $request->validate([
            'title'=>'min:3',
            'image'=>'required|image'
          ]);

          $last=Page::orderBy('order','desc')->first();
          $page= new Page;
          $page->title=$request->title;
          $page->content=$request->content;
          $page->order=$last->order+1;
          $page->slug=str_slug($request->title);

      if($request->hasFile('image')){
      $imageName=str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
      $request->image->move(public_path('uploads'),$imageName);
      $page->image='uploads/'.$imageName;
      }
      $page->save();

      return redirect()->route('admin.page.index')->with('success','Sayfa Başarıyla Oluşturuldu.');

    }



}
