var gulp = require('gulp');
var sass = require('gulp-sass');
var prefix = require('gulp-autoprefixer');
var rename = require('gulp-rename');

var adminUrl = './app/assets/admin';
var frontendUrl = './app/assets/frontend';
var adminCss = [adminUrl + '/css/app.scss'];
var frontendCss = [frontendUrl + '/css/app.scss'];

gulp.task('adminCss', function() {
  gulp.src(adminCss)
    .pipe(sass({
      errLogToConsole: true,
      outputStyle: 'compressed'
    }))
    .pipe(prefix("last 4 version", "ie 8"))
    .pipe(rename('app.min.css'))
    .pipe(gulp.dest('./public/assets/admin/css/'));
});

gulp.task('frontendCss', function() {
  gulp.src(frontendCss)
    .pipe(sass({
      errLogToConsole: true,
      outputStyle: 'compressed'
    }))
    .pipe(prefix("last 4 version", "ie 8"))
    .pipe(rename('app.min.css'))
    .pipe(gulp.dest('./public/assets/frontend/css/'));
});