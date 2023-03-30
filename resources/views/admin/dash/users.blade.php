@extends('adminlte::page')

@section('title', 'Usuarios')

@section('plugins.FullCalendar', true);
@section('plugins.Datatables', true);
@section('plugins.Sweetalert2', true);

@section('content_header')
    <h1>Usuarios</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Añadir nuevo</button>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="name" class="form-control" placeholder="Enter name" id="name" value="">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="Enter email" id="email" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Activo/Inativo</label>
                        <select class="form-control" id="activo">
                            <option value="0">Inactivo</option>
                            <option value="1">Activo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Rol</label>
                        <select class="form-control" id="rol">
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- RegisterModal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nameNew" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="emailNew" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="passwordNew"
                                class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="passwordNew" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarNuevo">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card_body p-2">
            <table class="table table-striped " id="table">

                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Correo</td>
                        <td>Activo/Inactivo</td>
                        <td>Rol</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td id="name-{{ $user->id }}">{{ $user->name }}</td>
                            <td id="email-{{ $user->id }}">{{ $user->email }}</td>
                            <td id="user_statu-{{ $user->id }}">
                                @if ($user->user_statu == 0)
                                    Inactivo
                                @else
                                    Activo
                                @endif
                            </td>
                            <td id="role-{{ $user->id }}">{{ $user->role }}</td>
                            <td>
                                {!! $user->action !!}
                                {{-- <i class='fa-sharp fa-solid fa-pen-to-square' data={{ $user->id }}
                                    data-target='#exampleModal' data-toggle='modal' id='editUser'></i>
                                <a href='/admin/users/destroy/{{ $user->id }}'><i
                                        class='fa-sharp fa-solid fa-trash'></i></a> --}}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Correo</td>
                        <td>Activo/Inactivo</td>
                        <td>Rol</td>
                        <td>Acciones</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>
    {{-- <script src="https://cdnjs.com/libraries/bootstrap-modal"></script> --}}

    <script>
        // Traemos toekn de la sesión de usuario para las consultas a través de jquery
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true,
                autoWidth: false,
                // Traemos los datos por ajax para mejorar el rendimiento
                // 'ajax': '{{ route('user.datatable') }}', 
                // "columns": [{
                //         data: 'id'
                //     },
                //     {
                //         data: 'name'
                //     },
                //     {
                //         data: 'email'
                //     },
                //     {
                //         data: 'role'
                //     },
                //     {
                //         data: 'user_statu'
                //     },
                //     {
                //         data: 'action'
                //     },
                // ]
            });
        });
        $(document).ready(function() {
            let users = @json($users); // La variable users contiene todos los usuarios
            // console.log($('.fa-sharp.fa-solid.fa-pen-to-square'));
            // Acción de editar
            $('.fa-sharp.fa-solid.fa-pen-to-square').each(function() { // Recorremos cada icono
                //console.log("data: " + $(this).attr('data'));
                //   input = $(this).click(function() {
                let input = $(this);
                input.click(function() { // Añadimos evento
                    console.log("Acción Editar");
                    $.each(users, function(i, item) {

                        if (users[i].id == input.attr(
                                'data'
                            )) { // Hacemos comprobación de id y obtenemos datos del json
                            id = users[i].id;
                            name = users[i].name;
                            role = users[i].role;
                            user_statu = users[i].user_statu;

                            // Datos del usuario que se harán set en el input
                            console.log("id " + id);
                            console.log("name " + name);
                            console.log("role " + role);
                            console.log("estado " + user_statu);

                            // Set inputs of the form
                            $('#name').val(name);
                            $('#email').val(users[i].email);

                            console.log("comprobacion set input rol usuario");
                            $("#rol > option").each(function() {
                                if (this.value == role) {
                                    // this.selected = true;
                                    $(this).attr('selected', 'selected');
                                    console.log("Rol verdadero - set input");
                                };
                            });

                            console.log("comprobacion set input estado usuario");
                            $("#activo > option").each(function() {
                                console.log("valor option: " + this.value);
                                if (this.value == user_statu) {
                                    $(this).attr('selected', 'selected');
                                    console.log("Estado verdadero - set input");
                                };
                            });

                        }
                    });
                });
            });

            // Acción de Actualizar
            $('#btnGuardar').click(function() {
                // Obtemos los datos del modal
                name = $('#name').val();
                role = $('#rol option:selected').val();
                user_statu = $('#activo option:selected').val();
                console.log("btnGuardar: " + name);
                console.log("btnGuardar: " + user_statu);
                console.log("btnGuardar: " + role);
                $.ajax({

                    url: "{{ route('user.update', '') }}" + '/' +
                        id, // Llamamos a la ruta para actualizar el usuario
                    type: "PATCH",
                    dataType: 'json',
                    data: {
                        // title,
                        name,
                        role,
                        user_statu
                        // id_event_type
                    },
                    success: function(response) { // Respuesta del controlador

                        console.log("------------------------------");
                        console.log("Id Respuesta: " + response.id);
                        console.log("Nombre Respuesta: " + response.name);
                        console.log("Estado Respuesta " + response.user_statu);
                        console.log("Rol Respuesta: " + response.role);

                        // // window.location.reload();
                        $("#name-" + id).text(response.name);
                        $("#role-" + id).text(response.role);
                        ker = response.user_statu == 0 ? "Inactivo" : "Activo";
                        $("#user_statu-" + id).text(response.user_statu == 0 ? "Inactivo" :
                            "Activo");

                    },
                    error: function(error) {

                        console.log(error);
                    }
                });
            });

            // Acción borrar Usuario
            $('.fa-sharp.fa-solid.fa-trash').each(function() { // Recorremos cada icono

                input = $(this);
                input.click(function() {
                    let id = $(this).attr('data');
                    console.log("Acción Borrar usuario: id - " + id);

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
                                url: "{{ route('user.destroy', '') }}" + '/' +
                                    id, // Llamamos a la ruta para eliminar el usuario
                                type: "DELETE",
                                dataType: 'json',

                                success: function(
                                    response) { // Respuesta del controlador

                                    console.log("Usuario eliminado");
                                    console.log("Id del usuario eliminado: " +
                                        response);
                                    $('#name-' + response).parent().remove()

                                },
                                error: function(error) {

                                    console.log(error);
                                }
                            });
                        } else if (result.isDenied) {
                            Swal.fire('El usuario no será eliminado', '', 'info');
                            console.log("nasti");
                        }
                    });
                });

            });

            // Acción crear Usuario
            $('#btnGuardarNuevo').click(function(e) {
                e.preventDefault();
                name = $('#nameNew').val();
                email = $('#emailNew').val();
                password = $('#passwordNew').val();

                console.log("Nombre nuevo: " + name);
                console.log("Email nuevo:" + email);
                console.log("Password: " + password);

                $.ajax({
                    url: "{{ route('user.store') }}", // Llamamos a la ruta para agregar el usuario
                    type: "POST",
                    dataType: 'json',
                    data: {
                        name,
                        email,
                        password
                    },
                    success: function(response) { // Respuesta del controlador

                        console.log("Usuario añadido");
                        console.log("Id del usuario añadido: " +
                            response);


                        $('tbody').append('<tr><td>' + response.id + '</td><td id="name-' +
                            response.id + '">' +
                            response.name + '</td><td id="email-' + response.id + '">' +
                            response.email + '</td><td id="user_statu-' + response.id +
                            '">' + (response.user_statu == 0 ? "Inactivo" : "Activo") +
                            '</td><td id="role-' + response.id + '">' + response.role +
                            '</td><td>' + response
                            .action + '</td></tr>');

                    },
                    error: function(error) {

                        console.log(error);
                    }
                });


            })
        });
    </script>

@stop
