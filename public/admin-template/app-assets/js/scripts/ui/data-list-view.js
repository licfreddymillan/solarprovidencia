/*=========================================================================================
    File Name: data-list-view.js
    Description: List View
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(document).ready(function() {
    "use strict"
    // init list view datatable
    var dataListView = $(".data-list-view").DataTable({
        responsive: false,
        columnDefs: [{
            orderable: true,
            targets: 0,
            checkboxes: { selectRow: true }
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
        select: {
            style: "multi"
        },
        order: [
            [1, "asc"]
        ],
        bInfo: false,
        pageLength: 4,
        buttons: [{
            text: "<i class='feather icon-plus'></i> Nuevo",
            action: function() {
                $(this).removeClass("btn-secondary")
                $(".add-new-data").addClass("show")
                $(".overlay-bg").addClass("show")
                $("#data-name, #data-price").val("")
                $("#data-category, #data-status").prop("selectedIndex", 0)
            },
            className: "btn-outline-primary"
        }],
        initComplete: function(settings, json) {
            $(".dt-buttons .btn").removeClass("btn-secondary")
        }
    });

    dataListView.on('draw.dt', function() {
        setTimeout(function() {
            if (navigator.userAgent.indexOf("Mac OS X") != -1) {
                $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
            }
        }, 50);
    });

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

    /*dataThumbView.on('draw.dt', function() {
        setTimeout(function() {
            if (navigator.userAgent.indexOf("Mac OS X") != -1) {
                $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
            }
        }, 50);
    });*/

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
        $("#description").val(curso.description);
        $("#price").val(curso.price);
        $("#duration").val(curso.duration);
        $("#category_id option[value=" + curso.category_id + "]").attr("selected", true);
        $("#status option[value=" + curso.status + "]").attr("selected", true);
        $("#course_id").val(curso.id);

    })

    // On Edit
    $('.action-edit').on("click", function(e) {
        e.stopPropagation();
        $('#data-name').val('Altec Lansing - Bluetooth Speaker');
        $('#data-price').val('$99');
        $(".add-new-data").addClass("show");
        $(".overlay-bg").addClass("show");
    });

    // On Delete
    $('.action-delete').on("click", function(e) {
        e.stopPropagation();
        $(this).closest('td').parent('tr').fadeOut();
    });

    // dropzone init
    Dropzone.options.dataListUpload = {
        complete: function(files) {
            var _this = this
                // checks files in class dropzone and remove that files
            $(".hide-data-sidebar, .cancel-data-btn, .actions .dt-buttons").on(
                "click",
                function() {
                    $(".dropzone")[0].dropzone.files.forEach(function(file) {
                        file.previewElement.remove()
                    })
                    $(".dropzone").removeClass("dz-started")
                }
            )
        }
    }
    Dropzone.options.dataListUpload.complete()

    // mac chrome checkbox fix
    /*if (navigator.userAgent.indexOf("Mac OS X") != -1) {
        $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
    }*/
})