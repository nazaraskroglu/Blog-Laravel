@extends('back.layouts.master')
@section('title','Tüm Sayfalar')
@section('content')

  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><strong>{{$pages->count()}}</strong> sayfa bulundu.</h6>
      <br>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                      <!--  <th>Sıralama</th>-->
                          <th>Fotoğraf</th>
                          <th>Sayfa Başlığı</th>
                          <th>Durum</th>
                          <th> İşlemler</th>
                      </tr>
                  </thead>
                <!--  <tbody id="orders"> -->
                   @foreach($pages as $page)
                  <tbody>

                    <tr>
                    <!--  <td style="max-height:3px"><i class="fa fa-arrows-alt-v fa-2x handle" style="cursor:move" ></i></td>-->
                        <td>
                          <img src="{{asset($page->image)}}" width="200">
                        </td>
                        <td> {{$page->title}} </td>
                       <td>
                         <input class="switch" page-id="{{$page->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($page->status==1) checked
                          @endif data-toggle="toggle" data-width="80" >
                       </td>
                        <td > <!--target=_blank: yan sekmede açar-->
                         <a target="_blank" href="{{route('page',$page->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                         <a href="{{route('admin.page.edit',$page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen "></i></a>
                         <a href="{{route('admin.page.delete',$page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times "></i></a>

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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

 <script>
 $(function() {
   $('.switch').change(function() {
     id = $(this)[0].getAttribute('page-id');
     statu=$(this).prop('checked');
     $.get("{{route('admin.switch')}}", {id::id,statu:statu}, function(data, status){});
   })
 })

  </script>
@endsection
