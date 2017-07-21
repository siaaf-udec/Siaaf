/**
 * Created by danielprado on 20/07/17.
 */
jQuery(document).ready(function () {
    $.fn.select2.defaults.set('language', 'es');
    $(".pmd-select2").select2({
        width: null,
        placeholder: "Seleccionar",
        allowClear: true,
    }).on('change', function () {
        $(this).valid();
    });
});