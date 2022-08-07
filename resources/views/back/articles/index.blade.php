@extends('back.layouts.master')
@section('title','Tüm Makaleler')
@section('content')

  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <a href="{{route('admin.trashed.article')}}" class=" m-0 float-right btn btn-warning btn-sm"><i class="fa fa-trash">Silinen Makaleler</i></a>
          <h6 class="m-0 font-weight-bold text-primary"><strong>{{$articles->count()}}</strong> makale bulundu.</h6>
      <br>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Fotoğraf</th>
                          <th>Makale Başlığı</th>
                          <th>Kategori</th>
                          <th>Hit</th>
                          <th>Oluşturulma Tarihi</th>
                          <th>Durum</th>
                          <th> İşlemleriniz</th>
                      </tr>
                  </thead>
                   @foreach($articles as $article)
                  <tbody>

                    <tr>
                        <td>
                          <img src="{{asset($article->image)}}" width="200">
                        </td>
                        <td> {{$article->title}} </td>
                         <td> {{$article->getCategory->name}}</td>
                        <td> {{$article->hit}}</td>
                        <td> {{$article->created_at->diffForHumans()}}</td>
                       <td>
                         <input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($article->status==1) checked @endif data-toggle="toggle" data-width="80" >

                       </td>
                        <td > <!--target=_blank: yan sekmede açar-->
                         <a target="_blank" href="{{route('single',[$article->getCategory->slug,$article->slug])}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                         <a href="{{route('admin.makaleler.edit',$article->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                         <a href="{{route('admin.delete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                          </form>
                        </td>
                    </tr>
                  </tbody>
                @endforeach
              </table>
          </div>
      </div>
  </div>

@endsection

<!--toggle switch işlemi -->
@section('css')
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
 <script>

 $(function() {
   $('.switch').change(function() {
     id = $(this)[0].getAttribute('article-id');
     statu=$(this).prop('checked');
     $.get("{{route('admin.switch')}}", {id::id,statu:statu}, function(data, status){});
   })
 })

  </script>
@endsection
