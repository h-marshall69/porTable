{{--
    RENDERS DEL LAYOUT:

    A. CABECERA HTML (HEAD):
    1.  pagename: nombre de esta página (ni que lo dijeras)
    2.  custom_css: si necesitas importar CSS personalizado hecho a mano
    3.  dependencies: si necesitas importar dependencias específicas para esta página, ej. bootstrap, jquery

    B. CUERPO HTML (BODY):
    4.  header: para contenidos del encabezado como navbar, alertas, errores, etc.
    5.  content: contenidos principales de esta página
    6.  footer

    C. FUERA DEL BODY HTML:
    7.  js_script

--}}

{{--
    ¡¡¡POR FAVOR LEER AMIGUITOS!!!
    user = Variable para obtener los datos del usuario que está logueado
--}}

@extends('layouts.layout')

@section('pagename')
    Portable
@endsection

@php
@endphp

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('build/css/customer_home.css') }}">
    <style>
        .navigation:hover {
            transform: scale(1.2);
            font-weight: 600;
            cursor: pointer;
        }

        .content {
            height: calc(100vh - 80px);
        }
        @media (max-width: 1025px){
            .content {
                height: 100%;
            }
        }
        @media (max-width: 481px){

        }
    </style>
@endsection

@section('dependencies')
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

{{-- OBTENER VALOR NUMÉRICO --}}
@php
    $phone = '';
    $number = '1234567890';
    $arrNum = str_split($number);

    foreach (str_split($user['phone']) as $num) {
        if (Str::contains($num, $arrNum)) {
            $phone .= $num;
        }
    }
    $arrName = explode(' ', $user['full_name']);
@endphp

@section('content')
<div class="container">
    {{-- NAVBAR --}}
    @include('customer.partial.navbar')
    {{-- CONTENIDO --}}
    <div class="content py-4">
        <div class="row m-0 h-100">
            {{-- CONTENIDO IZQUIERDO --}}
            <div class="col-sm-12 col-md-6 h-100 mb-4">
                <form action="{{url('customer/editProfile')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="mb-3">
                        <p class="m-0" style="font-size: 2.5em;font-weight: bold;">Perfil</p>
                        <p class="m-0">Actualiza tu foto de perfil y tus datos personales aquí</p>
                    </div>

                    {{-- IMAGEN --}}
                    <div class="row mb-3">
                        <div class="col-4 d-flex align-items-center">
                            <p class="m-0">Foto de perfil</p>
                        </div>
                        <div class="col d-flex">
                            <div class="row m-0 w-100">
                                <div class="col-sm-6 col-lg-4">
                                    <img class="dropdown-toggle" role="button" data-bs-toggle="dropdown" src="{{ asset('storage/images/customer/'.$user['full_name'].'/pp.jpg') }}" alt="" width="70px" height="70px" style="border-radius: 50%">
                                </div>
                                <div class="col-sm-12 col-lg-8 p-0">
                                    <label class="form-label">Subir foto del usuario (archivo jpg/png/jpeg):</label>
                                    <input type="file" name="foto" class="form-control w-100">
                                    @error('foto')
                                        @include('partial.validationMessage')
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- NOMBRE --}}
                    <div class="row mb-3">
                        <div class="col-4 d-flex align-items-center">
                            <p class="m-0">Nombre de usuario</p>
                        </div>
                        <div class="col d-flex align-items-center">
                            <input type="text" class="form-control" name="username" value="{{ $user['username'] }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 d-flex align-items-center">
                            <p class="m-0">Nombre</p>
                        </div>
                        <div class="col d-flex align-items-center">
                            <input type="text" class="form-control" name="firstname" value="{{ $arrName[0] }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 d-flex align-items-center">
                            <p class="m-0">Apellido</p>
                        </div>
                        <div class="col d-flex align-items-center">
                            <input type="text" class="form-control" name="lastname" value="{{ $arrName[1] }}">
                        </div>
                    </div>

                    {{-- TELÉFONO Y DIRECCIÓN --}}
                    <div class="row mb-3">
                        <div class="col-4">
                            <p class="m-0">Número de teléfono</p>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="phone" value="{{ intval($phone) }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 d-flex align-items-center">
                            <p class="m-0">Dirección</p>
                        </div>
                        <div class="col d-flex align-items-center">
                            <input type="text" class="form-control" name="address" value="{{ $user['address'] }}">
                        </div>
                    </div>

                    {{-- FECHA DE NACIMIENTO --}}
                    <div class="row mb-3">
                        <div class="col-4">
                            <p class="m-0">Fecha de nacimiento</p>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" name="birthdate" value="{{ $user['date_of_birth'] }}">
                        </div>
                    </div>

                    {{-- CONTRASEÑA --}}
                    <div class="row mb-3">
                        <div class="col-4 d-flex align-items-center">
                            <p class="m-0">Contraseña</p>
                        </div>
                        <div class="col d-flex align-items-center">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <button type="submit" class="submit btn p-2 text-light w-100" style="background-color: #ed3b27">
                        Actualizar perfil
                    </button>
                </form>
            </div>

            {{-- CONTENIDO DERECHO --}}
            <div class="col-sm-12 col-md-6 h-100 overflow-auto d-flex flex-column">
                <div class="mb-3">
                    <p class="m-0" style="font-size: 2em;font-weight: bold;">Reserva próxima</p>
                    <p class="m-0">Este es el ticket de tu reserva más cercana</p>
                </div>
                <div id="reservation_container" class="reservation_container d-flex">
                    @if ($activeReservation != null)
                        <div class="ticket">
                            {{-- TARJETA DE RESERVA --}}
                            <div class="mb-3 me-2 w-100" style="position: relative;">
                                <a class="text-dark p-0" style="text-decoration: none;" href="/customer/restaurant/{{$activeReservation->restaurant->full_name}}">
                                    {{-- ETIQUETA DE EVENTO --}}
                                    <div class="number_container" style="position: absolute;top:30px;right:5%;">
                                        <div class="event_label text-light p-3 rounded-3 text-center navigation" style="background-color: #6C4AB6;">{{$activeReservation->table->seats}}</div>
                                        <div class="cancel_container">
                                            {{-- BOTÓN CANCELAR --}}
                                            <a id="opencancel_{{$activeReservation->id}}" onclick="opencancel({{$activeReservation->id}})">
                                                <button class="btn event_label text-light p-1 rounded-3 text-center navigation" style="background-color: #ed3b27;">Cancelar</button>
                                            </a>
                                            {{-- CONFIRMACIÓN --}}
                                            <div id="cancelconfirmation_{{$activeReservation->id}}" class="cancel_confirmation bg-light p-2 rounded-3 d-none">
                                                <p class="m-0">¿Cancelar?</p>
                                                <a onclick="cancel_reservation({{$activeReservation->id}})">
                                                    <button class="btn event_label text-light p-1 rounded-3 text-center navigation" style="background-color: #06c700;">Sí</button>
                                                </a>
                                                <a onclick="closecancel({{$activeReservation->id}})">
                                                    <button class="btn btn-dark m-0 event_label text-light p-1 rounded-3 text-center navigation">No</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- CONTENIDO DE LA TARJETA --}}
                                    <div class="restaurant_card bg-light p-3">
                                        <div class="image_container" style="height: 15rem">
                                            @php
                                                $activeReservation_restaurant = $activeReservation->restaurant->full_name;
                                            @endphp
                                            <img src="{{asset("storage/images/restaurant/$activeReservation_restaurant/restaurant_1.jpg")}}" alt="" width="100%" height="100%">
                                        </div>

                                        {{-- INFORMACIÓN DEL RESTAURANTE --}}
                                        <div class="row m-0 mt-2 overflow-auto" style="height: 6rem">
                                            <div class="col-10">
                                                <div class="restaurant_info">
                                                    <p class="m-0" style="font-family: helvetica_bold;font-size: 1.5em">{{$activeReservation->restaurant->full_name}}</p>
                                                    <p class="m-0" style="font-family: helvetica_regular;font-size: 0.8em;color: rgb(111, 111, 111);">{{$activeReservation->restaurant->description}}</p>
                                                </div>
                                            </div>
                                            <div class="col-2 d-flex justify-content-end align-items-center">
                                                <p class="m-0">1</p>
                                                <img src="{{asset('storage/images/customer/person.png')}}" alt="" width="30px" height="30px">
                                            </div>
                                        </div>

                                        <hr>

                                        {{-- DETALLES DE LA TRANSACCIÓN --}}
                                        <div class="code d-flex justify-content-end">
                                            <div class="text-end">
                                                <p class="m-0" style="font-family: helvetica_regular;">Precio: Rp {{$activeReservation->restaurant->price}}</p>
                                                <p class="m-0" style="font-family: helvetica_regular;">Fecha de la reserva: {{$activeReservation->reservation_date_time}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="d-flex w-100 justify-content-start">
                            <p class="m-0">Actualmente no tienes ninguna transacción</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_script')
<script>
    $(document).ready(function() {
        console.log('¡Bienvenido Cliente!');
    });

    function opencancel(reservation_id){
        $("#opencancel_" + reservation_id).addClass("d-none");
        $("#cancelconfirmation_" + reservation_id).removeClass("d-none");
    }

    function closecancel(reservation_id){
        $("#cancelconfirmation_" + reservation_id).addClass("d-none");
        $("#opencancel_" + reservation_id).removeClass("d-none");
    }

    function cancel_reservation(reservation_id){
        $.ajax({
            type: "get",
            url: "/customer/cancelClosestUpcomingTransaction",
            data: {
                'reservation_id': reservation_id
            },
            success: function(response) {
                $("#reservation_container").html(response);
            },
        });
    }
</script>
@endsection

