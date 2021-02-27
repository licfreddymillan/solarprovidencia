@extends('layouts.user.template')

@push('scripts')
    <script>
        function showTransferDetails($transferencia){
            $("#bank_span").html($transferencia.bank);
            $("#transaction_number_span").html($transferencia.transaction_number);
            $("#date_span").html($transferencia.date);
            $("#amount_span").html($transferencia.amount);
            var img = "http://localhost:8000/uploads/images/transfers/"+$transferencia.support_image;
            $("#img_span").html('<img src="'+img+'" style="width: 250px; height: 250px;">');
            $("#modal-transferencia").modal('show');
        }
    </script>
@endpush
@section('content')
    @include('layouts.user.partials.header')
    <div class="course-area pb-150">
        <div class="container">
            @if (Session::has('msj-exitoso'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <strong>{{ Session::get('msj-exitoso') }}</strong>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12 pb-20">
                    <div class="course-title">
                        <h3>Mis Eventos Adquiridos</h3>
                    </div>
                </div>
                @if ($eventos->count() > 0)
                    @foreach ($eventos as $evento)
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="single-course mb-70">
                                <div class="course-img">
                                    <img src="{{ asset('uploads/images/events/'.$evento->cover) }}" alt="{{ $evento->title }}" style="width: 100%; height: 250px;">
                                    <div class="course-hover">
                                        <i class="fa fa-link"></i>
                                    </div>
                                </div>
                                <div class="course-content">
                                    <h3><a href="course-details.html">{{ $evento->title }}</a></h3>
                                    <a class="default-btn" href="{{ route('user.event-resume', [$evento->slug, $evento->id]) }}">Ir al Evento</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 pl-40 pt-20">
                        <span style="font-size: 20px; font-weight: bold;">No posee eventos adquiridos...</span>
                    </div>
                @endif
            </div>

            <hr>
            <div class="row">
                <div class="col-md-12 pb-20">
                    <div class="course-title">
                        <h3>Mis Eventos Pendientes</h3>
                    </div>
                </div>
                @if ($eventosPendientes->count() > 0)
                    @foreach ($eventosPendientes as $eventoPendiente)
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="single-course mb-70">
                                <div class="course-img">
                                    <img src="{{ asset('uploads/images/events/'.$eventoPendiente->event->cover) }}" alt="course" style="width: 100%; height: 250px;">
                                    <div class="course-hover">
                                        <i class="fa fa-link"></i>
                                    </div>
                                </div>
                                <div class="course-content">
                                    <h3><a href="course-details.html">{{ $eventoPendiente->event->title }}</a></h3>
                                    <p>{{ $eventoPendiente->event->subtitle }}</p>
                                    <div class="pb-20"><label class="label label-warning">Esperando confirmación de transferencia</label></div>

                                    <div class="text-center">
                                        <a class="default-btn" href="javascript:;" onclick="showTransferDetails({{$eventoPendiente}});">Detalles de Transferencia</a>
                                        <a class="default-btn" href="{{ route('events.show', [$eventoPendiente->event->slug, $eventoPendiente->event->id]) }}">Detalles del Evento</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 pl-40 pt-20">
                        <span style="font-size: 20px; font-weight: bold;">No posee eventos pendientes...</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-transferencia" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detalles de Transferencia Bancaria</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="form-group">
                        <label class="control-label col-sm-12">
                            Banco: <span style="font-weight: bold;" id="bank_span"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-12">
                            # de Transacción: <span style="font-weight: bold;" id="transaction_number_span"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-12">
                            Fecha de Transacción: <span style="font-weight: bold;" id="date_span"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-12">
                            Monto Depositado: <span style="font-weight: bold;" id="amount_span"></span>
                        </label>
                    </div>

                    <div class="form-group" id="img_span">

                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection