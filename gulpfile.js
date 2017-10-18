const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
	mix.sass('app.scss')
	   .webpack('app.js');
});


/*---------------------------------------*/
elixir(function(mix) {
	mix.styles([
		'frontend/reset.css',
		'frontend/superfish.css',
		'frontend/prettyPhoto.css',
		'frontend/jquery.qtip.css',
		'frontend/style.css',
		'frontend/menu_styles.css',
		'frontend/animations.css',
		'frontend/responsive.css',
		'frontend/odometer-theme-default.css',
		'frontend/customize.css'
	], 'public/frontend/css/all.css');
});

elixir(function(mix) {
    mix.copy('resources/assets/css/frontend/images', 'public/frontend/images');
});

elixir(function(mix) {
	mix.scripts([
		'frontend/jquery-1.12.4.min.js',
		'frontend/jquery-migrate-1.4.1.min.js',
		'frontend/jquery.ba-bbq.min.js',
		'frontend/jquery-ui-1.11.1.custom.min.js',
		'frontend/jquery.easing.1.3.js',
		'frontend/jquery.carouFredSel-6.2.1.min.js',
		//'frontend/jquery.carouFredSel-6.2.1-packed.js',
		'frontend/jquery.touchSwipe.min.js',
		'frontend/jquery.transit.min.js',
		'frontend/jquery.sliderControl.js',
		'frontend/jquery.timeago.js',
		'frontend/jquery.hint.js',
		'frontend/jquery.prettyPhoto.js',
		'frontend/jquery.qtip.min.js',
		'frontend/jquery.blockUI.js',
		'frontend/main.js',
		'frontend/odometer.min.js'
	], 'public/frontend/js/all.js');
});