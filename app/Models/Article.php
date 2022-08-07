<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use softDeletes;
    function getCategory(){
      return $this->hasOne('App\Models\Category','id','category_id');
    }
}
