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
                text: "<i class='feather icon-mail'></i> Enviar Correo a Todos",
                action: function() {
                    $(this).removeClass("btn-secondary")
                    $(".add-new-data").addClass("show");
                    $(".overlay-bg").addClass("show");
                    $("#send-mail").css('display', 'block');
                    $("#overlay-text").empty();
                    $("#overlay-text").append('Nuevo Correo Electrónico');
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
        })
    });
</script>
@endpush

@section('content')
    @if (Session::has('mail-msj'))
        <script>
            $(document).ready(function() {
                toastr.success('El correo electrónico ha sido enviado con éxito', {
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
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Forma de Pago</th>
                        <th># Transacción</th>
                        <th>Monto Pagado</th>
                        <th>Fecha de Pago</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evento->purchases as $suscriptor)
                    <tr>
                        <td class="product-name">{{ $suscriptor->user->name }}</td>
                        <td class="product-category">{{ $suscriptor->user->email }}</td>
                        <td class="product-category">{{ $suscriptor->payment_method }}</td>
                        <td class="product-category">{{ $suscriptor->payment_id }}</td>
                        <td class="product-category">{{ number_format($suscriptor->amount, 0, ',', '.') }}</td>
                        <td class="product-category">{{ date('d-m-Y', strtotime($suscriptor->date)) }}</td>
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
                <div id="send-mail" style="height: 90%; overflow-y: scroll;">
                    <form action="{{ route('admin.events.send-mail') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $evento->id }}">
                        <div class="data-items pb-3" style="height: auto;">
                            <div class="data-fields px-2">
                                <div class="row">
                                    <div class="col-sm-12 data-field-col">
                                        <label for="title">Asunto</label>
                                        <input type="text" class="form-control" name="title" required>
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="description">Mensaje</label>
                                        <textarea class="ckeditor form-control" name="description" required></textarea>
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="cover">Archivo Adicional</label>
                                        <input type="file" class="form-control" name="file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                            <div class="add-data-btn">
                                <button type="submit" class="btn btn-primary">Enviar Correo</button>
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