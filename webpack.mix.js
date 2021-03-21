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

mix.scripts([
    'node_modules/admin-lte/plugins/jquery/jquery.js',
    'node_modules/admin-lte/plugins/bootstrap/js/bootstrap.js',
    'node_modules/admin-lte/plugins/popper/umd/popper.js',
    'node_modules/admin-lte/dist/js/adminlte.js',
    'node_modules/admin-lte/plugins/select2/js/i18n/hu.js',
    'node_modules/admin-lte/plugins/select2/js/select2.js',
    'resources/js/admin/admin.js'
], 'public/js/admin.js')
   /* .scripts([
        'vendor/japonline/laravel-ckeditor/ckeditor.js'
    ], 'public/js/admin/editor.js')*/
    //.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .copy('node_modules/admin-lte/plugins/fontawesome-free/webfonts', 'public/fonts');
