var DatatableExtension = function () {
    var handleDataTable = function () {

        var table = $('#datatable-extension');
        var lang = Lang.get("javascript.locale");

        var languages = {
          es: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
          en: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
        };

        var language = ( lang === 'en' ) ? languages.en : languages.es;

        table.DataTable({
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, Lang.get('javascript.all')]
            ],
            "order": [
                [0, 'asc']
            ],
            responsive: true,
            colReorder: true,
            language: { url: language },
            bPaginate: false,
            bFilter: false,
            bInfo: false,
            initComplete: function() {
                handleTooltips.init();
            },
            buttons: [
                { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
                { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
                { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>',},
                { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
                { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
                { extend: 'colvis', className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis', text: '<i class="fa fa-bars"></i>'},
            ],
            pageLength: 10,
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    };

    var handleDatePicker = function () {
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                language: Lang.get("javascript.locale"),
                daysOfWeekDisabled: [0],
                defaultTime: !0,
                todayBtn: !0,
                todayHighlight: !0,
                enableOnReadonly: true,
            });
        }
    };

    var initLoading = function () {
        $('#loading-comments').loading({
            message: Lang.get('javascript.loading'),
        });
    };

    var stopLoading = function () {
        $('#loading-comments').loading('stop');
    };

    var handleComment = function () {
        $.get(route('financial.api.extension.comments.index', { id: $('#extension_id').val() }), function (comments) {
            initLoading();
            if ( comments.length > 0 ) {
                $('#extension-comments').empty();
                $('#comment-title').text( Lang.transChoice('javascript.comments', comments.length, { num: comments.length} ) );
            }
            $.each(comments, function (index, text) {
                $('#extension-comments').append( createComment(text) );
            });
        }).done(function () {
            stopLoading();
        }).fail(function (data) {
            handleLaravelErrors.init( data, $('#error-ajax') );
            stopLoading();
        });
    };

    var makeAComment = function () {
        var form = $('#extension-comments-form');

        form.validate({
            errorElement: 'span',
            errorClass: 'help-block help-block-error',
            focusInvalid: false,
            messages: {},
            rules: {
                'comment': { required:true },
                'extension_id': { required:true },
            },

            errorPlacement: function(error, element) {
                error.insertAfter( element.parent().find('.help-block') );
            },

            highlight: function(element) {
                $(element)
                    .closest('.form-group').addClass('has-error');
            },

            unhighlight: function(element) {
                $(element)
                    .closest('.form-group').removeClass('has-error');
            },

            success: function(label) {
                label
                    .closest('.form-group').removeClass('has-error');
            },
        });

        $('#send_extension_comment').click(function(e){
            e.preventDefault();
            var l = Ladda.create(this);
            if ( form.valid() ) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                initLoading();
                l.start();
                var $request = {
                    comment: $('#comment').val(),
                    extension: $('#extension_id').val(),
                };
                $.post(route('financial.api.extension.comments.store'), $request).done(function() {
                    $('#comment').val('');
                    stopLoading();
                    l.stop();
                    handleComment();
                }).fail(function(data) {
                    l.start();
                    handleLaravelErrors.init( data, $('#error-ajax') );
                }).always(function() {
                    stopLoading();
                    l.stop();
                });
            }
            return false;
        });
    };

    var fileExist = function ($image) {

        if ( $image.length === 16 ) {
            var data = new Identicon($image, 45).toString();
            return 'data:image/png;base64,' + data;
        }

        return $image;
    };

    var createComment = function (comment) {
        moment.locale( Lang.get("javascript.locale") );

        var img = fileExist( comment.user.profile_picture );

        var $html;
        $html  = '<div class="media" data-id="'+ comment.pk_id +'" >';
        $html += '<div class="media-left">';
        $html += '<a href="javascript:;">';
        $html += '<img class="media-object" alt="';
        $html += ( comment.user.full_name ) ? comment.user.full_name : Lang.get('financial.generic.empty') ;
        $html += '" src="'+img+'" />';
        $html += '</a>';
        $html += '</div>';
        $html += '<div class="media-body">';
        $html += '<h6 class="media-heading">';
        $html += '<a href="javascript:;">';
        $html += ( comment.user.full_name ) ? comment.user.full_name : Lang.get('financial.generic.empty');
        $html += '</a> ';
        $html += '<span class="c-date"><sub>';
        $html += ( comment.created_at ) ? moment( comment.created_at ).fromNow() : Lang.get('financial.generic.empty');
        $html += '</sub></span>';
        $html += '</h6>';
        $html += '<small>'+( comment.comment ) ? comment.comment.replace(/(<([^>]+)>)/ig,"") : Lang.get('financial.generic.empty')+'</small>';
        $html += '</div>';
        $html += '</div>';

        return $html;
    };

    var deleteExtension = function () {

        $('#trash_button').on('click', function (e) {
            e.preventDefault();
            swal({
                title: Lang.get('javascript.warning'),
                text: Lang.get('javascript.ask_if_delete'),
                type: "question",
                showCancelButton: true,
                confirmButtonClass: "btn-danger ladda-button",
                confirmButtonText: Lang.get('financial.buttons.yes'),
                cancelButtonText: Lang.get('financial.buttons.cancel'),
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function () {
                        $('#delete-extension-form').submit();
                    });
                },
                allowOutsideClick: false
            }).then(function () {
                swal(Lang.get('javascript.success'), Lang.get('javascript.deleted_done'), "success");
            }).catch(swal.noop);

        });
    };

    return {
        init: function () {
            handleDataTable();
            handleDatePicker();
            handleComment();
            makeAComment();
            deleteExtension();
        }
    };
}();


$(document).ready(function() {
    DatatableExtension.init();
});