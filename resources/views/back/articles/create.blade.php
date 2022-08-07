@extends('back.layouts.master')
@section('title','Makale Oluştur')
@section('content')

  <div class="card shadow mb-4">
      <div class="card-header py-3">
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

      <form method="post" action="{{route('admin.makaleler.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Makale Başlığı</label>
          <input type="text" name="title" class="form-control" required ></input>
       </div>

       <div class="form-group">
         <label>Makale Kategorisi</label>
         <select class="form-control" name="category" required>
          <option value="">Seçim Yapısı</option>
           @foreach ($categories as $category)
             <option value="{{$category->id}}">{{$category->name}}</option>
           @endforeach
            </select>
      </div>

      <div class="form-group">
        <label>Makale Fotoğrafı</label>
        <input type="file" name="image" class="form-control" required ></input>
     </div>

     <div class="form-group">
       <label>Makale İçeriği</label>
       <textarea id="summernote" name="content" class="form-control" rows="4" ></textarea>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block">Makaleyi Oluştur</button>
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
