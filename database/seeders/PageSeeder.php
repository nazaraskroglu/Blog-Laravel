<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $pages=['Hakkımızda','Kariyer','Vizyonumuz'];
      $count=0;
      foreach($pages as $page){
        $count++;
        DB::table('pages')->insert([
          'title'=>'$page',
          'slug'=>str_slug($page),
          'image'=>'https://media.istockphoto.com/photos/businessman-trading-online-stock-market-on-teblet-screen-digital-picture-id1311598658?k=20&m=1311598658&s=612x612&w=0&h=DsH-Xq0w9pENqAw2i9EU4u4t-GZBKNndseKeOleByiY=',
          'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
          'order'=>$count,
         'created_at'=>now(),
         'updated_at'=>now()
       ]);
      }

    }
}
