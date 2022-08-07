
@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')


                <div class="col-md-10  mx-auto">
                  @include('front.widgets.CategoryWid')
                    <!-- Post preview-->
                    @foreach($articles as $article)
                    <div class="post-preview">
                        <a href="{{route('single', [$article->getCategory->slug,$article->slug])}}">
                            <h2 class="post-title">{{$article->title}}</h2>
                            <img src="{{$article->image}}" />
                            <h3 class="post-subtitle">{!!str_limit($article->content,75)!!}</h3>
                        </a>
                       <p class="post-meta" style="font-size: 12pt;"> <h6>Kategori:
                            <a href="#" style="font-size: 12pt;">{{$article->getCategory->name}} -

                          <span class="float-right"  style="font-size: 12pt; " >{{$article->created_at->diffForHumans()}}</span></p>
                    </div>
<!--sonuncu değil ise çalıştır-->@if(!$loop->last)
                            <hr class="my-4" />
                           @endif
                      @endforeach
</h6>
            </div>
        <!-- Bootstrap core JS-->
        <script src="{{asset('front/')}}/https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('front/')}}/js/scripts.js"></script>

    </body>
</html>

@endsection
