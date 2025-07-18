{{--
    SECCIONES DEL DISEÑO:

    A. CABECERA HTML:
    1.  pagename : nombre de esta página (ni que lo dijeras)
    2.  custom_css : si necesitas importar CSS personalizado hecho a mano
    3.  dependencies : si necesitas importar dependencias específicas para esta página, como bootstrap, jquery

    B. CUERPO HTML:
    4.  header : para contenido del encabezado como navbar, alertas, errores, etc.
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
        .navigation:hover{
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
    <div class="container">
        {{-- BARRA DE NAVEGACIÓN --}}
        @include('customer.partial.navbar')
        {{-- CONTENIDO --}}
        <div class="content py-4" style="height: calc(100vh - 80px)">
            <div class="row m-0">
                {{-- CONTENIDO IZQUIERDO --}}
                <div class="col-sm-12 col-md-7">
                    <div class="mb-3">
                        <p class="m-0" style="font-size: 2.5em;font-weight: bold;">Historial</p>
                        <p class="m-0">Este es el comprobante o ticket de todas tus reservas</p>
                    </div>

                    {{-- NOTIFICACIONES --}}
                    @foreach ($history as $transaction)
                        @php
                            $restaurant_name = $transaction->reservation->restaurant->full_name;
                        @endphp
                        <div class="bg-light rounded-4 p-4 my-4">
                            {{-- PLANTILLA DE TARJETA --}}
                            <div class="row h-100">
                                <div class="col-sm-12 col-lg-4 d-flex">
                                    <img src="{{asset("storage/images/restaurant/$restaurant_name/restaurant_1.jpg")}}" alt="" width="100%">
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                    <div class="restaurant_info mb-2">
                                        <div class="row m-0">
                                            <div class="col p-0">
                                                <h4 class="m-0">{{$restaurant_name}}</h4>
                                            </div>
                                            <div class="col p-0 text-end">
                                                <p class="m-0">Reserva para: {{$transaction->reservation->reservation_date_time}}</p>
                                            </div>
                                        </div>
                                        <p class="m-0 text-secondary">{{$transaction->reservation->restaurant->description}}</p>
                                    </div>
                                    <div class="order_info">
                                        <p class="m-0">Número de mesa: {{$transaction->reservation->table->seats}}</p>
                                        <p class="m-0">Precio del pedido: Rp. {{ number_format($transaction->payment_amount, 0, ",", ".") }}</p>

                                        @php
                                            // Verifica si el cliente ha finalizado una transacción al crear la reserva. Si es así, puede hacer una reseña.
                                            $pastSuccessfulResevation = DB::table('reservations')->where('user_id', '=', $transaction->user_id)->where('restaurant_id', '=', $transaction->reservation->restaurant_id)->where('payment_status', 1)->first();

                                            if (isset($pastSuccessfulResevation)) {
                                                // Verifica si ya ha dejado una reseña antes...
                                                $pastReview = DB::table('reviews')->where('user_id', '=', $transaction->user_id)->where('restaurant_id', '=', $transaction->reservation->restaurant_id)->first();

                                                if (isset($pastReview)) {
                                                    @endphp
                                                    <a href="/customer/restaurant/{{$restaurant_name}}#reviews"><button class="btn text-light" style="background-color: #6C4AB6;">Ver Reseñas</button></a>
                                                    @php
                                                }
                                            }
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- CONTENIDO DERECHO --}}
                <div class="col-sm-12 col-md-5">
                    <div class="mb-3">
                        <p class="m-0" style="font-size: 2.5em;font-weight: bold;">Transacción Activa</p>
                        <p class="m-0">Este es el comprobante o ticket de tu última reserva de mesa</p>
                    </div>
                    <div id="reservation_container" class="reservation_container d-flex" style="overflow-x: auto">
                        @forelse ($activeReservations as $reservation)
                            <div class="ticket">
                                <div class="mb-3 me-2" style="position: relative;width: 400px">
                                    <a class="text-dark p-0" style="text-decoration: none;" href="/customer/restaurant/{{$reservation->restaurant->full_name}}">
                                        {{-- EVENTO DEL RESTAURANTE --}}
                                        <div class="number_container" style="position: absolute;top:30px;right:5%;">
                                            <div class="event_label text-light p-3 rounded-3 text-center navigation" style="background-color: #6C4AB6;">{{$reservation->table->seats}}</div>
                                            <div class="cancel_container">
                                                {{-- BOTÓN CANCELAR --}}
                                                <a id="opencancel_{{$reservation->id}}" onclick="opencancel({{$reservation->id}})">
                                                    <button class="btn event_label text-light p-1 rounded-3 text-center navigation" style="background-color: #ed3b27;">Cancelar</button>
                                                </a>
                                                {{-- CONFIRMACIÓN --}}
                                                <div id="cancelconfirmation_{{$reservation->id}}" class="cancel_confirmation bg-light p-2 rounded-3 d-none">
                                                    <p class="m-0">¿Cancelar?</p>
                                                    <a onclick="cancel_reservation({{$reservation->id}})">
                                                        <button class="btn event_label text-light p-1 rounded-3 text-center navigation" style="background-color: #06c700;">Sí</button>
                                                    </a>
                                                    <a onclick="closecancel({{$reservation->id}})">
                                                        <button class="btn btn-dark m-0 event_label text-light p-1 rounded-3 text-center navigation">No</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- CONTENIDO DE LA TARJETA --}}
                                        <div class="restaurant_card bg-light p-3">
                                            <div class="image_container" style="height: 15rem">
                                                @php
                                                    $activeReservation_restaurant = $reservation->restaurant->full_name;
                                                @endphp
                                                <img src="{{asset("storage/images/restaurant/$activeReservation_restaurant/restaurant_1.jpg")}}" alt="" width="100%" height="100%">
                                            </div>

                                            {{-- INFORMACIÓN DEL RESTAURANTE --}}
                                            <div class="row m-0 mt-2 overflow-auto" style="height: 6rem">
                                                <div class="col-10">
                                                    <div class="restaurant_info">
                                                        <p class="m-0" style="font-family: helvetica_bold;font-size: 1.5em">{{$reservation->restaurant->full_name}}</p>
                                                        <p class="m-0" style="font-family: helvetica_regular;font-size: 0.8em;color: rgb(111, 111, 111);">{{$reservation->restaurant->description}}</p>
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
                                                    <p class="m-0" style="font-family: helvetica_regular;">Precio del pedido: Rp {{$reservation->restaurant->price}}</p>
                                                    <p class="m-0" style="font-family: helvetica_regular;">
                                                        Fecha de la reserva: {{$reservation->reservation_date_time}}
                                                        @if (substr($reservation->reservation_date_time,11,2) < 12)
                                                            am
                                                        @else
                                                            pm
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="d-flex w-100 justify-content-start">
                                <p class="m-0">No tienes ninguna transacción activa en este momento</p>
                            </div>
                        @endforelse
                    </div>
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
        function opencancel(reservation_id){
            $("#opencancel_"+reservation_id).addClass("d-none");
            $("#cancelconfirmation_"+reservation_id).removeClass("d-none");
        }
        function closecancel(reservation_id){
            $("#cancelconfirmation_"+reservation_id).addClass("d-none");
            $("#opencancel_"+reservation_id).removeClass("d-none");
        }
        function cancel_reservation(reservation_id){
            // PETICIÓN AJAX PARA TRANSACCIÓN ACTIVA
            $.ajax({
                type: "get",
                url: "/customer/cancelTransaction",
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

