var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

var adminUrl = './app/assets/admin';
var frontendUrl = './app/assets/frontend';
var adminJs = [adminUrl + '/js/lib/*.js', adminUrl + '/js/shared/*.js', adminUrl + '/js/**/*.js'];
var frontendJs = [frontendUrl + '/js/shared/*.js', frontendUrl + '/js/**/*.js'];

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