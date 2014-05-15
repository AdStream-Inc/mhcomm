var gulp = require('gulp');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var prefix = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var imagemin = require('gulp-imagemin');
var concat = require('gulp-concat');

var adminUrl = './app/assets/admin';
var frontendUrl = './app/assets/frontend'

var adminCss = [adminUrl + '/css/app.scss'];
var frontendCss = [frontendUrl + '/css/app.scss'];

var adminJs = [adminUrl + '/js/lib/*.js', adminUrl + '/js/shared/*.js', adminUrl + '/js/**/*.js'];
var frontendJs = [frontendUrl + '/js/lib/*.js', frontendUrl + '/js/shared/*.js', frontendUrl + '/js/**/*.js'];

var adminImages = [adminUrl + '/images/**.*'];
var frontendImages = [frontendUrl + '/images/**'];

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

gulp.task('adminJs', function() {
  gulp.src(adminJs)
    .pipe(concat('app.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./public/assets/admin/js/'));
});

gulp.task('frontendJs', function() {
  gulp.src(frontendJs)
    .pipe(concat('app.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./public/assets/frontend/js/'));
});

gulp.task('frontendImages', function() {
  gulp.src(frontendImages)
    .pipe(imagemin())
    .pipe(gulp.dest('./public/assets/frontend/images/'));
});

gulp.task('adminImages', function() {
  gulp.src(adminImages)
    .pipe(imagemin())
    .pipe(gulp.dest('./public/assets/admin/images/'));
});

gulp.task('watch', function() {
  gulp.watch([adminCss, adminUrl + '/css/**/*.scss'], ['adminCss']);
  gulp.watch([frontendCss, frontendUrl + '/css/**/*.scss'], ['frontendCss']);
  gulp.watch(adminJs, ['adminJs']);
  gulp.watch(frontendJs, ['frontendJs']);
});

gulp.task('watch-admin', function() {
  gulp.watch([adminCss, adminUrl + '/css/**/*.scss'], ['adminCss']);
  gulp.watch(adminJs, ['adminJs']);
});

gulp.task('watch-frontend', function() {
  gulp.watch([frontendCss, frontendUrl + '/css/**/*.scss'], ['frontendCss']);
  gulp.watch(frontendJs, ['frontendJs']);
});

gulp.task('frontend', ['frontendCss', 'frontendJs', 'frontendImages', 'watch-frontend']);
gulp.task('admin', ['adminCss', 'adminJs', 'adminImages', 'watch-admin']);
gulp.task('default', ['adminCss', 'frontendCss', 'adminJs', 'frontendJs', 'adminImages', 'frontendImages', 'watch']);