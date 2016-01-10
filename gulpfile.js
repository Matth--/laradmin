var elixir = require('laravel-elixir');

elixir(function(mix) {

    mix.styles([
        'bootstrap/dist/css/bootstrap.min.css',
        'metisMenu/dist/metisMenu.min.css',
        'startbootstrap-sb-admin-2/dist/css/sb-admin-2.css',
        'font-awesome/css/font-awesome.min.css',
        'sweetalert/dist/sweetalert.css',
    ], 'public/css/vendor.css', 'resources/assets/vendor/');

    mix.scripts([
        'jquery/dist/jquery.min.js',
        'bootstrap/dist/js/bootstrap.min.js',
        'metisMenu/dist/metisMenu.min.js',
        'startbootstrap-sb-admin-2/dist/js/sb-admin-2.js',
        'sweetalert/dist/sweetalert.min.js',
        '../laradmin/js/swal.js',
    ], 'public/js/vendor.js', 'resources/assets/vendor/');


    mix.copy('resources/assets/vendor/font-awesome/fonts', 'public/fonts')
});
