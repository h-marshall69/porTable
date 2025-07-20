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
            <h1>Analytics Dashboard</h1>
        </div>
        <!-- Aquí tu contenido -->
    </div>
@endsection
