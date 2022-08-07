
@extends('front.layouts.master')
@section('title',$article->title)
@section('bg',$article->image)
@section('content')

         <div class="col-md-9 mx-auto">
           <br>
               {!!$article->content!!}
            <p>   <span class="text-danger">Okunma Sayısı :  <b>{{$article->hit}}</b></span> </p>
               </div>

@endsection
