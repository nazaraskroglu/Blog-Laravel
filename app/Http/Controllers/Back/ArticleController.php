<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $articles=Article::orderBy('created_at','ASC')->get();
       return view('back.articles.index',compact('articles')); // compact yukarıdaki articlesi gönderiyor.

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //oluşturma fonksiyonu.
    {
       $categories=Category::all();
        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)  //oluşturma işlemini kaydetme.
    {
        $request->validate([
          'title'=>'min:3',
          'image'=>'required|image|max:2050'
        ]);

        $article=new Article;
        $article->title=$request->title;
        $article->category_id=$request->category;
        $article->content=$request->content;
        $article->slug=str_slug($request->title);

        if($request->hasFile('image')){
        $imageName=str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads'),$imageName);
        $article->image='uploads/'.$imageName;
        }
        $article->save();

        return redirect()->route('admin.makaleler.index')->with('success','Makale Başarıyla Oluşturuldu.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //görüntüleme sayfası
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //düzenleme sayfası güncellemeleri göreceğimi yer burası.
    {
      $article=Article::findOrFail($id); // findOrFail data varsa gösterir yoksa 404notfound dönderir.

      $categories=Category::all();
       return view('back.articles.update',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //güncellemeleri gerçekleştirir.
    {
      $request->validate([
        'title'=>'min:3',
        'image'=>'image|max:2050'
      ]);

      $article= Article::findOrFail($id); //new article'ı silip onun yerine var olan id'yi kontrol ettik.
      $article->title=$request->title;
      $article->category_id=$request->category;
      $article->content=$request->content;
      $article->slug=str_slug($request->title);

      if($request->hasFile('image')){
      $imageName=str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
      $request->image->move(public_path('uploads'),$imageName);
      $article->image='uploads/'.$imageName;
      }
      $article->save();
      return redirect()->route('admin.makaleler.index')->with('success','Makale Başarıyla Güncellendi.');

    }

// bunu biz ekledik bu nedenle route'ta tanımlamamız gerekli.
  public function switch(Request $request){

      $article= Article::findOrFail($request->id);
      $article->status=$request->statu=='true' ? 1 : 0;
      $article->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function delete($id) //silme.
     {
         Article::find($id)->delete();
         return redirect()->route('admin.makaleler.index')->with('success','Silinen makalelere taşındı.');
     }

     public function trashed() //silinen veriler
     {
                         //onlyTrashed=sadece silinenleri bul
         $articles= Article::onlyTrashed()->orderBy('deleted_at','ASC')->get();
         return view('back.articles.trashed',compact('articles'));
     }

     public function recover($id){ //silinen veriyi kurtar.

                                        //restore silinen veriyi kurtarır.
      Article::withTrashed()->find($id)->restore();
      return redirect()->back()->with('success','Makale kurtarıldı.');
     }

     public function hardDelete($id) // tamamen silme.
     {
        $article=Article::onlyTrashed()->find($id);
         if(File::exists($article->image)){
           File::delete(public_path($article->image));
         }     //veriyi silince resim uploads ta kalıyordu bu nedenle resmide bul dosyadan sil dedik.

         $article->forceDelete();   //forceDelete veriyi tamamen siler.
         return redirect()->route('admin.makaleler.index')->with('success','Makale başarıyla silindi');
     }

}
