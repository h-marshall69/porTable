{{--
    RENDERS DEL LAYOUT :

    A. HTML HEAD :
    1.  pagename : nombre de esta página (obviamente)
    2.  custom_css : si necesitas importar CSS personalizado
    3.  dependencies : si necesitas importar dependencias específicas para esta página, como Bootstrap, jQuery

    B. HTML BODY :
    4.  header : para contenido del encabezado como la barra de navegación, alertas, errores, etc.
    5.  content : contenido principal de esta página
    6.  footer

    C. FUERA DEL BODY HTML :
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
            {{-- BARRA DE BÚSQUEDA, NOTIFICACIONES, PERFIL --}}
            <div class="row m-0 ">
                <div class="col">
                    <h3 class="m-0 p-0">Restaurantes</h3>
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

            {{-- RESUMEN --}}
            <div class="row m-0 p-0 mt-3">
                <div class="col-sm-12 col-lg-8">
                    <div class="row m-0 p-0">
                        <div class="col">
                            <div class="overview_1 p-4 mb-3 mb-lg-0">
                                <div class="d-flex align-items-center">
                                    <img class="bg-light rounded-3 p-2 me-3" src="{{asset("storage/images/admin/order.png")}}" alt="" width="60px">
                                    <div class="">
                                        <p class="m-0">Total</p>
                                        <p class="m-0 overview_sub">{{date("F")}} {{date("jS")}}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end w-100">
                                    <h1 class="font-weight-bold">{{$countRestaurant}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="overview_2 p-4 mb-3 mb-lg-0">
                                <div class="d-flex align-items-center">
                                    <img class="bg-light rounded-3 p-2 me-3" src="{{asset("storage/images/admin/order.png")}}" alt="" width="60px">
                                    <div class="">
                                        <p class="m-0">En línea</p>
                                        <p class="m-0 overview_sub">{{date("F")}} {{date("jS")}}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end w-100">
                                    <h1 class="font-weight-bold">929</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="overview_3 p-4 mb-3 mb-lg-0">
                                <div class="d-flex align-items-center">
                                    <img class="bg-light rounded-3 p-2 me-3" src="{{asset("storage/images/admin/order.png")}}" alt="" width="60px">
                                    <div class="">
                                        <p class="m-0">Fuera de línea</p>
                                        <p class="m-0 overview_sub">{{date("F")}} {{date("jS")}}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end w-100">
                                    <h1 class="font-weight-bold">1231</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end align-items-center">
                            <div class="searchBar w-100">
                                <form action="/admin/restaurant/search" class="d-flex" role="search" method="POST">
                                    @csrf
                                    <input class="form-control" type="text" placeholder="Buscar" aria-label="Search" name="keyword">
                                    <button class="btn border-0" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="rounded-3 bg-dark text-light p-4 d-flex align-items-center">
                                <p class="m-0">Filtro actual : <span>{{$keyword}}</span></p>
                                <div class="btn btn-outline-warning ms-auto">
                                    <a style="text-decoration:none; color:white;" href="{{url('/admin/customer')}}">Limpiar filtro</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- FILTROS / NAVTABS --}}
            <div class="mt-4 d-flex px-3">
                <div class="btn btn-dark me-2">Todos</div>
                <div class="btn btn-outline-dark me-2">En línea</div>
                <div class="btn btn-outline-dark me-2">Fuera de línea</div>
                <div class="btn btn-outline-dark me-2">Pendiente</div>
            </div>

            {{-- LISTA DE RESTAURANTES --}}
            <div class="row m-0 p-0">
                <div class="col overflow-auto">
                    <table class="table table-striped mt-3 text-center">
                        <thead class="bg-dark text-light">
                            <th>No.</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Última actividad</th>
                            <th>7D</th>
                            <th>30D</th>
                            <th>Hoy</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($allRestaurant as $key=>$restaurant)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$restaurant->full_name}}</td>
                                    <td>{{$restaurant->address}}</td>
                                    <td>27/11/2022</td>
                                    <td>Rp. {{$tempLastWeek[$key]}},00</td>
                                    <td>Rp. {{$tempLastMonth[$key]}},00</td>
                                    <td>Rp. {{$tempToday[$key]}},00</td>
                                    <td>
                                        @if ($restaurant->trashed())
                                            <a href="{{url("admin/restaurant/banRestaurant/$restaurant->id")}}" class="btn btn-success">Desbanear</a>
                                        @else
                                            <a href="{{url("admin/restaurant/banRestaurant/$restaurant->id")}}" class="btn btn-danger">Banear</a>
                                        @endif
                                        <div class="btn btn-success">
                                            Detalle
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js_script')
    <script>
        $(document).ready(function(){
            console.log('¡Bienvenido, Admin!');
        });
    </script>
@endsection

