{{--
    RENDERS DEL LAYOUT:

    A. CABECERA HTML:
    1.  pagename : nombre de esta página (you don't say)
    2.  custom_css : si necesitas importar CSS personalizado
    3.  dependencies : si necesitas importar dependencias específicas para esta página, ej. bootstrap, jquery

    B. CUERPO HTML:
    4.  header : para contenido del encabezado como barra de navegación, alertas, errores, etc.
    5.  content : contenido principal de esta página
    6.  footer

    C. FUERA DEL CUERPO HTML:
    7.  js_script
--}}

@extends('layouts.layout')

@section('pagename')
    Portable
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{asset('build/css/admin_customer.css')}}">
@endsection

@section('dependencies')
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

@section('content')
    <div class="row m-0" style="height: 100vh">
        {{-- BARRA LATERAL --}}
        @include('admin.partial.sidebar')

        {{-- CONTENIDO --}}
        <div class="col p-4" style="background-color:rgb(240, 240, 240)">
            {{-- BARRA DE BÚSQUEDA, NOTIFICACIÓN, PERFIL --}}
            <div class="row m-0 ">
                <div class="col">
                    <h3 class="m-0 p-0">Configuraciones</h3>
                </div>
                <div class="col-2 d-flex justify-content-end align-items-center">
                    <div class="notification me-4">
                        <img src="{{asset("storage/images/admin/notification.png")}}" alt="" width="30px">
                    </div>
                    <div class="profile">
                        <img src="{{asset("storage/images/admin/profile.jpg")}}" alt="" width="45px" height="45px" style="border-radius: 50%">
                    </div>
                </div>
            </div>

            {{-- AGREGAR ANUNCIO DEL DESARROLLADOR --}}
            <div class="bg-light rounded-4 p-4 my-4" id="postContainer" >
                <div class="row h-100">
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <img class="" src="{{asset('storage/images/admin/post.png')}}" alt="" width="100px" height="100px">
                    </div>
                    <div class="col-10">
                        {{-- AGREGAR PUBLICACIÓN --}}
                        <h2 class="mb-3">𝑪𝒓𝒆𝒂 𝒖𝒏𝒂 𝒑𝒖𝒃𝒍𝒊𝒄𝒂𝒄𝒊ó𝒏...</h2>
                        <form action="{{url('admin/settings/addPost')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-10">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Título de la publicación" name="title">
                                        <label for="floatingInput">Título de la publicación</label>
                                        {{-- ERROR --}}
                                        @error('title')
                                            @include('partial.validationMessage')
                                        @enderror
                                    </div>

                                    <div class="form-floating">
                                        <textarea class="form-control" name="caption" placeholder="Escribe aquí..." id="floatingTextarea2" style="height: 150px"></textarea>
                                        <label for="floatingTextarea2">Descripción de la publicación</label>
                                        {{-- ERROR --}}
                                        @error('caption')
                                            @include('partial.validationMessage')
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="h-100">
                                        <input type="submit" class="btn w-100 h-100 text-light" value="¡Publicar!" style="background-color: #FEB139">
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <h3>Anuncios</h3>
            @foreach ($posts as $post)
            <div class="bg-light rounded-4 p-4 my-4">
                <div class="row h-100">
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <img class="" src="{{asset('storage/images/admin/post.png')}}" alt="" width="100px" height="100px">
                    </div>
                        <div class="col-8">
                            {{-- <h4>{{$post->post_title}}</h4>
                            <p>{{$post->post_caption}}</p> --}}
                            <h4>{{$post->title}}</h4>
                            <p class="m-0">{{$post->caption}}</p>
                        </div>
                        <div class="col-2 d-flex justify-content-end align-items-center">
                            @if($post->trashed())
                                <a class="w-75" href={{url("admin/settings/deletePost/$post->id")}}>
                                    <button class="btn btn-success w-100">Restaurar publicación</button>
                                </a>
                            @else
                                <a class="w-75" href={{url("admin/settings/deletePost/$post->id")}}>
                                    <button class="btn btn-danger w-100">Eliminar publicación</button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

@endsection

@section('js_script')
    <script>
        $(document).ready(function(){
            console.log('¡Bienvenido Administrador!');
        });
    </script>
@endsection

