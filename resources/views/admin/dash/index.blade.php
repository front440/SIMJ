@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.FullCalendar', true);
@section('plugins.Sweetalert2', true);
@section('plugins.Datatables', true);

@section('content_header')
    <h1>Calendario</h1>
@stop

@section('content')
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body row">
                    {{-- <form method="POST" class="row" action="{{ route('event.store') }}"> --}}
                    @csrf

                    <div class="row col-12">
                        <label for="title" class="col-md-12 col-form-label text-md-end">{{ __('Título') }}</label>

                        <div class="col-md-12">
                            <input id="title" type="text" id="title"
                                class="form-control @error('title') is-invalid @enderror" name="title"
                                value="{{ old('title') }}" required autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row col-6">
                        <label for="startDate"
                            class="col-md-12 col-form-label text-md-end">{{ __('Fecha / Hora de Inicio') }}</label>

                        <div class="col-md-12">
                            <input id="startDate" type="datetime-local" id="startDate"
                                class="form-control @error('startDate') is-invalid @enderror" name="startDate"
                                value="{{ old('startDate') }}" required autocomplete="startDate" autofocus>

                            @error('startDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row col-6">
                        <label for="endDate"
                            class="col-md-12 col-form-label text-md-end">{{ __('Fecha / Hora de Fin') }}</label>

                        <div class="col-md-12">
                            <input id="endDate" type="datetime-local" id="endDate"
                                class="form-control @error('endDate') is-invalid @enderror" name="endDate"
                                value="{{ old('endDate') }}" required autocomplete="endDate" autofocus>

                            @error('endDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row col-12">
                        <label for="eventType"
                            class="col-md-12 col-form-label text-md-end">{{ __('Tipo de Evento') }}</label>

                        <div class="col-md-12">
                            {{-- <input id="eventType" type="datetime" id="eventType"
                                class="form-control @error('eventType') is-invalid @enderror" name="eventType"
                                value="{{ old('eventType') }}" required autocomplete="eventType" autofocus> --}}


                            <select class="form-control" id="eventType">
                                @foreach ($eventTypes as $eventType)
                                    <option value="{{ $eventType->id }}">{{ $eventType->title }}</option>
                                @endforeach
                            </select>

                            @error('eventType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row col-12 text-right">
                        <div class="col-md-12 pt-2">
                            <button type="submit" class="btn bg-success text-white" id="saveBtn">
                                {{ __('Guardar') }}
                            </button>
                            <button type="button" class="btn bg-danger text-white" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>



    <div class="card">
        <div class="card-header">
            Calendario
        </div>
        <div class="card-body">

            <div id="calendar">
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let booking = @json($events);

        // console.log(events);
        $(document).ready(function() {

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay'
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDays) {
                    $('#myModal').modal('toggle');


                    startDate = $.datepicker.formatDate("yy-mm-ddT00:00", start._d);
                    let endDate = $.datepicker.formatDate("yy-mm-ddT00:00", end._d);
                    $("#startDate").val(startDate);
                    $("#endDate").val(endDate);


                    $('#saveBtn').click(function(date) {

                        let title = $('#title').val();
                        let start_date = moment(start).format('YYYY-MM-DD');
                        let end_date = moment(end).format('YYYY-MM-DD');
                        let id_event_type = parseInt($('#eventType').val());

                        $.ajax({

                            url: "{{ route('event.store') }}",
                            type: "POST",
                            dataType: 'json',
                            data: {
                                title,
                                start_date,
                                end_date,
                                id_event_type
                            },
                            success: function(response) {

                                console.log(response);
                                $('#myModal').modal('hide');
                                $('#calendar').fullCalendar('renderEvent', {
                                    'title': response.title,
                                    'start': response.start_date,
                                    'end': response.end_date,
                                    'id_event_type': response.id_event_type,
                                });

                            },
                            error: function(error) {


                            }
                        });


                    });

                },
                editable: true,
                eventDrop: function(event) {
                    console.log(event.end);
                    let id = event.id;
                    let start_date = moment(event.start).format('YYYY-MM-DD');
                    let end_date = moment(event.end).format('YYYY-MM-DD');
                    // let id_event_type = parseInt($('#eventType').val());

                    $.ajax({

                        url: "{{ route('event.update', '') }}" + '/' + id,
                        type: "PATCH",
                        dataType: 'json',
                        data: {
                            // title,
                            start_date,
                            end_date,
                            // id_event_type
                        },
                        success: function(response) {

                            console.log(response);

                        },
                        error: function(error) {

                            console.log(error);
                        }
                    });
                },
                eventClick: function(event) {
                    var id = event.id;
                    if (confirm('Are you sure want to remove it')) {
                        $.ajax({
                            url: "{{ route('event.destroy', '') }}" + '/' + id,
                            type: "DELETE",
                            dataType: 'json',
                            success: function(response) {
                                $('#calendar').fullCalendar('removeEvents', response);
                                // swal("Good job!", "Event Deleted!", "success");
                            },
                            error: function(error) {
                                console.log(error)
                            },
                        });
                    }
                },
            });
        });
    </script>
@stop
