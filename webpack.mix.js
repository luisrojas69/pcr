const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
	
	.scripts([
 	'resources/js/external/template/jquery.min.js',
 	'resources/js/external/template/bootstrap.bundle.min.js',
 	'resources/js/external/template/cookie.js',
 	'resources/js/external/template/jquery.scrollbar.min.js',
 	'resources/js/external/template/jquery-scrollLock.min.js',
 	'resources/js/internal/miapp.js',
 	],
	'public/js/gbapp.js')
	
	.scripts([
	'resources/js/external/datatables/jquery.dataTables.min.js', // Datatable
 	'resources/js/external/datatables/dataTables.bootstrap4.min.js', // Datatable
 	'resources/js/external/datatables/dataTables.buttons.min.js', // Buttons Datatable
 	'resources/js/external/datatables/buttons.bootstrap4.min.js', // Buttons Datatable
 	'resources/js/external/datatables/buttons.html5.min.js', // Buttons Datatable
 	'resources/js/external/datatables/buttons.flash.min.js', // Buttons Datatable
 	'resources/js/external/datatables/buttons.print.min.js', // Buttons Datatable
 	'resources/js/external/datatables/dataTables.select.min.js', // Datatable Select
 	], 'public/js/datatables.js')
	
	.sass('resources/sass/app.scss', 'public/css')

	.styles([
 	'resources/css/template/nucleo.css',
 	'resources/css/template/all.min.css',
 	'resources/css/template/argon.css',
 	],
 	'public/css/gbapp.css')

 	.styles([
 	'resources/css/datatables/dataTables.bootstrap4.min.css', //Datatable
 	'resources/css/datatables/buttons.bootstrap4.min.css', // Buttons Datatable
 	'resources/css/datatables/select.bootstrap4.min.css' // Buttons Datatable
 	],
 	'public/css/datatables.css');
   
