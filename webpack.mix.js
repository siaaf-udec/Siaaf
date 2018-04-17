const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


/*
 |--------------------------------------------------------------------------
 | Financial Assets Management
 |--------------------------------------------------------------------------
 |
 */
const WebpackShellPlugin = require('webpack-shell-plugin');
mix.webpackConfig({
    plugins:
        [
            new WebpackShellPlugin({onBuildStart:['php artisan lang:js public/assets/pages/scripts/financial/lang.dist.js'], onBuildEnd:[]}),
        ]
});

let resources = "resources/assets/js/financial/";
let publicPath = "public/assets/pages/scripts/financial/";
let suffix = ".min.js";

mix.copy(resources + "identicon/pnglib.js", publicPath + "pnglib" + suffix)
    .copy(resources + "identicon/identicon.js", publicPath + "identicon" + suffix)
    .copy(resources + "pdfviewer/pdfobject.min.js", publicPath + "pdfobject" + suffix)
    .copy(resources + "loading/loading.js", publicPath + "loading" + suffix)
    .styles(resources + "loading/loading.css", publicPath + "loading.min.css")
    .js("resources/assets/js/app.js", "public/js");

/*
 |--------------------------------------------------------------------------
 | End Financial Assets Management
 |--------------------------------------------------------------------------
 |
 */


/*
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
*/