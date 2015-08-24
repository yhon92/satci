'use-stric';
var gulp          = require('gulp'),
    jade          = require('gulp-jade'),
    stylus        = require('gulp-stylus'),
    jshint        = require('gulp-jshint'),
    concat        = require('gulp-concat'),
    uglify        = require('gulp-uglify'),
    minifyCSS     = require('gulp-minify-css'),
    livereload    = require('gulp-livereload'),
    nib           = require('nib'),
    babelify      = require('babelify'),
    browserify    = require('browserify'),
    buffer        = require('vinyl-buffer'),
    source        = require('vinyl-source-stream')

    //elixir        = require('laravel-elixir')

//elixir.config.assetsPath = 'front_dev';

var paths = {
  src: {
    js    : './front_dev/js/app.js',
    css   : './front_dev/styl/app.styl',
    html  : ['./public/templates/**/*.html', 
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
  .pipe(livereload());
});

gulp.task('css', function() {
  gulp.src(paths.src.css)
  .pipe(stylus({
      compress: true,
      //use: nib()
    }))
  .pipe(gulp.dest(paths.dest.css))
  //.pipe(minifyCSS())
  .pipe(livereload());

});

gulp.task('jshint', function() {
  gulp.src(['./front_dev/js/**/*.js', '!./front_dev/js/**/*.min.js'])
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
});

gulp.task('js-app', function(){
  return browserify({
    entries: paths.src.js, //punto de entrada js
    transform: [ babelify ] //transformaciones
  })
  .bundle()
  .pipe(source('app.js')) // archivo destino
  //.pipe(buffer())
  //.pipe(uglify())
  .pipe(gulp.dest(paths.dest.js)) // en dónde va a estar el archivo destino
  .pipe(livereload());
});

gulp.task('watch', function() {
  livereload.listen();
  gulp.watch(paths.src.html, ['html']);
  gulp.watch(['./front_dev/styl/**/*.styl'], ['css']);
  gulp.watch(['./front_dev/js/**/*.js'], ['js-app']);
  //gulp.watch(['./front_dev/js/app/**/*.js'], ['jshint', 'js-app']);
  //gulp.watch(['./app/js/**/*.js'], ['jshint']);
  //gulp.watch(['./app/stylus/**/*.styl'], ['css', 'inject']);
  //gulp.watch(['./app/js/**/*.js', './Gulpfile.js'], ['jshint', 'inject']);
});

gulp.task('default', ['watch']);
