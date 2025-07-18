{{--
    RENDERS DEL LAYOUT:

    A. CABECERA HTML:
    1.  pagename : nombre de esta página (obvio)
    2.  custom_css : si se necesita importar CSS personalizado
    3.  dependencies : si se necesita importar dependencias específicas para esta página, ej. Bootstrap, jQuery

    B. CUERPO HTML:
    4.  header : contenido del encabezado como navbar, alertas, errores, etc.
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
    {{-- <link rel="stylesheet" href="{{asset('build/css/customer_home.css')}}"> --}}
    <style>
        .navigation:hover {
            transform: scale(1.2);
            font-weight: 600;
            cursor: pointer;
        }
    </style>
@endsection

@section('dependencies')
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

@section('content')
    {{-- VENTANA EMERGENTE DE RESERVA --}}
    @include('customer.partial.reservation_popup')

    <div class="container" style="heigh: 100vh;">
        {{-- BARRA DE NAVEGACIÓN --}}
        @include('customer.partial.navbar')
        {{-- CONTENIDO --}}
        <div class="content pb-3" style="height: calc(100vh - 98px)">
            {{-- BARRA DE BÚSQUEDA --}}
            <div class="d-flex justify-content-center">
                <div class="p-3 w-50">
                    <form action="/customer/favorite/searchRestaurant" class="d-flex" role="search" method="POST">
                        @csrf
                        <input class="form-control" type="text" placeholder="Buscar" aria-label="Buscar" name="keyword">
                        <button class="btn border-0 navigation" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" ...>...</svg>
                        </button>
                    </form>
                </div>
            </div>

            {{-- CATÁLOGO --}}
            <div class="catalog">
                <div class="row m-0">
                    @forelse ($restaurants as $restaurant)
                        {{-- PLANTILLA DE TARJETA --}}
                        <div class="col-sm-6 col-lg-3 mb-3" style="position: relative;">

                            {{-- ETIQUETAS DEL RESTAURANTE --}}
                            <div class="event_container w-100" style="position: absolute;top:30px;">
                                @php
                                    // COMPROBAR SI ES NUEVO
                                    $created_at = substr($restaurant->created_at,8,2);
                                    $date_now = date("d");
                                    $diffrence = $date_now - $created_at;
                                @endphp

                                @if ($diffrence < 7)
                                    <div class="event_label text-light w-25 px-2 rounded-end" style="background-color: #06c700;">Nuevo</div>
                                @endif
                                @if(in_array($restaurant->id, $bestSellerRestaurantId))
                                    <div class="event_label text-light w-50 px-2 rounded-end" style="background-color: #6C4AB6;">Más Vendido</div>
                                @endif
                            </div>

                            {{-- CONTENIDO DE LA TARJETA --}}
                            <div class="restaurant_card bg-light p-3">
                                <div class="image_container" style="height: 11rem">
                                    <a class="text-dark p-0" style="text-decoration: none;" href="/customer/restaurant/{{$restaurant->full_name}}">
                                        <img class="navigation" src="{{asset("storage/images/restaurant/$restaurant->full_name/restaurant_1.jpg")}}" alt="" width="100%" height="100%">
                                    </a>
                                </div>

                                {{-- CALIFICACIÓN Y FAVORITOS --}}
                                <div class="row m-0">
                                    <div class="col-6 p-0 d-flex align-items-center">
                                        @for ($i=0;$i<floor($restaurant->average_rating);$i++)
                                            <img src="{{asset('storage/images/customer/search/star.png')}}" alt="" width="15%">
                                        @endfor
                                        <span class="ms-2">{{$restaurant->average_rating}}</span>
                                    </div>
                                    <div class="col-6 p-0 text-end">
                                        @if(in_array($restaurant->id, $likelistId))
                                            <a onclick="like_dislike({{$restaurant->id}},{{activeUser()->id}})">
                                                <img id="dislike_{{$restaurant->id}}" class="navigation" src="{{asset('storage/images/customer/search/fav_filled.png')}}" alt="" width="15%">
                                            </a>
                                        @else
                                            <a onclick="like_dislike({{$restaurant->id}},{{activeUser()->id}})">
                                                <img id="like_{{$restaurant->id}}" class="navigation" src="{{asset('storage/images/customer/search/fav.png')}}" alt="" width="15%">
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                {{-- INFORMACIÓN DEL RESTAURANTE --}}
                                <div class="restaurant_info overflow-auto mb-1" style="height: 4.5rem">
                                    <a class="text-dark p-0" style="text-decoration: none;" href="/customer/restaurant/{{$restaurant->full_name}}">
                                        <p class="m-0 mt-2" style="font-family: helvetica_regular">{{$restaurant->full_name}}</p>
                                    </a>
                                    <p class="m-0" style="font-family: helvetica_regular; font-size: 0.8em; color: rgb(111, 111, 111);">{{$restaurant->address}}</p>
                                    <p class="m-0" style="font-family: helvetica_regular; font-size: 0.8em; color: rgb(111, 111, 111);">Descripción: {{$restaurant->description}}</p>
                                </div>

                                {{-- HORARIO Y BOTÓN DE RESERVA --}}
                                <div class="d-flex w-100">
                                    <div class="px-3 rounded-pill bg-dark">
                                        <p class="m-0 text-light h-100 d-flex align-items-center" style="font-family: helvetica_regular;font-size: 0.8em">
                                            Abre a las {{$restaurant->start_time}}
                                            @if ($restaurant->start_time < 12)
                                                am
                                            @else
                                                pm
                                            @endif
                                        </p>
                                    </div>

                                    <a class="text-dark d-flex ms-auto" style="text-decoration: none">
                                        <button class="btn btn-outline-warning" onclick="open_popup({{$restaurant->id}})">Reservar</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="d-flex w-100 justify-content-center">
                            <p class="m-0">¡No tienes restaurantes favoritos!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_script')
<script>
    $(document).ready(function(){
        console.log('¡Bienvenido cliente!');
    });

    function open_popup(id){
        $(".popup_container").removeClass("d-none",function(){
            let restaurant_id = id;
            generatePopUpDetail(restaurant_id);
        });
    }

    function close_popup(){
        $(".popup_container").addClass("d-none");
        $(".blank").animate({height : '90vh'});
    }

    function generatePopUpDetail(restaurant_id){
        let map_generated = false;
        let form_generated = false;

        // MAPA (AJAX)
        $.ajax({
            type: "get",
            url: "/customer/generateMap",
            data: {
                'restaurant_id': restaurant_id
            },
            success: function(response) {
                $("#map_container").html(response);
                map_generated = true;
            },
        });

        // FORMULARIO (AJAX)
        $.ajax({
            type: "get",
            url: "/customer/generateForm",
            data: {
                'restaurant_id': restaurant_id
            },
            success: function(response) {
                $("#form_container").html(response);
                form_generated = true;
            },
        });

        // CONTROL DE TIEMPO DE CARGA
        let ctr = 0;
        let timer = setInterval(() => {
            if(map_generated && form_generated){
                $(".popup").css("height","90vh");
                $(".blank").animate({height : '0vh'},"slow");
                clearInterval(timer);
            } else if(ctr == 5){
                alert("¡Error del servidor!");
                clearInterval(timer);
            }
            ctr++;
        }, 1000);
    }

    // SELECCIÓN DE MESA Y HORA DISPONIBLE
    let last_selected_table = -1;
    let last_selected_time = -1;

    function tableClicked(tableId){
        if(last_selected_table > -1){
            $("#table_"+last_selected_table).css("backgroundColor","#6C4AB6");
        }
        $("#table_"+tableId).css("backgroundColor","#FEB139");
        $("#selected_table").val(tableId);
        last_selected_table = tableId;
    }

    function timeClicked(time){
        if(last_selected_time > -1){
            $("#time_"+last_selected_time).removeClass("btn-dark").addClass("btn-outline-dark");
        }
        $("#time_"+time).removeClass("btn-outline-dark").addClass("btn-dark");
        $("#selected_time").val(time);
        last_selected_time = time;
    }

    function like_dislike(restaurant_id,user_id){
        $.ajax({
            type: "get",
            url: "/customer/like_dislike",
            data: {
                'user_id': user_id,
                'restaurant_id': restaurant_id
            },
            success: function(response) {
                if(response == "1"){
                    $("#like_"+restaurant_id).prop("src","{{asset('storage/images/customer/search/fav_filled.png')}}");
                    $("#like_"+restaurant_id).prop("id","dislike_"+restaurant_id);
                } else {
                    $("#dislike_"+restaurant_id).prop("src","{{asset('storage/images/customer/search/fav.png')}}");
                    $("#dislike_"+restaurant_id).prop("id","like_"+restaurant_id);
                }
            },
        });
    }
</script>
@endsection

