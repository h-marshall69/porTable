{{--
    LAYOUT YIELDS :

    A. HTML HEAD :
    1.  pagename : nama halaman ini (you dont say)
    2.  custom_css : jika butuh import custom css yang dibuat sendiri
    3.  dependencies : jika butuh import dependencies khusus page ini cth bootstrap, jquery

    B. HTML BODY :
    4.  header : untuk konten" header cth navbar, alert, error dsb
    5.  content : konten" utama halaman ini
    6.  footer

    C. OUTSIDE HTML BODY :
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

        .banner{
            height: 60vh;
        }
        .banner_text .title{
            font-size: 3.5em;
        }
        .banner_text .subtitle{
        }
        @media (max-width: 1025px){
            .banner{
                height: 100%;
            }
            .banner_text .title{
                font-size: 3em;
            }
        }
        @media (max-width: 481px){
            .banner{
                height: 100%;
            }
            .banner_text .title{
                font-size: 2.5em;
            }
        }

    </style>
@endsection

@section('dependencies')
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

@section("header")
    @include('partial.flashMessage')
@endsection

@section('content')
    <div class="container">
        {{-- NAVBAR --}}
        @include('customer.partial.navbar')
        {{-- JUMBOTRON --}}
        <div class="jumbotron banner row m-0 w-100">
            <div class="col-md-12 col-lg-6 d-flex justify-content-end align-items-center d-lg-none ">
                <img src="{{asset('storage/images/customer/banner1.png')}}" width="100%" alt="">
            </div>
            <div class="col-md-12 col-lg-6 d-flex justify-content-end align-items-center" >
                <div class="left_content">

                    {{-- BANNER TEXT --}}
                    <div class="banner_text">
                        <p class="title text-end" style="font-family: helvetica_bold">Una nueva forma</p>
                        <p class="title text-end" style="font-family: helvetica_bold;margin-top:-20px;">De reservar una mesa</p>
                        <p class="subtitle text-end" style="font-family: helvetica_regular;"> Vive la mejor experiencia culinaria en el corazón de Puno. Platos únicos, atención personalizada y un ambiente inigualable.</p>
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{route('customer_search')}}">
                            <div class="btn me-2" style="background-color: #ed3b27;color:white;">Explorar Restaurante</div>
                        </a>
                        <a href="{{route('customer_favorite')}}">
                            <div class="btn" style="border:1px solid #ed3b27; color: #ed3b27;">Favoritos</div>
                        </a>
                    </div>


                </div>
            </div>
            <div class="col-md-12 col-lg-6 d-flex justify-content-end align-items-center d-none d-lg-flex">
                <img src="{{asset('storage/images/customer/banner1.png')}}" width="100%" alt="">
            </div>
        </div>
        {{-- EASY ACCESS --}}
        <div class="easy-access mt-3 px-5 py-4 rounded-3 bg-dark">
            <h3 class="text-light" style="font-family: helvetica_bold">Reservar Mesa</h3>

            <form class="mt-3" method="POST" action="/customer/checkAvailability">
                @csrf
                <div class="row m-0">
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <div class="mb-3">
                            <input type="text" class="form-control p-3" id="restaurant_name" name="restaurant_name" placeholder="Nombre del Restaurante">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <div class="mb-3">
                            <input type="text" class="form-control p-3" id="restaurant_description" name="restaurant_desc" placeholder="Ej. Peruana, Parrilla, etc.">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <div class="mb-3">
                            <input type="time" class="form-control p-3" id="reservation_time" name="reservation_time">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <button type="submit" class="btn text-light w-100 p-3" style="background-color: #ed3b27">Disponibilidad</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- PARALAX --}}
        <div class="paralax mt-5">
            <div class="row m-0">
                <div class="col-sm-12 col-md-6 col-lg-3 text-center rounded-4 p-4" >
                    <img src="{{asset('storage/images/customer/home/order.jpg')}}" alt="">
                    <h3>Order</h3>
                    <p class="my-2">Realiza tu pedido en línea de forma rápida y sencilla, desde cualquier dispositivo.</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 text-center rounded-4 p-4">
                    <img src="{{asset('storage/images/customer/home/ticket.png')}}" alt="">
                    <h3>Ticket</h3>
                    <p class="my-2">Recibe tu confirmación de reserva o pedido directamente a tu correo.</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 text-center rounded-4 p-4">
                    <img src="{{asset('storage/images/customer/home/meet.png')}}" alt="">
                    <h3>Confirm</h3>
                    <p class="my-2">Confirma tu asistencia o modifica tu pedido con total flexibilidad.</p>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3 text-center rounded-4 p-4">
                    <img src="{{asset('storage/images/customer/home/dine.png')}}" alt="">
                    <h3>Dine</h3>
                    <p class="my-2">Disfruta de una experiencia gastronómica inolvidable en nuestro restaurante.</p>
                </div>
            </div>
        </div>
        {{-- JUMBOTRON --}}
        <div class="jumbotron banner row m-0 w-100 mb-5">
            <div class="col-md-12 col-lg-6 d-flex justify-content-end align-items-center">
                <img src="{{asset('storage/images/customer/banner2.png')}}" width="100%" alt="">
            </div>
            <div class="col-md-12 col-lg-6 d-flex justify-content-end align-items-center" >
                <div class="right_content">

                    {{-- BANNER TEXT --}}
                    <div class="banner_text">
                        <p class="title text-start " style="font-family: helvetica_bold">¿Eres dueño de un restaurante?</p>
                        <p class="title text-start " style="font-family: helvetica_bold;margin-top:-20px;">¡Abre tus reservas ahora!</p>
                        <p class="subtitle text-start " style="font-family: helvetica_regular;">Registra tu restaurante y comienza a recibir reservas online de forma automatizada y eficiente.</p>
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-start mt-4">
                        <a href="/customer/register_restaurant" style="text-decoration: none">
                            <div class="btn me-2" style="background-color: #ed3b27;color:white;">Crear cuenta de restaurante</div>
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="about_us bg-dark text-light">
        <div class="container">
            <div class="py-5">
                <div class="row m-0">
                    <div class="col">
                        <p class="m-0" style="font-size: 1.5em;font-family: helvetica_regular;">Contactos</p>
                        <p class="mt-3" style="color: rgb(200, 200, 200);">
                            Address : <br>
                            Jl. Ngagel Jaya Tengah No.73-77, Baratajaya, Kec. Gubeng, Kota SBY, Jawa Timur 60284
                            <br><br>
                            Phone : <br>
                            ISTTS - 082122907788 <br>
                            Albertus Marco - 0817305455 <br>
                            Andrew Anderson - 081298771483 <br>
                            Antonio Christopher - 085755115331 <br>
                            Ian William - 089674436016 <br>

                        </p>
                    </div>
                    <div class="col">
                        <p class="m-0" style="font-size: 1.5em;font-family: helvetica_regular;">Menu</p>
                        <div class="mt-3">
                            <p><span class="navigation">Inicio</span> </p>
                            <p><span class="navigation">Buscar</span> </p>
                            <p><span class="navigation">Favoritos</span> </p>
                            <p><span class="navigation">Historial</span> </p>
                            <p><span class="navigation">Perfil</span> </p>

                        </div>
                    </div>
                    <div class="col-6 d-none d-md-block">
                        <p class="m-0" style="font-size: 1.5em;font-family: helvetica_regular;">Reseñas</p>
                        <form class="mt-3" action="">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control p-3" placeholder="Deja tu opinión sobre nuestro servicio :)">
                                <button type="submit" class="btn text-light p-3" style="background-color: #ed3b27">Enviar Reseña</button>
                            </div>
                        </form>

                        <p class="my-1" style="color: rgb(200, 200, 200);">
                            ¿Quieres conocer más sobre nuestros desarrolladores? <a href="">¡Haz clic aquí!</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="copyright text-center">
                <p class="m-0 py-3" style="color: rgb(200, 200, 200);">
                    &copy; 2022. Institut Sains dan Teknologi Terpadu Surabaya
                </p>
            </div>
        </div>
    </div>
@endsection

@section('js_script')

    <script>
        $(document).ready(function(){
            console.log('Welcome Customer!');

        });
    </script>
@endsection
