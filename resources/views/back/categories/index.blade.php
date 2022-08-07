@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')

<div class="row ">

<div class="col md-4">
  <div class="card shadow mb-4">
   <div class="card-header py-3">
   <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluşur</h6>
    </div>
     <div class="card-body">
     <form method="post" action="{{route('admin.category.create')}}">
       @csrf
       <div class="form-group">
         <label>Kategori Adı</label>
          <input type="text" class="form-control" name="category" required />
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Ekle</button>
      </div>
     </form>
  </div>
  </div>
</div>


<div class="col md-8">
  <div class="card shadow mb-4">
   <div class="card-header py-3">
   <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
     <div class="card-body">

       <div class="card-body">
           <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                       <tr>
                           <th>Kategori Adı</th>
                           <th>Makale Sayısı</th>
                           <th>Durum</th>

                       </tr>
                   </thead>
                   <tbody>
                    @foreach($categories as $category)
                     <tr>
                         <td>{{$category->name}}</td>
                        <td>{{$category->articleCount()}}</td>
                        <td>
                          <input class="switch" category-id="{{$category->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($category->status==1) checked
                           @endif data-toggle="toggle" data-width="80" >
                        </td>

                        <!-- <td >
                              <a category-id="" class="btn btn-sm btn-primary edit-click" title="Kategoriyi Düzenle"><i class="fa fa-edit text-white"></i></a>
                       <td>

                       <a href="#" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times "></i></a>
                         </td> -->
                     </tr>
                   </tbody>
                 @endforeach
               </table>
           </div>
  </div>
  </div>
</div>
</div>

<!-- The Modal -->
<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Kategoriyi Düzenle</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="get">
          @csrf
        <div class="form-group">
          <label>Kategori Adı</label>
          <input id="category" type="text" class="form-control" name="category"/>
        </div>

        <div class="form-group">
          <label>Kategori Slug</label>
          <input id="slug" type="text" class="form-control" name="slug"/>
        </div>

        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-success">Kaydet</button>
      </div>

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

    $('.edit-click').click(function(){
      id = $(this)[0].getAttribute('category-id');
      $.ajax({
        type:'GET',
        url:'{{route('admin.category.getData')}}',
        data:{id:id},
        success:function(data){
          console.log(data);
          $('#editModal').modal();
        }
      })


    });


   $('.switch').change(function() {
     id = $(this)[0].getAttribute('category-id');
     statu=$(this).prop('checked');
     $.get("{{route('admin.category.switch')}}", {id::id,statu:statu}, function(data, status){});
   })
 })

  </script>
@endsection
