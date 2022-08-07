<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;


use Validator;

class Homepage extends Controller
{

  public function __construct(){
    //site aktifliğini burada yaptık:
    if(Config::find(1)->active==0){
      return redirect()->to('Site-bakimda')->send();
    }


    view()->share('pages',Page::orderBy('order','ASC')->get());
    view()->share('categories',Category::inRandomOrder()->get());
  }

  public function index(){
    $data['articles']=Article::orderBy('created_at','Desc')->get();
    return view('front.homepage',$data);
  }

 public function single($category,$slug){
   Category::whereSlug($category)->first() ?? abort(403,'Böyle bir kategori bulunamadı.. ');
   $article=Article::Where('slug',$slug)->first() ?? abort(403,'Böyle bir yazı bulunamadı..');
// dd($article);
   $article->increment('hit');
   $data['article']=$article;
   return view('front.single',$data);
 }

 public function category($slug){
    $category=Category::whereSlug($slug)->first() ?? abort(403,'Böyle bir kategori bulunamadı.. ');
    $data['category']=$category;
    $data['articles']=Article::where('category_id',$category->id)->orderBy('created_at','Desc')->get();
    return view('front.category',$data);
 }

 public function page($slug){
   $page=Page::whereSlug($slug)->first() ?? abort(403,'Böyle bir kategori bulunamadı.. ');
   $data['page']=$page;
   return view('front.page',$data);
 }

 public function contact(){
   return view('front.contact');
 }

 public function contactpost(Request $request){  //mail işlemleri:

   $rules=[
     'name'=>'required|min:5',
     'email'=>'required|email',
     'topic'=>'required',
     'message'=>'required|min:10',
   ];

   $validate=Validator::make($request->post(),$rules);

   if($validate->fails()){

    return redirect()->route('contact')->withErrors($validate)->withInput();

   }




//   $contact = new Contact;
//    $contact->name=$request->name;
//    $contact->email=$request->email;
//    $contact->topic=$request->topic;
//    $contact->message=$request->message;
//    $contact->save();
   return redirect()->route('contact')->with('success','Mesajınız iletildi! Teşekkür ederiz.');
 }

}
