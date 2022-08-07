
@isset($categories)
<div class="col-md-10 ">
  <a class="card">
    <div class="card-Header">
  &nbsp&nbsp  Kategoriler
    </div>
  </a>
    <div class="list-group list-group-numbered">
       @foreach($categories as $category)
      <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-3 me-auto">
              <div class="fw-bold"><a href="{{route('category',$category->slug)}}">{{$category->name}} </a></div>
            </div>
          <span class="badge bg-success rounded-pill">{{$category->articleCount()}}</span>
        </li>
 @endforeach
  </div>
</div>
</div>
@endif









    <!--    <div class="margin-left:auto">
        <div class="list-group list-group-numbered">
      <a class="list-group-item disabled" aria-disabled="true">   Kategoriler</a>

            <a class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-1 me-auto">
                <div class="fw-bold"> <a href= </div>
                </div>
            <span class="badge bg-primary rounded-pill"> </span>

                </a>
                </div>
              </div>
            </div> -->
