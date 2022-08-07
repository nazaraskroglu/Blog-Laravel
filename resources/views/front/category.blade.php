
@extends('front.layouts.master')
@section('title',$category->name,'Kategorisi')
@section('content')
 @include('front.widgets.CategoryWid')

                <div class="col-md-10  mx-auto">
                    @if(count($articles)>0)
                    @foreach($articles as $article)
                    <div class="post-preview">
                        <a href="{{route('single', [$article->getCategory->slug,$article->slug])}}">
                            <h2 class="post-title">{{$article->title}}</h2>
                            <img src="{{$article->image}}" />
                            <h3 class="post-subtitle">{!!str_limit($article->content,75)!!}</h3>
                        </a>
                        <p class="post-meta"> Kategori:
                            <a href="#">{{$article->getCategory->name}}</a>
                          <span class="float-right">{{$article->created_at->diffForHumans()}}</span></p>
                    </div>
<!--sonuncu değil ise çalıştır-->@if(!$loop->last)
                            <hr class="my-4" />
                                 @endif
                    @endforeach
                  @else
                    <div class="alert ">
                   <h3>Bu kategoriye ait yazı bulunamadı:(</h3>
                    </div>
                  @endif
                    <!-- Pager-->
          <!--          <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
          </div>  -->
            </div>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>


@endsection
