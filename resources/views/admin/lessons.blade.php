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
                    text: "<i class='feather icon-plus'></i> Nueva Lección",
                    action: function() {
                        $(this).removeClass("btn-secondary")
                        $(".add-new-data").addClass("show");
                        $(".overlay-bg").addClass("show");
                        $("#edit-lesson").css('display', 'none');
                        $("#new-lesson").css('display', 'block');
                        $("#overlay-text").empty();
                        $("#overlay-text").append('Nueva Lección');
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
                new PerfectScrollbar(".data-items", { wheelPropagation: false })
            }

            // Close sidebar
            $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function(e) {
                e.preventDefault();
                $(".add-new-data").removeClass("show")
                $(".overlay-bg").removeClass("show")
            })

            $(".edit-lesson").on("click", function() {
                var leccion = $.parseJSON($(this).attr('data-lesson'));
                $(".add-new-data").addClass("show")
                $(".overlay-bg").addClass("show")
                $("#new-lesson").css('display', 'none');
                $("#edit-lesson").css('display', 'block');
                $("#overlay-text").empty();
                $("#overlay-text").append('Editar Lección');
                $("#title").val(leccion.title);
                CKEDITOR.instances["description"].setData(leccion.description);
                $("#duration").val(leccion.duration);
                $("#status option[value=" + leccion.status + "]").attr("selected", true);
                $("#video").val(leccion.video);
                $("#lesson_id").val(leccion.id);
            });

            $('.delete-lesson').on('click', function (e) {
                //e.preventDefault();
                var lesson_id = $(this).attr('data-id');
                Swal.fire({
                    title: '¿Estás seguro de borrar la lección?',
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
                }).then(function (result) {
                    if (result.value) {
                        var a = document.getElementById("delete-link-"+lesson_id);
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
            $(document).ready(function () {
                toastr.success('La lección ha sido creada con éxito', { "closeButton": true });
            });
        </script>
    @endif
    @if (Session::has('update-msj'))
        <script>
            $(document).ready(function () {
                toastr.success('La lección ha sido modificada con éxito', { "closeButton": true });
            });
        </script>
    @endif
    @if (Session::has('delete-msj'))
        <script>
            $(document).ready(function () {
                toastr.success('La lección ha sido eliminada con éxito', { "closeButton": true });
            });
        </script>
    @endif
    <section id="data-thumb-view" class="data-thumb-view-header">
        <!-- dataTable starts -->
        <div class="table-responsive">
            <table class="table data-thumb-view">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Duración</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lecciones as $leccion)
                    <tr>
                        <td>{{ $leccion->order }}</td>
                        <td class="product-name">{{ $leccion->title }}</td>
                        <td class="product-category">{!! $leccion->description !!}</td>
                        <td class="product-name">{{ $leccion->duration }}</td>
                        <td>
                            <div @if ($leccion->status == 0) class="chip chip-warning" @else class="chip chip-success" @endif>
                                <div class="chip-body">
                                    <div class="chip-text">@if ($leccion->status == 0) No Disponible @else Disponible @endif</div>
                                </div>
                            </div>
                        </td>
                        <td class="product-action">
                            <span style="font-size: 20px;"><a href="javascript:;" class="edit-lesson" data-lesson="{{$leccion}}" title="Editar"><i class="feather icon-edit"></i></a></span>
                            <span style="font-size: 20px;"><a href="javascript:;" class="delete-lesson" data-id="{{ $leccion->id }}" title="Eliminar"><i class="feather icon-trash"></i></a></span>
                            <a href="{{ route('admin.courses.lessons.delete', $leccion->id) }}" id="delete-link-{{$leccion->id}}"></a>
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
            <div class="add-new-data">
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase" id="overlay-text"></h4>
                    </div>
                    <div class="hide-data-sidebar">
                        <i class="feather icon-x"></i>
                    </div>
                </div>
                <div id="new-lesson" style="height: 90%; overflow-y: scroll;">
                    <form action="{{ route('admin.courses.lessons.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $datosCurso->id }}">
                        <div class="data-items pb-3">
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
                                    <div class="col-sm-12 data-field-col">
                                        <label for="duration">Duración</label>
                                        <input type="text" class="form-control" name="duration">
                                    </div>
                                    @if ($datosCurso->type == "Pregrabado")
                                        <div class="col-sm-12 data-field-col">
                                            <label for="title">Link del Video</label>
                                            <input type="url" class="form-control" name="video" required>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                            <div class="add-data-btn">
                                <button type="submit" class="btn btn-primary">Crear Lección</button>
                            </div>
                            <div class="cancel-data-btn">
                                <button class="btn btn-outline-danger">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="edit-lesson" style="display: none; height: 90%; overflow-y: scroll;">
                    <form action="{{ route('admin.courses.lessons.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" name="lesson_id" id="lesson_id">
                        <div class="data-items pb-3">
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
                                    <div class="col-sm-12 data-field-col">
                                        <label for="duration">Duración</label>
                                        <input type="text" class="form-control" name="duration" id="duration">
                                    </div>
                                    @if ($datosCurso->type == "Pregrabado")
                                        <div class="col-sm-12 data-field-col">
                                            <label for="title">Link del Video</label>
                                            <input type="url" class="form-control" name="video" id="video" required>
                                        </div>
                                    @endif
                                    <div class="col-sm-12 data-field-col">
                                        <label for="status"> Estado</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="1">Disponible</option>
                                            <option value="0">No Disponible</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                            <div class="add-data-btn">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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