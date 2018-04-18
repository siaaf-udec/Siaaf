import moment from "moment-with-locales-es6";

export const mixinMomentLocale = {
    name: 'mixin-moment-locale',
    mounted: function () {
        this.setMomentLocale();
    },
    methods: {
        setMomentLocale: function () {
            moment.locale( Lang.get('javascript.locale') );
        }
    }
};