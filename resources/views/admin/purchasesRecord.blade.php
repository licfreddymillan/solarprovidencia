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
            buttons: [],
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
    });
</script>
@endpush

@section('content')
    <section id="data-thumb-view" class="data-thumb-view-header">
        <!-- dataTable starts -->
        <div class="table-responsive">
            <table class="table data-thumb-view">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Curso</th>
                        <th>Evento</th>
                        <th>Forma de Pago</th>
                        <th># Transacción</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)
                    <tr>
                        <td class="product-name">{{ date('d-m-Y', strtotime($compra->date)) }}</td>
                        <td class="product-category">{{ $compra->user->name }}</td>
                        <td class="product-category">@if (!is_null($compra->course_id)) {{ $compra->course->title }} @else - @endif</td>
                        <td class="product-category">@if (!is_null($compra->event_id)) {{ $compra->event->title }} @else - @endif</td>
                        <td class="product-name">{{ $compra->payment_method }}</td>
                        <td class="product-name">{{ $compra->payment_id }}</td>
                        <td class="product-name">{{ $compra->amount }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- dataTable ends -->
    </section>
@endsection