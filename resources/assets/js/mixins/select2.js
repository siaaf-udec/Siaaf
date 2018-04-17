export const mixinSelect2 = {
    name: 'mixin-select2',
    mounted: function () {
        this.select2Default();
    },
    methods: {
        select2Default: function () {
            $.fn.select2.defaults.set('language', Lang.get("javascript.locale") );
            $.fn.select2.defaults.set('placeholder', Lang.get("javascript.select") );
            $.fn.select2.defaults.set('allowClear', true);
            $.fn.select2.defaults.set('width', '100%');
            $(".pmd-select2").select2().on('change', function () {
                $(this).valid();
            });
        }
    }
};