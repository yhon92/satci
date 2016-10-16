'use-stric';

var gulp = require('gulp');
// concat = require('gulp-concat'),
// jade = require('gulp-jade'),
// jshint = require('gulp-jshint'),
var livereload = require('gulp-livereload');
// var cssnano = require('gulp-cssnano');
var notify = require('gulp-notify');
// plumber = require('gulp-plumber'),
var stylus = require('gulp-stylus');
var uglify = require('gulp-uglify');
var babelify = require('babelify');
var browserify = require('browserify');
var nib = require('nib');
// watchify = require('watchify'),
var buffer = require('vinyl-buffer');
var source = require('vinyl-source-stream');
// transform = require('vinyl-transform');
var sourcemaps  = require('gulp-sourcemaps');
var ngAnnotate = require('gulp-ng-annotate');
var Elixir = require('laravel-elixir');

require('laravel-elixir-stylus');
// require('laravel-elixir-livereload');

var $ = Elixir.Plugins;
var Task = Elixir.Task;

Elixir.config.assetsPath = 'front_dev';

var paths = {
  src: {
    js    : './front_dev/js/app.js',
    css   : ['./front_dev/stylus/app.styl',
            './front_dev/stylus/pdf.styl'],
    html  : ['./public/template/**/*.html', 
            './resources/views/**/*.html', 
            './resources/views/**/*.blade.php']
  },
  dest: {
    js    : './public/js/',
    css   : './public/css/',
    //html  : './client/build/html/'
  }
}

gulp.task('html', function() {
  gulp.src(paths.src.html)
  .pipe(livereload())
  //.pipe(notify("Templates Completo!"))
});

gulp.task('css', function() {
  gulp.src(paths.src.css)
  .pipe(stylus({
      compress: true,
      use: nib()
    }))
  .on('error', function(error){
    return notify().write(error);
  })
  .pipe(gulp.dest(paths.dest.css))
  //.pipe(cssnano())
  .pipe(livereload())
  .pipe(notify("CSS Completo!"))
});

gulp.task('jshint', function() {
  gulp.src(['./front_dev/js/**/*.js', '!./front_dev/js/**/*.min.js'])
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
});

gulp.task('js', function(){
  return browserify({
    entries: paths.src.js, //punto de entrada js
    transform: [ ['babelify', { "presets": ["es2015"] } ] ] //transformaciones
  })
  .bundle()
  .on('error', function(error){
    notify().write(error);
    this.emit('end')
  })
  .pipe(source('app.js'))   // archivo destino
  //.pipe(buffer())
  //.pipe(uglify())
  .pipe(gulp.dest(paths.dest.js)) // en dónde va a estar el archivo destino
  .pipe(livereload())
  .pipe(notify("JS Completo!"));
  this.emit('end');
});

gulp.task('dev', function() {
  livereload.listen();
  gulp.watch(paths.src.html, ['html']);
  gulp.watch(['./front_dev/stylus/**/*.styl'], ['css']);
  gulp.watch(['./front_dev/js/**/*.js'], ['js']);
  //gulp.watch(['./front_dev/js/app/**/*.js'], ['jshint', 'js-app']);
  //gulp.watch(['./app/js/**/*.js'], ['jshint']);
  //gulp.watch(['./app/stylus/**/*.styl'], ['css', 'inject']);
  //gulp.watch(['./app/js/**/*.js', './Gulpfile.js'], ['jshint', 'inject']);
});

Elixir.extend('browserifyAngular', function(opts) {
  new Task('browserifyAngular', function() {
  var entries = opts.src;
  var dist    = opts.dist;

  this.log(opts.src, opts.dist);

   return browserify({          
      entries: entries,
      transform: [ ['babelify', { "presets": ["es2015"] } ] ] //transformaciones
          //debug: true
    })//.transform(babelify)
      .bundle()
    .pipe(source('app.js'))
    .pipe(buffer())
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe($.if(Elixir.config.production,  ngAnnotate()))
    .pipe($.if(Elixir.config.production, $.uglify()))
    .on('error', function(e) {
      new Elixir.Notification().error(e, 'BrowserifyAngular Failed!');
      this.emit('end');
     })
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(dist))
    .pipe(new Elixir.Notification('BrowserifyAngular Compiled!'));
  });
});

Elixir(function(mix) {
  mix.stylus(['app.styl'], null, {use: [nib()] })
  mix.browserifyAngular({src: paths.src.js, dist: paths.dest.js})
  mix.version(['public/js/app.js', 'public/css/app.css', 'public/css/pdf.css'])
  //mix.livereload(['public/build/js/*', 'public/css/app.css'])
});

//gulp.task('default', ['watch',]);
