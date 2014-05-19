var gulp = require('gulp');
var imagemin = require('gulp-imagemin');
var changed = require('gulp-changed');

var adminUrl = './app/assets/admin';
var frontendUrl = './app/assets/frontend';
var adminImages = [adminUrl + '/images/**'];
var frontendImages = [frontendUrl + '/images/**'];

gulp.task('frontendImages', function() {
  gulp.src(frontendImages)
    .pipe(changed('./public/assets/frontend/images/'))
    .pipe(imagemin())
    .pipe(gulp.dest('./public/assets/frontend/images/'));
});

gulp.task('adminImages', function() {
  gulp.src(adminImages)
    .pipe(changed('./public/assets/admin/images/'))
    .pipe(imagemin())
    .pipe(gulp.dest('./public/assets/admin/images/'));
});