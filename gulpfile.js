const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.styles([
            "bootstrap.min.css",
            "bootstrap-theme.min.css"],
            "public/css/app.css", "resources/assets/custom-bootstrap-v3.3.7/css")
       .scripts([
            './vendor/components/jquery/jquery.min.js',
            './resources/assets/custom-bootstrap-v3.3.7/js/bootstrap.min.js',
            'scripts.js'])
        .version([
            'js/all.js',
            'css/app.css',
        ]);
});
