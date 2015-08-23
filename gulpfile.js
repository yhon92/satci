'use-stric';
var gulp       = require('gulp');
var elixir     = require('laravel-elixir');
var livereload = require('gulp-livereload');

elixir.config.assetsPath = 'front_dev';

//console.log(elixir.config.assetsPath);
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

/**
 * Logic for LiveReload to work properly on watch task.
 */
gulp.on('task_start', function (e) {
  // only start LiveReload server if task is 'watch'
  if (e.task === 'watch') {
    livereload.listen();
  }
});
gulp.task('watch-lr-css', function () {
  // notify a CSS change, so that livereload can update it without a page refresh
  livereload.changed('app.css');
});
gulp.task('watch-lr', function () {
  // notify any other changes, so that livereload can refresh the page
  livereload.changed('app.js');
});

elixir(function(mix) {
  /*mix.scripts(['/libs/jquery.min.js', 
               '/libs/bootstrap.min.js', 
               '/libs/angular.min.js', 
               //'/libs/angular-route.min.js', 
               '/libs/angular-ui-router.min.js', 
               '/libs/angular-resource.min.js', 
               '/libs/angular-animate.min.js', 
               '/libs/ui-bootstrap.min.js', 
               '/libs/smart-table.min.js', 
               '/libs/satellizer.min.js', 
               '/libs/loading-bar.min.js', 
               // '', 
              ], './public/js/libs.js')*/

  mix.babel(['app.js', 
               '/filters/*.js', 
               '/controllers/*.js', 
               '/directives/*.js', 
               '/services/*.js', 
               // '//*.js', 
               // '//*.js', 
               '*.js', 
              ], './public/js/app.js')
     //.scripts(['app.js', '/**/*.js'], './public/js/app.js')
     //.scripts(['app.js', '/**/*.js'], './public/js/app.js')
});

gulp.task('speak', function() {
    var message = 'Tea...Earl Grey...Hot';

    gulp.src('').pipe(shell('say ' + message));
});

elixir(function(mix) {
    // mix.task('speak');
});

elixir(function(mix) {
    // mix.task('speak', 'app/**/*.php');
});
