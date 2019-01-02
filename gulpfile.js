'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');

var browserSync = require('browser-sync').create();
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "etec.local"
    });
});

gulp.task('sass', function () {
 return gulp.src('lib/sass/**/*.scss')
  .pipe(sourcemaps.init())
  .pipe(sass().on('error', sass.logError))
  .pipe(sourcemaps.write('./'))
  .pipe(gulp.dest('lib/css'))
  .pipe(browserSync.reload({stream: true}));
});

gulp.task('watch', ['browser-sync'], function () {
    gulp.watch('lib/sass/**/*.scss', ['sass']);
});

// Default task
gulp.task('default', function () {
  gulp.start('sass', 'watch') // , 'browser-sync'
})