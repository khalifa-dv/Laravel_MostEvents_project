@extends('layouts.template')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Your Profil </div>

                <div class="card-body">
                    <form method="POST" action="{{route('Clientsatuts.update',$users->id)}}"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
             <div class="col-3 p-2">
                 <img src="{{$users->avatar()}}" class="w-100 p-2">   
                     <input type="file" name="avatar"  class="form-control mt-5 @error('avatar') is-invalid @enderror" >
                     @error('avatar')
                        <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                        </span>
                          @enderror

                </div>

                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('firstname') }}</label>

                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $users->firstname }}" required autocomplete="firstname" autofocus>

                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('lastname') }}</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $users->lastname }} " required autocomplete="lastname" autofocus>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
            

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$users->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">
                            {{ __('Number Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $users->phone}}" required autocomplete="phone">

                             
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="adress" class="col-md-4 col-form-label text-md-right">{{ __('Adress') }}</label>

                            <div class="col-md-6">
                                <input id="adress" type="a" class="form-control @error('adress') is-invalid @enderror" name="adress" value="{{$users->adress}}" required autocomplete="adress">
        
                            
                            </div>
                        </div>
              

                            
    
                        
                           
                                <button type="submit" class="btn btn-primary " style="float: right;" >
                                    Save
                                </button>
                           
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
