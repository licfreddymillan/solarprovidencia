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
                [0, "desc"]
            ],
            bInfo: false,
            pageLength: 10,
            buttons: [{
                text: "<i class='feather icon-plus'></i> Nuevo Curso",
                action: function() {
                    $(this).removeClass("btn-secondary")
                    $(".add-new-data").addClass("show");
                    $(".overlay-bg").addClass("show");
                    $("#edit-course").css('display', 'none');
                    $("#new-course").css('display', 'block');
                    $("#overlay-text").empty();
                    $("#overlay-text").append('Nuevo Curso');
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

        $(".edit-course").on("click", function() {
            var curso = $.parseJSON($(this).attr('data-course'));
            $(".add-new-data").addClass("show")
            $(".overlay-bg").addClass("show")
            $("#new-course").css('display', 'none');
            $("#edit-course").css('display', 'block');
            $("#overlay-text").empty();
            $("#overlay-text").append('Editar Curso');
            $("#title").val(curso.title);
            $("#subtitle").val(curso.subtitle);
            CKEDITOR.instances["description"].setData(curso.description);
            $("#price").val(curso.price);
            $("#date").val(curso.date);
            $("#category_id option[value=" + curso.category_id + "]").attr("selected", true);
            $("#type option[value=" + curso.type + "]").attr("selected", true);
            $("#level option[value=" + curso.level + "]").attr("selected", true);
            $("#language option[value=" + curso.language + "]").attr("selected", true);
            $("#status option[value=" + curso.status + "]").attr("selected", true);
            $("#course_id").val(curso.id);
        });

        $('.delete-course').on('click', function(e) {
            //e.preventDefault();
            var course_id = $(this).attr('data-id');
            Swal.fire({
                title: '¿Estás seguro de borrar el curso?',
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
                    var a = document.getElementById("delete-link-" + course_id);
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
        toastr.success('El curso ha sido creado con éxito', {
            "closeButton": true
        });
    });
</script>
@endif
@if (Session::has('update-msj'))
<script>
    $(document).ready(function() {
        toastr.success('El curso ha sido modificado con éxito', {
            "closeButton": true
        });
    });
</script>
@endif
@if (Session::has('delete-msj'))
<script>
    $(document).ready(function() {
        toastr.success('El curso ha sido eliminado con éxito', {
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
                    <th>#</th>
                    <th>Portada</th>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Nivel</th>
                    <th>Idioma</th>
                    <th>Estado</th>
                    <th>Precio</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cursos as $curso)
                <tr>
                    <td>{{ $curso->id }}</td>
                    <td class="product-img"><img src="{{ asset('uploads/images/courses/'.$curso->cover) }}" alt="{{ $curso->title }}" style="width: 150px; height: 100px;">
                    </td>
                    <td class="product-name">{{ $curso->title }}</td>
                    <td class="product-category">{{ $curso->category->title }}</td>
                    <td class="product-category">{{ $curso->level }}</td>
                    <td class="product-category">{{ $curso->language }}</td>
                    <td>
                        <div @if ($curso->status == 0) class="chip chip-warning" @else class="chip chip-success" @endif>
                            <div class="chip-body">
                                <div class="chip-text">@if ($curso->status == 0) No Disponible @else Disponible @endif</div>
                            </div>
                        </div>
                    </td>
                    <td class="product-price">${{ $curso->price }}</td>
                    <td class="product-action">
                        <span style="font-size: 20px;"><a href="javascript:;" class="edit-course" data-course="{{$curso}}" title="Editar"><i class="feather icon-edit"></i></a></span>
                        <span style="font-size: 20px;"><a href="{{ route('admin.courses.lessons', $curso->id) }}" title="Ver Lecciones"><i class="feather icon-search"></i></a></span>
                        @if ($curso->users_count == 0)
                            <span style="font-size: 20px;"><a href="javascript:;" class="delete-course" data-id="{{ $curso->id }}" title="Eliminar"><i class="feather icon-trash"></i></a></span>
                            <a href="{{ route('admin.courses.delete', $curso->id) }}" id="delete-link-{{$curso->id}}"></a>
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
            <div id="new-course" style="height: 90%; overflow-y: scroll;">
                <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="data-items pb-3" style="height: auto;">
                        <div class="data-fields px-2">
                            <div class="row">
                                <div class="col-sm-12 data-field-col">
                                    <label for="title">Título</label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="subtitle">Subtítulo</label>
                                    <input type="text" class="form-control" name="subtitle" required>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="description">Descripción</label>
                                    <textarea class="ckeditor form-control" name="description" required></textarea>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="category_id"> Categoría</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="" selected disabled>Seleccione una opción...</option>
                                        @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="type"> Tipo de Curso</label>
                                    <select class="form-control" name="type" required>
                                        <option value="" selected disabled>Seleccione una opción...</option>
                                        <option value="Online">Online</option>
                                        <option value="Pregrabado">Pregrabado</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="category_id"> Nivel</label>
                                    <select class="form-control" name="level" required>
                                        <option value="" selected disabled>Seleccione una opción...</option>
                                        <option value="Principiante">Principiante</option>
                                        <option value="Intermedio">Intermedio</option>
                                        <option value="Avanzado">Avanzado</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="category_id"> Idioma</label>
                                    <select class="form-control" name="language" required>
                                        <option value="" selected disabled>Seleccione una opción...</option>
                                        <option value="Español">Español</option>
                                        <option value="Inglés">Inglés</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="price">Precio</label>
                                    <input type="text" class="form-control" name="price" required>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="date">Fecha</label>
                                    <input type="date" class="form-control" name="date">
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="cover">Portada</label>
                                    <input type="file" class="form-control" name="cover" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                        <div class="add-data-btn">
                            <button type="submit" class="btn btn-primary">Crear Curso</button>
                        </div>
                        <div class="cancel-data-btn">
                            <button class="btn btn-outline-danger">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="edit-course" style="display: none; height: 90%; overflow-y: scroll;">
                <form action="{{ route('admin.courses.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" name="course_id" id="course_id">
                    <div class="data-items pb-3" style="height: auto;">
                        <div class="data-fields px-2">
                            <div class="row">
                                <div class="col-sm-12 data-field-col">
                                    <label for="title">Título</label>
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="subtitle">Subtítulo</label>
                                    <input type="text" class="form-control" name="subtitle" id="subtitle" required>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="description">Descripción</label>
                                    <textarea class="ckeditor form-control" name="description" id="description" required></textarea>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="category_id"> Categoría</label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="" selected disabled>Seleccione una opción...</option>
                                        @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="type"> Tipo de Curso</label>
                                    <select class="form-control" name="type" id="type" required>
                                        <option value="" selected disabled>Seleccione una opción...</option>
                                        <option value="Online">Online</option>
                                        <option value="Pregrabado">Pregrabado</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="category_id"> Nivel</label>
                                    <select class="form-control" name="level" id="level" required>
                                        <option value="" selected disabled>Seleccione una opción...</option>
                                        <option value="Principiante">Principiante</option>
                                        <option value="Intermedio">Intermedio</option>
                                        <option value="Avanzado">Avanzado</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="category_id"> Idioma</label>
                                    <select class="form-control" name="language" id="language" required>
                                        <option value="" selected disabled>Seleccione una opción...</option>
                                        <option value="Español">Español</option>
                                        <option value="Inglés">Inglés</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="price">Precio</label>
                                    <input type="text" class="form-control" name="price" id="price" required>
                                </div>
                                <div class="col-sm-6 data-field-col">
                                    <label for="date">Fecha</label>
                                    <input type="date" class="form-control" name="date" id="date" required>
                                </div>
                                <div class="col-sm-12 data-field-col">
                                    <label for="duration">Portada</label>
                                    <input type="file" class="form-control" name="cover" id="cover">
                                </div>
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
                            <button type="submit" class="btn btn-primary">Modificar Curso</button>
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