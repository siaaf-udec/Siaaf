export const mixinEditable = {
    name: 'mixin-editable',
    mounted: function () {
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.ajaxOptions = {
            type: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };
    }
};