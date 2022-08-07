<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    public function index(){

      $config=Config::find(1); //ayarlar sütunu tek olacak bu nedenle tek veri çekilecek 1 yazdık.
      return view('back.config.index',compact('config'));
                                  //bu methodla view'e gönderdik.
    }
    public function update(Request $request){
      $config=Config::find(1);
      $config->title=$request->title;
      $config->active=$request->active;
      $config->twitter=$request->twitter;
      $config->github=$request->github;
      $config->instagram=$request->instagram;

      //file'lar
      if($request->hasFile('logo')){
        $logo=str_slug($request->title).'-logo.'.$request->logo->getClientOriginalExtension();
        $request->logo->move(public_path('uploads'),$logo);
        $config->logo='uploads/'.$logo;
      }
      if($request->hasFile('favicon')){
        $favicon=str_slug($request->title).'-favicon.'.$request->favicon->getClientOriginalExtension();
        $request->favicon->move(public_path('uploads'),$favicon);
        $config->favicon='uploads/'.$favicon;
      }
      $config->save();
      return redirect()->back()->with('success','Ayarlar başarıyla güncellendi.');
    }
}
