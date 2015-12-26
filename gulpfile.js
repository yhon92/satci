'use-stric';
var gulp          = require('gulp'),
//    concat        = require('gulp-concat'),
//    jade          = require('gulp-jade'),
//    jshint        = require('gulp-jshint'),
    livereload    = require('gulp-livereload'),
//    minifyCSS     = require('gulp-minify-css'),
    notify        = require('gulp-notify'),
//    plumber       = require('gulp-plumber'),
    stylus        = require('gulp-stylus'),
//    uglify        = require('gulp-uglify'),
    babelify      = require('babelify'),
    browserify    = require('browserify'),
    nib           = require('nib'),
//    watchify      = require('watchify'),
//    buffer        = require('vinyl-buffer'),
    source        = require('vinyl-source-stream');
//    transform     = require('vinyl-transform');

    //elixir        = require('laravel-elixir')

//elixir.config.assetsPath = 'front_dev';

var paths = {
  src: {
    js    : './front_dev/js/app.js',
    css   : './front_dev/styl/app.styl',
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
  //.pipe(minifyCSS())
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

gulp.task('watch', function() {
  livereload.listen();
  gulp.watch(paths.src.html, ['html']);
  gulp.watch(['./front_dev/styl/**/*.styl'], ['css']);
  gulp.watch(['./front_dev/js/**/*.js'], ['js']);
  //gulp.watch(['./front_dev/js/app/**/*.js'], ['jshint', 'js-app']);
  //gulp.watch(['./app/js/**/*.js'], ['jshint']);
  //gulp.watch(['./app/stylus/**/*.styl'], ['css', 'inject']);
  //gulp.watch(['./app/js/**/*.js', './Gulpfile.js'], ['jshint', 'inject']);
});

gulp.task('default', ['watch',]);
