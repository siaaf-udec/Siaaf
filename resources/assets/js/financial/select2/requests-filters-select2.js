var FiltersSelect2 = function () {

    var $programs = $('#program');
    var $teachers = $('#teacher');
    var $subjects = $('#subject_matter');

    var handleSelect = function () {
        $get( route('financial.api.options.programs'), $programs );

        $programs.select2().on('select2:select', function () {

            $get( route( 'financial.api.options.programs.subjects', { id: $(this).val() } ), $subjects );

            $subjects.on('select2:select', function () {
                $get( route( 'financial.api.options.programs.subjects.teachers', { id: $(this).val() } ), $teachers );
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
        $select.val(null).trigger("change");
        $select.select2();
        $select.prop("disabled", true);
    };

    var $get = function ($url, $disable) {

        $disable.select2({ placeholder: Lang.get("javascript.loading") });

        $.get( $url ).done(function( data ) {
            $disable.select2().prop("disabled", false);
            $formatData($disable, data);
        });
    };

    var $formatData = function ($select, $data) {
        var $resources = $.each($data, function(index, text) {
            return text;
        });
        $select.select2({ placeholder: Lang.get("javascript.select"), data: $resources }).prop("disabled", false);
        $select.val(null).trigger("change");
    };

    return {
        init: function () {
            handleSelect();
        }
    }
}();

$(document).ready(function() {
    FiltersSelect2.init();
});