var FillSelect = function () {

    var $programs = $('#program');
    var $programs_val = $('#program_select').val();
    var $teachers = $('#teacher');
    var $teachers_val = $('#teacher_select').val();
    var $subjects = $('#subject_matter');
    var $subjects_val = $('#subject_select').val();

    var fillFirst = function () {
        $.get( route('financial.api.options.programs') ).done(function( data ) {
            $programs.select2({ placeholder: Lang.get("javascript.loading") });
            $programs.select2().prop("disabled", true);
            $formatData($programs, data, $programs_val);
        }).then( function(  ) {
            $programs.select2().prop("disabled", false);
            $programs.val( $programs_val ).trigger("change");
            $.get( route( 'financial.api.options.programs.subjects', { id: $programs_val } ) ).done(function( data ) {
                $subjects.select2({ placeholder: Lang.get("javascript.loading") });
                $subjects.select2().prop("disabled", true);
                $formatData($subjects, data, $subjects_val );
            }).then( function(  ) {
                $subjects.select2().prop("disabled", false);
                $subjects.val( $subjects_val ).trigger("change");

                $.get( route( 'financial.api.options.programs.subjects.teachers', { id: $subjects_val } ) ).done(function( data ) {
                    $subjects.select2({ placeholder: Lang.get("javascript.loading") });
                    $teachers.select2().prop("disabled", true);
                    $formatData($teachers, data, $teachers_val );
                }).then( function(  ) {
                    $teachers.select2().prop("disabled", false);
                    $teachers.val( $teachers_val ).trigger("change");
                });

            });
        });

        $subjects.on('select2:select', function () {
            $get( route( 'financial.api.options.programs.subjects.teachers', { id: $(this).val() } ), $teachers);
        }).on('change', function () {
            cleanSelect($teachers);
        }).on('select2:unselect', function () {
            cleanSelect($teachers);
        });
    };

    var handleSelect = function () {

        $programs.select2().on('select2:select', function () {

            $get( route( 'financial.api.options.programs.subjects', { id: $(this).val() } ), $subjects );

            $subjects.on('select2:select', function () {
                $get( route( 'financial.api.options.programs.subjects.teachers', { id: $(this).val() } ), $teachers);
            }).on('change', function () {
                cleanSelect($teachers);
            }).on('select2:unselect', function () {
                cleanSelect($teachers);
            });

        }).on('change', function () {
            cleanSelect($teachers);
            cleanSelect($subjects);
        }).on('select2:unselect', function () {
            cleanSelect($teachers);
            cleanSelect($subjects);
        });
    };

    var cleanSelect = function ($select) {
        $select.empty();
        $select.val( null ).trigger("change");
        $select.select2();
        $select.prop("disabled", true);
    };

    var $get = function ($url, $disable, $set) {

        $set = $set | null;

        $disable.select2({ placeholder: Lang.get("javascript.loading") });

        $.get( $url ).done(function( data ) {
            $disable.select2().prop("disabled", false);
            $formatData($disable, data, $set);
        }).then( function(  ) {
            $disable.val( $set ).trigger("change");
        });
    };

    var $formatData = function ($select, $data, $set) {
        var $resources = $.each($data, function(index, text) {
            return text;
        });
        $select.select2({ placeholder: Lang.get("javascript.select"), data: $resources }).prop("disabled", false);
        $select.val( null ).trigger("change");
    };

    return {
        init: function () {
            fillFirst();
            handleSelect();
        }
    };
}();
$(document).ready(function() {
    FillSelect.init();
});