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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.scripts(
    [
        'node_modules/datatables.net/js/jquery.dataTables.js',
        'node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js',
        'resources/js/tools.js',
        'resources/js/typeahead.jquery.js',
        'resources/js/ability_manager.js',
        'resources/js/monster_manager.js',
        'resources/js/encounter_manager.js',
        'resources/js/jquery.tocify.js',
],
'public/js/dnd-tools.js'
);

