
@extends('front.layouts.master')
@section('title','İletişim')
@section('bg','https://www.meysaplastik.com.tr/resim/iletisim.png')
@section('content')

              <div class="col-md-10 col-lg-8 col-xl-7">
                @if(session('success'))

                <div class="alert alert-success">
               <strong>  {{session('success')}}</strong>
              </div>

              @endif

              @if($errors->any())
               <div class="alert alert-danger">
                <ul>
                      @foreach ($errors->all() as $erros)
                       <li>{{$erros}}</li>
                      @endforeach
                </ul>

               </div>
              @endif
                  <p><h5>Bizimle iletişime geçebilirsiniz.</h5></p>
                      <form method="post" action="{{route('contact.post')}}">
                        @csrf
                          <div class="control-group">
                            <div class="form-group controls">
                              <label for="name">Ad Soyad</label>
                              <input class="form-control" value="{{old('name')}}" name="name" type="text" placeholder="Ad Soyadınız " data-sb-validations="required" />
                             <p class="help-block text-danger"></p>
                            </div>
                          </div>
                          <div class="control-group">
                            <div class="form-group controls">
                              <label for="email">Email adresi</label>
                              <input class="form-control" value="{{old('email')}}" name="email" type="email" placeholder="Email adresiniz" data-sb-validations="required,email" />
                          </div>
                          </div>
                          <div class="control-group">
                              <div class="form-group col-xs-12 controls">
                              <label>Konu</label>
                              <select class="form-control" name="topic">
                              <option>Bilgi</option>
                              <option>Destek</option>
                              <option>Genel</option>
                              </select>
                            </div>
                          </div>

                          <div class="control-group">
                              <div class="form-group floating-label-form-group control">
                              <label for="message">Mesajınız</label>
                              <textarea class="form-control" value="{{old('message')}}" name="message" placeholder="Mesajınız..." style="height: 12rem" data-sb-validations="required">
                              </textarea>
                          </div>
                          </div>
                          <br />

                          <button type="submit" class="btn btn-primary" id="sendMessageButton" >Gönder</button>

                      </form>
                  </div>

@endsection
