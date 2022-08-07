<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //articleCount() fonksiyonunu kategoriye ait makale sayısını bulmak için kullanırız.
     public function articleCount(){
       return $this->hasMany('App\Models\Article','category_id','id')->count();
     }               //bağlanacağımız model  //bağlanacak sütun //bağlanacak id
}
