import {mixinMomentLocale} from "./moment";

export const mixinDate = {
    name: 'mixin-date-picker',
    mixins: [mixinMomentLocale],
    mounted: function () {
        this.handleDatePickerDefaults();
    },
    methods: {
        handleDatePickerDefaults: function () {
            $.extend($.fn.datepicker.defaults, {
                rtl: App.isRTL(),
                language: Lang.get('javascript.locale'),
                orientation: "left",
                autoclose: true,
                firstDay: 1,
                showMonthAfterYear: false,
                todayBtn: true,
                todayHighlight: true,
                calendarWeeks: true,
                daysOfWeekDisabled: [0],
                startDate: '+0d',
                clearBtn: true,
            });
        }
    }
};