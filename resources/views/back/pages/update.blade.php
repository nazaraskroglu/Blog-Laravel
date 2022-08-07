@extends('back.layouts.master')
@section('title',$page->title.' sayfasını Güncelle')
@section('content')

  <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sayfayı güncelle..</h6>
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

      <form method="post" action="{{route('admin.page.edit.post',$page->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Sayfa Başlığı</label>
          <input type="text" name="title" class="form-control" value="{{$page->title}}" required ></input>
       </div>

      <div class="form-group">
        <label>Sayfa Fotoğrafı</label><br>

        <input type="file" name="image" class="form-control"  ></input>
          <img src="{{asset($page->image)}}" class="img-thumbnail rounded" width="300">
     </div>

     <div class="form-group">
       <label>Sayfa İçeriği</label>                                           <!--bir önceki yazıyı göstermek için -->
       <textarea id="summernote" name="content" class="form-control" rows="4" >{{$page->content}}</textarea>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block">Sayfayı Güncelle</button>
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
