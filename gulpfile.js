var elixir = require('laravel-elixir');

elixir(function(mix) {

    //mix.styles([
    //    'bootstrap/dist/css/bootstrap.min.css',
    //    'metisMenu/dist/metisMenu.min.css',
    //    'startbootstrap-sb-admin-2/dist/css/sb-admin-2.css',
    //    'font-awesome/css/font-awesome.min.css',
    //    'sweetalert/dist/sweetalert.css',
    //], 'public/css/vendor.css', 'resources/assets/vendor/');
    //
    //mix.scripts([
    //    'jquery/dist/jquery.min.js',
    //    'bootstrap/dist/js/bootstrap.min.js',
    //    'metisMenu/dist/metisMenu.min.js',
    //    'startbootstrap-sb-admin-2/dist/js/sb-admin-2.js',
    //    'sweetalert/dist/sweetalert.min.js',
    //    '../laradmin/js/swal.js',
    //], 'public/js/vendor.js', 'resources/assets/vendor/');
    //
    //
    //mix.copy('resources/assets/vendor/font-awesome/fonts', 'public/fonts')

    mix.styles([
        'AdminLTE/bootstrap/css/bootstrap.min.css',
        'font-awesome/css/font-awesome.min.css',
        'Ionicons/css/ionicons.min.css',
        'AdminLTE/dist/css/AdminLTE.min.css',
        'AdminLTE/dist/css/skins/_all-skins.min.css',
        'AdminLTE/plugins/iCheck/square/_all.css',
        'sweetalert/dist/sweetalert.css',
    ], 'public/css/vendor.css', 'resources/assets/vendor/');

    mix.scripts([
        'AdminLTE/plugins/jQuery/jQuery-2.2.0.min.js',
        '../laradmin/js/options.js',
        'AdminLTE/bootstrap/js/bootstrap.min.js',
        'AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js',
        'AdminLTE/plugins/fastclick/fastclick.js',
        'AdminLTE/dist/js/app.min.js',
        'AdminLTE/plugins/iCheck/iCheck.min.js',
        'sweetalert/dist/sweetalert.min.js',
        '../laradmin/js/swal.js'
    ], 'public/js/vendor.js', 'resources/assets/vendor/');

    mix.copy('resources/assets/vendor/font-awesome/fonts', 'public/fonts');
    mix.copy('resources/assets/vendor/Ionicons/fonts', 'public/fonts');
    mix.copy('resources/assets/vendor/AdminLTE/bootstrap/fonts', 'public/fonts');
    mix.copy('resources/assets/vendor/AdminLTE/plugins/iCheck/square/*.png', 'public/css');

});
