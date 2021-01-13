const mix = require('laravel-mix');

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

mix.js('resources/js/dashboard.js', 'public/js')
    .js('resources/js/app.js', 'public/js')
    .css('node_modules/vue-pnotify/dist/vue-pnotify.css', '/public/library/vue-pnotify/vue-pnotify.css')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .version()
    .browserSync('http://desafio.test');
