@extends('back.layouts.master')
@section('title','Silinen Makaleler')
@section('content')

  <div class="card shadow mb-4">
      <div class="card-header py-3">

      <br>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Fotoğraf</th>
                          <th>Sayfa Başlığı</th>
                          <th>Kategori</th>
                          <th>Hit</th>
                          <th>Oluşturulma Tarihi</th>
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

                        <td >
                         <a href="{{route('admin.recover.article',$article->id)}}" title="Kurtar" class="btn btn-sm btn-success"><i class="fa fa-recycle"></i></a>
                         <a href="{{route('admin.hard.delete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>

                    </tr>
                  </tbody>
                @endforeach
              </table>
          </div>
      </div>
  </div>


@endsection
