'use-stric';

/*
* Posibles Paquetes:
* -gulp-uglify
* -gulp-concat
* -gulp-sourcemaps
*
*
*
*
*
*/
var gulp          = require('gulp'),
    stylus        = require('gulp-stylus'),
    nib           = require('nib'),
    minifyCSS     = require('gulp-minify-css'),
    livereload    = require('gulp-livereload'),
    jshint        = require('gulp-jshint'),
    concat        = require('gulp-concat'),
    uglify        = require('gulp-uglify'),

    elixir        = require('laravel-elixir')

elixir.config.assetsPath = 'front_dev';

gulp.task('css', function() {
  gulp.src('./front_dev/styl/app.styl')
  .pipe(stylus({
      compress: true,
      //use: nib()
    }))
  .pipe(gulp.dest('./public/css/'))
  //.pipe(minifyCSS())
  .pipe(livereload());

});

gulp.task('jshint', function() {
  gulp.src(['./front_dev/js/**/*.js', '!./front_dev/js/**/*.min.js'])
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
});

gulp.task('js-libs', function(){
  gulp.src('./front_dev/js/libs/**/*.js')
    .pipe(concat('app.js'))
    //.pipe(uglify())
    .pipe(gulp.dest('./public/js/'))
    .pipe(livereload());
});

gulp.task('js-app', function(){
  gulp.src('./front_dev/js/app/**/*.js')
    .pipe(concat('app.js'))
    //.pipe(uglify())
    .pipe(gulp.dest('./public/js/'))
    .pipe(livereload());
});

gulp.task('watch', function() {
  livereload.listen();
  //gulp.watch(['./app/**/*.html'], ['html']);
  gulp.watch(['./front_dev/styl/**/*.styl'], ['css']);
  gulp.watch(['./front_dev/js/app/**/*.js'], ['js-app']);
  //gulp.watch(['./front_dev/js/app/**/*.js'], ['jshint', 'js-app']);
  //gulp.watch(['./app/js/**/*.js'], ['jshint']);
  //gulp.watch(['./app/stylus/**/*.styl'], ['css', 'inject']);
  //gulp.watch(['./app/js/**/*.js', './Gulpfile.js'], ['jshint', 'inject']);
});

gulp.task('default', ['watch']);