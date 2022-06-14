@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h5><b><i class="fas fa-user"></i> {{ __('Profil') }}</b></h5></div>
                    <div class="card-body">
                        @if(session('success'))
                            <div id="saved" class="alert alert-success" role="alert">
                                <strong>{{ __('Erfolgreich gespeichert!') }}</strong>
                            </div>
                        @endif
                        <div class="text-center">
                            <div id="not_saved_message" class="alert alert-warning" hidden role="alert">
                                <strong>{{ __('Nicht gespeicherte Änderungen!') }}</strong>
                            </div>
                        </div>
                        <form name="form" id="form" enctype="multipart/form-data" action="{{route('save_profile')}}" method="post">
                            @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <br>
                                <label for="name">{{ __('Name') }}</label>
                                <br>
                                <br>
                                <label for="password">{{ __('Passwort') }}</label>
                            </div>
                            <div class="col-md-7">
                                <br>
                                <input onkeyup="checkChanged()" type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                                       placeholder="{{__('Benutzername')}}">
                                <input type="text" id="oldName" value="{{$user->name}}" hidden>
                                <br>
                                <input onkeyup="checkChanged()" type="password" class="form-control" id="password" name="password"
                                       placeholder="{{__('Neues Passwort')}}">
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-2 text-center">
                                <img id="avatar_image" src="{{auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : "https://www.gravatar.com/avatar/" . md5( strtolower( trim( auth()->user()->email ) ) ) . "?s=" . 400}}"
                                     class="rounded-circle" style="width: 100%" alt="Profilbild"
                                     loading="lazy"/>
                                <a class="btn btn-outline-secondary mt-3" id="upload" onclick="openDialog()">
                                    <i class="fas fa-upload"></i>
                                    {{__('Bild hochladen')}}
                                </a>
                                <input onchange="blurImage()" id='avatar' name="avatar" type='file' hidden/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <button class="btn btn-outline-primary" id="save">
                                    <i class="fas fa-save"></i>
                                    {{__('Speichern')}}
                                </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
            function openDialog() {
            document.getElementById('avatar').click();
            }

            function blurImage() {
                var element = document.getElementById("avatar_image");
                element.classList.add("blur");
                checkChanged();
            }



            function checkChanged() {
                if (document.getElementById('password').value == "" && document.getElementById('name').value == document.getElementById('oldName').value && document.getElementById('avatar').value == "") {
                    document.getElementById('not_saved_message').hidden = true;
                }
                else {
                    document.getElementById('not_saved_message').hidden = false;
                    document.getElementById('saved').hidden = true;
                }
            }
    </script>
@endsection