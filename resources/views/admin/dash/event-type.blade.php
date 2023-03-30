@extends('adminlte::page')

@section('title', 'Dashboard')


@section('plugins.Datatables', true);
@section('plugins.Datatables', true);

@section('content_header')
    <h1>Tipos de eventos</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
        Añadir nuevo
    </button>
@stop

@section('content')

    <!-- Modal Editar -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tipo de Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="titulo" class="form-control" placeholder="Enter titulo" id="titulo" value="">
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="colorFondo">Color Fondo: </label>
                            <input type="name" class="form-control" placeholder="Color Fondo" id="colorFondo"
                                value="">
                        </div>
                        <div class="form-group col-4">
                            <label for="colorBorde">Color Borde</label>
                            <input type="name" class="form-control" placeholder="Color borde" id="colorBorde"
                                value="">
                        </div>
                        <div class="form-group col-4">
                            <label for="colorTexto">Color Texto</label>
                            <input type="name" class="form-control" placeholder="Color texto" id="colorTexto"
                                value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Guardar -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Tipo de Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="titulo" class="form-control" placeholder="Enter titulo" id="tituloNuevo">
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="colorFondo">Color Fondo: </label>
                            <input type="name" class="form-control" placeholder="Color Fondo" id="colorFondoNuevo">
                        </div>
                        <div class="form-group col-4">
                            <label for="colorBorde">Color Borde</label>
                            <input type="name" class="form-control" placeholder="Color borde" id="colorBordeNuevo">
                        </div>
                        <div class="form-group col-4">
                            <label for="colorTexto">Color Texto</label>
                            <input type="name" class="form-control" placeholder="Color texto" id="colorTextoNuevo">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarNuevo">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Tipos de eventos
        </div>
        <div class="card-body">


            <div class="card_body p-2">
                <table class="table table-striped " id="table">

                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Título</td>
                            <td>Color de Fondo</td>
                            <td>Color del Borde</td>
                            <td>Color del Texto</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eventTypes as $eventType)
                            <tr>

                                <td>{{ $eventType->id }}</td>
                                <td data="{{ $eventType->id }}" id="title-{{ $eventType->id }}">{{ $eventType->title }}
                                </td>
                                <td id="background_color-{{ $eventType->id }}">
                                    <div style="width: 15px;height: 15px;background: {{ $eventType->background_color }};">
                                    </div>
                                    <div>{{ $eventType->background_color }}</div>
                                </td>
                                <td id="border_color-{{ $eventType->id }}">
                                    <div style="width: 15px;height: 15px;background: {{ $eventType->border_color }};">
                                    </div>
                                    <div>{{ $eventType->border_color }}</div>
                                </td>
                                <td id="text_color-{{ $eventType->id }}">
                                    <div style="width: 15px;height: 15px;background: {{ $eventType->text_color }};"></div>
                                    <div>{{ $eventType->text_color }}</div>
                                </td>
                                <td id="action-{{ $eventType->id }}">
                                    <i class='fa-sharp fa-solid fa-pen-to-square' data="{{ $eventType->id }}"
                                        data-target='#exampleModal' data-toggle='modal' id='editUser'
                                        style='cursor: pointer;'></i>
                                    <i class='fa-sharp fa-solid fa-trash' data="{{ $eventType->id }}" id='destroyUser'
                                        style='cursor: pointer;'></i>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Color de Fondo</td>
                            <td>Color del Borde</td>
                            <td>Color del Texto</td>
                            <td>Acciones</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    {{-- Si comentamos la linea de abajo funciona el boton de logout usuario --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Traemos toekn de la sesión de usuario para las consultas a través de jquery
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Acción de editar
            let tiposEventos = @json($eventTypes); // La variable tiposEventos contiene todos los usuarios
            $('.fa-sharp.fa-solid.fa-pen-to-square').each(function() { // Recorremos cada icono
                //console.log("data: " + $(this).attr('data'));
                //   input = $(this).click(function() {
                let input = $(this);
                input.click(function() { // Añadimos evento
                    console.log("Acción Editar");
                    $.each(tiposEventos, function(i, item) {

                        if (tiposEventos[i].id == input.attr(
                                'data'
                            )) { // Hacemos comprobación de id y obtenemos datos del json
                            id = tiposEventos[i].id;
                            let title = tiposEventos[i].title;
                            let backgroundColor = tiposEventos[i].background_color;
                            let borderColor = tiposEventos[i].border_color;
                            let textColor = tiposEventos[i].text_color;

                            // Datos del usuario que se harán set en el input
                            console.log("id " + id);
                            console.log("title " + title);
                            console.log("Background Color " + backgroundColor);
                            console.log("Border Color " + borderColor);
                            console.log("text Color " + textColor);

                            // Set inputs of the form
                            $('#titulo').val(title);
                            $('#colorFondo').val(backgroundColor);
                            $('#colorBorde').val(borderColor);
                            $('#colorTexto').val(textColor);



                        }
                    });
                });
            });

            // Acción borrar Usuario
            $('.fa-sharp.fa-solid.fa-trash').each(function() { // Recorremos cada icono

                input = $(this);
                input.click(function() {
                    let id = $(this).attr('data');
                    console.log("Acción Borrar Tipo evento: id - " + id);

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "No podrás revertirlo.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Elimínalo!'
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.value) {
                            // Swal.fire('¡Eliminado!', '', 'success');
                            console.log("yes");
                            // Swal.fire(
                            // 'Deleted!',
                            // 'Your file has been deleted.',
                            // 'success'
                            // );

                            $.ajax({
                                url: "{{ route('eventtype.destroy', '') }}" + '/' +
                                    id, // Llamamos a la ruta para eliminar el usuario
                                type: "DELETE",
                                dataType: 'json',

                                success: function(
                                    response) { // Respuesta del controlador

                                    console.log(
                                        "Tipo de evento eliminado eliminado"
                                    );
                                    console.log(
                                        "Id del tipo de evento eliminado: " +
                                        response);
                                    $('#title-' + response).parent().remove();

                                },
                                error: function(error) {

                                    console.log(error);
                                }
                            });
                        } else if (result.isDenied) {
                            Swal.fire('El tipo de evento no será eliminado', '', 'info');

                        }
                    });
                });

            });


            // Acción de Guardar
            $('#btnGuardar').click(function() {
                // Obtemos los datos del modal

                let title = $('#titulo').val();
                let backgroundColor = $('#colorFondo').val();
                let borderColor = $('#colorBorde').val();
                let textColor = $('#colorTexto').val();

                console.log("btnGuardar: id " + id);
                console.log("btnGuardar: titulo " + title);
                console.log("btnGuardar: color de fondo " + backgroundColor);
                console.log("btnGuardar: color de borde " + borderColor);
                console.log("btnGuardar: color de texto " + textColor);
                $.ajax({

                    url: "{{ route('eventtype.update', '') }}" + '/' +
                        id, // Llamamos a la ruta para actualizar el tipo de evento
                    type: "PATCH",
                    dataType: 'json',
                    data: {
                        // title,
                        title,
                        backgroundColor,
                        borderColor,
                        textColor,
                    },
                    success: function(response) { // Respuesta del controlador

                        console.log("------------------------------");
                        hey = response;
                        console.log(response);
                        console.log("Id Respuesta: " + response.id);
                        console.log("Titulo Respuesta: " + response.title);
                        console.log("BackgroundColor Respuesta " + response.background_color);
                        console.log("BorderColor Respuesta " + response.border_color);
                        console.log("TextColor Respuesta " + response.text_color);

                        $("#title-" + id).text(response.title);

                        $('#background_color-' + id + ' div').first().css("background", response
                            .background_color);
                        $('#background_color-' + id + ' div').last().html(response
                            .background_color);

                        $('#border_color-' + id + ' div').first().css("background", response
                            .border_color);
                        $('#border_color-' + id + ' div').last().html(response.border_color);

                        $('#text_color-' + id + ' div').first().css("background", response
                            .text_color);
                        $('#text_color-' + id + ' div').last().html(response.text_color);

                    },
                    error: function(error) {

                        console.log(error);
                    }
                });
            });

            // Accion nuevo usuario
            $('#btnGuardarNuevo').click(function() {

                let titulo = $('#tituloNuevo').val();
                let colorFondoNuevo = $('#colorFondoNuevo').val();
                let colorBordeNuevo = $('#colorBordeNuevo').val();
                let colorTextoNuevo = $('#colorTextoNuevo').val();

                console.log("Guardar Tipo evento");
                console.log("titulo: " + titulo);
                console.log("Color de Fondo: " + colorFondoNuevo);
                console.log("Color de Borde: " + colorBordeNuevo);
                console.log("Color de texto: " + colorTextoNuevo);

                $.ajax({
                    url: "{{ route('eventtype.store') }}", // Llamamos a la ruta para agregar el usuario
                    type: "POST",
                    dataType: 'json',
                    data: {
                        titulo,
                        colorFondoNuevo,
                        colorBordeNuevo,
                        colorTextoNuevo
                    },
                    success: function(response) { // Respuesta del controlador

                        console.log("Tipo de evento añadido");
                        console.log("Id del tipo de evento añadido: " +
                            response);

                        // $('tbody').append('<tr><td>id</td><td id="title-'+response.id+'">'+response.title+'</td><td id="background_color-'+response.background_color+'">'+response.email+'</td><td id="user_statu-'+response.id+'">'+(response.user_statu == 0 ? "Inactivo" : "Activo") +'</td><td id="role-'+response.id+'">rol</td><td>'+response.action+'</td></tr>');


                        $('tbody').append('<tr><td> ' + response.id + '</td><td data="' +
                            response.id + '" id="title-' + response.id + '">' + response
                            .title + '</td><td id="background_color-' + response.id +
                            '"><div style="width: 15px;height: 15px;background: ' + response
                            .background_color + ';"></div><div>' + response
                            .background_color + '</div></td><td id="border_color-' +
                            response.id +
                            '"><div style="width: 15px;height: 15px;background:' + response
                            .border_color + ';"></div><div>' + response.border_color +
                            '</div></td><td id="text_color-' + response.id +
                            '"><div style="width: 15px;height: 15px;background:' + response
                            .text_color + ';"></div><div>' + response.text_color +
                            '</div></td><td id="action-' + response.id +
                            '"><i class="fa-sharp fa-solid fa-pen-to-square" data="' +
                            response.id +
                            '" data-target="#exampleModal" data-toggle="modal" id="editUser" style="cursor: pointer;"></i><i class="fa-sharp fa-solid fa-trash" data=" response.id" id="destroyUser" style="cursor: pointer;"></i></td></tr>'
                            );
                    },
                    error: function(error) {

                        console.log(error);
                    }
                });




            })
        });
    </script>

@stop
