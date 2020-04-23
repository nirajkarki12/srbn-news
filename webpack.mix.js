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
// mix.copyDirectory('node_modules/font-awesome/fonts', 'public/fonts/font-awesome');

mix.js([
      'resources/js/app.js', 
      ], 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles([
      'public/css/app.css', 
      'resources/sass/style.css'
      ], 'public/css/app.css')
    ;

mix.setPublicPath('public');
mix.setResourceRoot('../');

