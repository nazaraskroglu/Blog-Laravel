@extends('back.layouts.master')
@section('title',$article->title.' Makalesini Güncelle')
@section('content')

  <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">makaleyi güncelle..</h6>
      </div>
      <div class="card-body">

        @if($errors->any())
          <div class="alert alert-danger">
         @foreach ($errors->all() as $error)
           <li>
             {{$error}}
           </li>
         @endforeach
         </div>
       @endif

      <form method="post" action="{{route('admin.makaleler.update',$article->id)}}" enctype="multipart/form-data">
       @method('PUT')  <!--PUT METHODUNU GÜNCELLEME İŞLEMLERİNDE KULLANIYORUZ! -->
        @csrf
        <div class="form-group">
          <label>Makale Başlığı</label>
          <input type="text" name="title" class="form-control" value="{{$article->title}}" required ></input>
       </div>
<!-- value varsayılan (başlangıç değerini) yazar! -->
       <div class="form-group">
         <label>Makale Kategorisi</label>
         <select class="form-control" name="category" required>
          <option value="">Seçim Yapısı</option>
           @foreach ($categories as $category)
             <option @if($article->category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
           @endforeach  <!-- selected ta  önceden seçilmiş öğeyi getirir-->
            </select>
      </div>

      <div class="form-group">
        <label>Makale Fotoğrafı</label><br>

        <input type="file" name="image" class="form-control"  ></input>
          <img src="{{asset($article->image)}}" class="img-thumbnail rounded" width="300">
     </div>

     <div class="form-group">
       <label>Makale İçeriği</label>                                           <!--bir önceki yazıyı göstermek için -->
       <textarea id="summernote" name="content" class="form-control" rows="4" >{{$article->content}}</textarea>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block">Makaleyi Güncelle</button>
   </div>

      </form>
      </div>
</div>

@endsection

<!--- bu iki kütüphaneyi footerda yield yaptık section ile de sadece bu dosyada kullanılmasını sağladık. --->
@section('css')
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> <!--önce css dosyasını görmeli bu nedenle üste onu yazdık -->
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
   $(document).ready(function() {
       $('#summernote').summernote(
         {
           'height':250
         }
       );

   });
 </script>
@endsection
