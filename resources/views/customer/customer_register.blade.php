{{--
    RENDERS DE LAYOUT:

    A. HTML HEAD:
    1.  pagename: nombre de esta página (no hace falta decirlo)
    2.  custom_css: si se necesita importar CSS personalizado
    3.  dependencies: si se necesitan importar dependencias específicas para esta página, ej. bootstrap, jquery

    B. HTML BODY:
    4.  header: para contenido del encabezado como navbar, alertas, errores, etc.
    5.  content: contenido principal de esta página
    6.  footer

    C. FUERA DEL HTML BODY:
    7.  js_script

--}}

@extends('layouts.layout')

@section('pagename')
    Portable
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{asset('build/css/customer_home.css')}}">
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
@include("partial.flashMessage")
<div class="container">
        {{-- BARRA DE NAVEGACIÓN --}}
        @include('customer.partial.navbar')
        {{-- FORMULARIO --}}
        <div class="row m-0">
            <div class="col-sm-12 col-lg-8 bg-dark text-light px-4 py-3 overflow-auto" style="height: calc(100vh - 80px)">
                <div class="head mb-2">
                        <h3 style="font-family: helvetica_bold;">Términos y Condiciones</h3>
                        <p class="m-0 text-secondary">
                            Qué cubren estos términos: Sabemos que es tentador saltarse estos Términos de Servicio, pero es importante establecer qué puedes esperar de nosotros al usar los servicios de PorTable, y qué esperamos nosotros de ti.
                        </p>
                </div>

                <div class="subsection mb-2">
                    <h4>(1) Sobre estos términos</h4>
                    <p style="font-size: 0.9em">
                        Por ley, tienes ciertos derechos que no pueden ser limitados por un contrato como estos términos de servicio. Estos términos no pretenden restringir esos derechos.
                        Estos términos describen la relación entre tú y Google. No crean derechos legales para otras personas u organizaciones, incluso si otros se benefician de esa relación bajo estos términos.
                        Queremos que estos términos sean fáciles de entender, por eso hemos usado ejemplos de nuestros servicios. Pero no todos los servicios mencionados pueden estar disponibles en tu país.
                        Si estos términos entran en conflicto con términos adicionales específicos de un servicio, prevalecerán los términos adicionales para ese servicio.
                        Si se determina que un término en particular no es válido o ejecutable, esto no afectará a los demás términos.
                        Si no cumples con estos términos o los términos adicionales específicos del servicio, y no tomamos medidas de inmediato, no significa que renunciamos a ningún derecho, como tomar medidas más adelante.
                        Podemos actualizar estos términos y los términos adicionales específicos del servicio (1) para reflejar cambios en nuestros servicios o cómo hacemos negocios (por ejemplo, cuando agregamos nuevos servicios, características, tecnologías, precios o beneficios, o eliminamos otros), (2) por razones legales, reglamentarias o de seguridad, o (3) para prevenir abusos o daños.
                        Si realizamos cambios materiales en estos términos o en los términos adicionales, te avisaremos con antelación razonable y te daremos la oportunidad de revisarlos, excepto (1) cuando lancemos un nuevo servicio o función, o (2) en situaciones urgentes, como prevenir abusos o cumplir con requisitos legales. Si no estás de acuerdo con los nuevos términos, deberías eliminar tu contenido y dejar de usar los servicios. También puedes terminar tu relación con nosotros en cualquier momento cerrando tu cuenta de Google.
                    </p>
                </div>
                <div class="subsection mb-2">
                    <h4>(2) Solo para usuarios empresariales y organizaciones</h4>
                    <p style="font-size: 0.9em">
                        En la medida permitida por la ley aplicable, indemnizarás a Google y sus directores, empleados y contratistas por cualquier procedimiento legal de terceros (incluidas acciones de autoridades gubernamentales) derivadas de tu uso ilegal de los servicios o violación de estos términos o términos adicionales. Esta indemnización cubre cualquier responsabilidad o gasto derivado de reclamaciones, pérdidas, daños, sentencias, multas, costos de litigio y honorarios legales.
                        Si estás legalmente exento de ciertas responsabilidades, incluida la indemnización, entonces estas no se aplican a ti bajo estos términos. Por ejemplo, las Naciones Unidas gozan de ciertas inmunidades legales y estos términos no anulan esas inmunidades.
                        Google no será responsable por:
                        - pérdida de beneficios, ingresos, oportunidades comerciales, fondo de comercio o ahorros anticipados
                        - pérdida indirecta o consecuente
                        - daños punitivos
                        La responsabilidad total de Google derivada de estos términos se limita a lo mayor entre (1) US$500 o (2) 125% de las tarifas que hayas pagado por los servicios relevantes en los 12 meses anteriores a la infracción.

                        Tomar acción en caso de problemas
                        Antes de actuar según se describe más abajo, te daremos un aviso previo razonable, describiremos la razón de la acción y te daremos la oportunidad de solucionar el problema, a menos que razonablemente creamos que hacerlo:
                        - causaría daño o responsabilidad a un usuario, tercero o Google
                        - violaría la ley o una orden de una autoridad legal
                        - comprometería una investigación
                        - comprometería la operación, integridad o seguridad de nuestros servicios

                        Eliminación de tu contenido
                        Si razonablemente creemos que tu contenido (1) infringe estos términos, términos adicionales o políticas, (2) viola la ley aplicable, o (3) podría dañar a nuestros usuarios, terceros o a Google, entonces nos reservamos el derecho de eliminar parte o todo ese contenido conforme a la ley. Ejemplos incluyen pornografía infantil, contenido que facilita trata de personas o acoso, contenido terrorista, e infracciones a derechos de propiedad intelectual.
                    </p>
                </div>
                <div class="subsection mb-2">
                    <h4>(3) Contenido en PorTable</h4>
                    <p style="font-size: 0.9em">
                        Tu contenido
                        Algunos de nuestros servicios te permiten hacer público tu contenido, por ejemplo, podrías publicar una reseña de un producto o restaurante que escribiste, o subir una entrada de blog que creaste.
                        Consulta la sección Permiso para usar tu contenido para más información sobre tus derechos y cómo se usa tu contenido.
                        Consulta la sección Eliminación de tu contenido para saber por qué y cómo podríamos eliminar contenido generado por el usuario.
                        Si crees que alguien está infringiendo tus derechos de propiedad intelectual, puedes enviarnos un aviso de infracción y tomaremos las medidas adecuadas. Por ejemplo, suspendemos o cerramos las cuentas de Google de infractores reincidentes, como se describe en nuestro Centro de ayuda de derechos de autor.
                    </p>
                </div>
                {{-- ACEPTACIÓN --}}
                <hr>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="toggleCheckbox()">
                    <label class="form-check-label" for="exampleCheck1">He leído y acepto los Términos y Condiciones de PorTable</label>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 px-4 py-3 overflow-auto" style="height: calc(100vh - 80px)">
                <div class="text-center">
                    <h3 style="font-family: helvetica_bold;">Detalles del Restaurante</h3>
                </div>
                {{-- FORMULARIO --}}
                <form action="/customer/register_restaurant/do_register" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- NOMBRE --}}
                    <div class="mb-3">
                        <label class="form-label">Nombre del restaurante</label>
                        <input type="text" class="form-control" placeholder="Escribe el nombre completo de tu restaurante..." name="full_name" value="{{old('full_name')}}">

                        @error('full_name')
                            @include('partial.validationMessage')
                        @enderror
                    </div>
                    {{-- TELÉFONO Y DIRECCIÓN --}}
                    <div class="row m-0">
                        <div class="col ps-0">
                            <div class="mb-3">
                                <label class="form-label">Dirección</label>
                                <input type="text" class="form-control" placeholder="Dirección del restaurante..." name="address" value="{{old('address')}}">

                                @error('address')
                                    @include('partial.validationMessage')
                                @enderror
                            </div>
                        </div>
                        <div class="col pe-0">
                            <div class="mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="text" class="form-control" placeholder="Número de teléfono..." name="phone" value="{{old('phone')}}">

                                @error('phone')
                                    @include('partial.validationMessage')
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- IMAGEN --}}
                    <div class="mb-2">
                        <label class="form-label">Sube fotos del restaurante (3 archivos jpg/png/jpeg):</label>
                        <input type="file" name="foto[]" class="form-control" multiple>
                        @error('foto')
                            @include('partial.validationMessage')
                        @enderror
                    </div>

                    {{-- DESCRIPCIÓN --}}
                    <div class="mb-2">Descripción</div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Escribe aquí una descripción" id="floatingTextarea2" style="height: 100px" name="description">{{old('description')}}</textarea>
                        <label for="floatingTextarea2">Descripción ej: Asiática, Parrilla, etc.</label>
                    </div>
                    {{-- HORARIO Y TURNOS --}}
                    <div class="row m-0 mt-2">
                        <div class="col ps-0">
                            <div class="mb-3">
                                <label class="form-label">Hora de apertura</label>
                                <input type="number" class="form-control" max="23" min="0" placeholder="Hora en que abre el restaurante..." name="open_at" value="{{old('open_at')}}">

                                @error('open_at')
                                    @include('partial.validationMessage')
                                @enderror
                            </div>
                        </div>
                        <div class="col pe-0">
                            <div class="mb-3">
                                <label class="form-label">Turnos</label>
                                <input type="number" class="form-control" placeholder="Cantidad de turnos con intervalos de 1 hora..." name="shift" value="{{old('shift')}}">

                                @error('shift')
                                    @include('partial.validationMessage')
                                @enderror
                            </div>
                        </div>
                    </div>

                    <input class="btn me-2 w-100 mt-2 disabled" id="submit" type="submit" style="background-color: #ed3b27;color:white;" value="Crear cuenta del restaurante">
                    <div class="text-secondary">* Por favor marca la casilla de He leído y acepto los Términos y Condiciones de PorTable</div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js_script')
    <script>
        $(document).ready(function(){
            console.log('¡Bienvenido Cliente!');
        });

        var agree = false;
        function toggleCheckbox(){
            if(!agree){
                $("#submit").removeClass("disabled");
            }else{
                $("#submit").addClass("disabled");
            }
            agree = !agree;
        }
    </script>
@endsection

