@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/vendors/css/file-uploaders/dropzone.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/plugins/file-uploaders/dropzone.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin-template/app-assets/css/pages/data-list-view.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('admin-template/app-assets/vendors/js/extensions/dropzone.min.js') }}"></script>
<script src="{{ asset('admin-template/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('admin-template/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('admin-template/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin-template/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin-template/app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
<script src="{{ asset('admin-template/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        "use strict"
        // init thumb view datatable
        var dataThumbView = $(".data-thumb-view").DataTable({
            responsive: false,
            columnDefs: [{
                orderable: true,
                targets: 0
                // checkboxes: { selectRow: true }
            }],
            dom: '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
            oLanguage: {
                sLengthMenu: "_MENU_",
                sSearch: ""
            },
            aLengthMenu: [
                [4, 10, 15, 20],
                [4, 10, 15, 20]
            ],
            /*select: {
                style: "multi"
            },*/
            order: [
                [1, "asc"]
            ],
            bInfo: false,
            pageLength: 10,
            buttons: [{
                text: "<i class='feather icon-plus'></i> Nuevo Evento",
                action: function() {
                    $(this).removeClass("btn-secondary")
                    $(".add-new-data").addClass("show");
                    $(".overlay-bg").addClass("show");
                    $("#edit-event").css('display', 'none');
                    $("#new-event").css('display', 'block');
                    $("#overlay-text").empty();
                    $("#overlay-text").append('Nuevo Evento');
                },
                className: "btn-outline-primary"
            }],
            initComplete: function(settings, json) {
                $(".dt-buttons .btn").removeClass("btn-secondary")
            }
        })

        // To append actions dropdown before add new button
        var actionDropdown = $(".actions-dropodown")
        actionDropdown.insertBefore($(".top .actions .dt-buttons"))

        // Scrollbar
        if ($(".data-items").length > 0) {
            new PerfectScrollbar(".data-items", {
                wheelPropagation: false
            })
        }

        // Close sidebar
        $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function(e) {
            e.preventDefault();
            $(".add-new-data").removeClass("show")
            $(".overlay-bg").removeClass("show")
            $("#data-name, #data-price").val("")
            $("#data-category, #data-status").prop("selectedIndex", 0)
        })

        $(".edit-event").on("click", function() {
            var evento = $.parseJSON($(this).attr('data-event'));
            console.log(evento);
            $(".add-new-data").addClass("show")
            $(".overlay-bg").addClass("show")
            $("#new-event").css('display', 'none');
            $("#edit-event").css('display', 'block');
            $("#overlay-text").empty();
            $("#overlay-text").append('Editar Evento');
            $("#title").val(evento.title);
            CKEDITOR.instances["description"].setData(evento.description);
            $("#price").val(evento.price);
            $("#date").val(evento.date);
            $("#time").val(evento.time);
            $("#place").val(evento.place);
            $("#link").val(evento.link);
            $("#live option[value=" + evento.live + "]").attr("selected", true);
            $("#status option[value=" + evento.status + "]").attr("selected", true);
            $("#event_id").val(evento.id);
        });

        $('.delete-event').on('click', function(e) {
            //e.preventDefault();
            var event_id = $(this).attr('data-id');
            Swal.fire({
                title: '¿Estás seguro de borrar el evento?',
                text: "¡Este cambio no puede ser revertido!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Borrar',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
            }).then(function(result) {
                if (result.value) {
                    var a = document.getElementById("delete-link-" + event_id);
                    a.click();
                }
            });
        });
    });
</script>
@endpush

@section('content')
@if (Session::has('store-msj'))
<script>
    $(document).ready(function() {
        toastr.success('El evento ha sido creado con éxito', {
            "closeButton": true
        });
    });
</script>
@endif
@if (Session::has('update-msj'))
<script>
    $(document).ready(function() {
        toastr.success('El evento ha sido modificado con éxito', {
            "closeButton": true
        });
    });
</script>
@endif
@if (Session::has('delete-msj'))
<script>
    $(document).ready(function() {
        toastr.success('El evento ha sido eliminado con éxito', {
            "closeButton": true
        });
    });
</script>
@endif
<section id="data-thumb-view" class="data-thumb-view-header">
    <!-- dataTable starts -->
    <div class="table-responsive">
        <table class="table data-thumb-view">
            <thead>
                <tr>
                    <th>Portada</th>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Lugar</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventos as $evento)
                <tr>
                    <td class="product-img"><img src="{{ asset('uploads/images/events/'.$evento->cover) }}" alt="{{ $evento->title }}" style="width: 150px; height: 100px;">
                    </td>
                    <td class="product-name">{{ $evento->title }}</td>
                    <td class="product-category">{{ date('d-m-Y', strtotime($evento->date)) }}</td>
                    <td class="product-category">{{ date('H:i A', strtotime($evento->time)) }}</td>
                    <td>{{ $evento->place }}</td>
                    <td class="product-category">${{ $evento->price }}</td>
                    <td>
                        <div @if ($evento->status == 0) class="chip chip-danger" @elseif ($evento->status == 1) class="chip chip-success" @else class="chip chip-warning" @endif>
                            <div class="chip-body">
                                <div class="chip-text">@if ($evento->status == 0) No Disponible @elseif ($evento->status == 2) Finalizado @else Disponible @endif</div>
                            </div>
                        </div>
                    </td>
                    <td class="product-action">
                        <span style="font-size: 20px;"><a href="javascript:;" class="edit-event" data-event="{{$evento}}" title="Editar"><i class="feather icon-edit"></i></a></span>
                        @if ($evento->users_count == 0)
                            <span style="font-size: 20px;"><a href="javascript:;" class="delete-event" data-id="{{ $evento->id }}" title="Eliminar"><i class="feather icon-trash"></i></a></span>
                            <a href="{{ route('admin.events.delete', $evento->id) }}" id="delete-link-{{$evento->id}}"></a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- dataTable ends -->

    <!-- add new sidebar starts -->
    <div class="add-new-data-sidebar">
        <div class="overlay-bg"></div>
        <div class="add-new-data" style="width: 40% !important;">
            <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                <div>
                    <h4 class="text-uppercase" id="overlay-text"></h4>
                </div>
                <div class="hide-data-sidebar">
                    <i class="feather icon-x"></i>
                </div>
            </div>
            <div id="new-event" style="height: 90%; overflow-y: scroll;">
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="data-items pb-3" style="height: auto;">
                        <div class="data-fields px-2">
                            <div class="row">
                                <div class="col-sm-12 data-field-col">
                                    <label for="title">Título</label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="description">Descripción</label>
                                    <textarea class="ckeditor form-control" name="description" required></textarea>
                                </div>
                                <div class="col-sm-4 data-field-col">
                                    <label for="price">Precio</label>
                                    <input type="text" class="form-control" name="price" required>
                                </div>
                                <div class="col-sm-4 data-field-col">
                                    <label for="date">Fecha</label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                                <div class="col-sm-4 data-field-col">
                                    <label for="time">Hora</label>
                                    <input type="time" class="form-control" name="time" required>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="place">Lugar</label>
                                    <input type="text" class="form-control" name="place" required>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="cover">Portada</label>
                                    <input type="file" class="form-control" name="cover" required>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="live"> Tipo de Evento</label>
                                    <select class="form-control" id="live" name="live" required>
                                        <option value="1">En Vivo</option>
                                        <option value="0">Pregrabado</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="link">Link (Opcional)</label>
                                    <input type="text" class="form-control" name="link">
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="video">Video (Opcional)</label>
                                    <input type="file" class="form-control" name="video">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                        <div class="add-data-btn">
                            <button type="submit" class="btn btn-primary">Crear Evento</button>
                        </div>
                        <div class="cancel-data-btn">
                            <button class="btn btn-outline-danger">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="edit-event" style="display: none; height: 90%; overflow-y: scroll;">
                <form action="{{ route('admin.events.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" name="event_id" id="event_id">
                    <div class="data-items pb-3" style="height: auto;">
                        <div class="data-fields px-2">
                            <div class="row">
                                <div class="col-sm-12 data-field-col">
                                    <label for="title">Título</label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="description">Descripción</label>
                                    <textarea class="ckeditor form-control" name="description" id="description" required></textarea>
                                </div>
                                <div class="col-sm-4 data-field-col">
                                    <label for="price">Precio</label>
                                    <input type="text" class="form-control" name="price" id="price" required>
                                </div>
                                <div class="col-sm-4 data-field-col">
                                    <label for="date">Fecha</label>
                                    <input type="date" class="form-control" name="date" id="date" required>
                                </div>
                                <div class="col-sm-4 data-field-col">
                                    <label for="time">Hora</label>
                                    <input type="time" class="form-control" name="time" id="time" required>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="place">Lugar</label>
                                    <input type="text" class="form-control" name="place" id="place" required>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="cover">Portada</label>
                                    <input type="file" class="form-control" name="cover" >
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="live"> Tipo de Evento</label>
                                    <select class="form-control" id="live" name="live" required>
                                        <option value="1">En Vivo</option>
                                        <option value="0">Pregrabado</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="link">Link</label>
                                    <input type="text" class="form-control" name="link" id="link">
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="video">Video</label>
                                    <input type="file" class="form-control" name="video">
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="status"> Estado</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="1">Disponible</option>
                                        <option value="0">No Disponible</option>
                                        <option value="2">Finalizado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                        <div class="add-data-btn">
                            <button type="submit" class="btn btn-primary">Modificar Evento</button>
                        </div>
                        <div class="cancel-data-btn">
                            <button class="btn btn-outline-danger">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add new sidebar ends -->
</section>
@endsection