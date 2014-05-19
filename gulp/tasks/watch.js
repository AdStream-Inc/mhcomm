var gulp = require('gulp');

var adminUrl = './app/assets/admin';
var frontendUrl = './app/assets/frontend';
var adminCss = [adminUrl + '/css/app.scss'];
var frontendCss = [frontendUrl + '/css/app.scss'];
var adminJs = [adminUrl + '/js/lib/*.js', adminUrl + '/js/shared/*.js', adminUrl + '/js/**/*.js'];
var frontendJs = [frontendUrl + '/js/lib/*.js', frontendUrl + '/js/shared/*.js', frontendUrl + '/js/**/*.js'];
var adminImages = [adminUrl + '/images/**'];
var frontendImages = [frontendUrl + '/images/**'];

gulp.task('watchAdmin', function() {
  gulp.watch([adminCss, adminUrl + '/css/**/*.scss'], ['adminCss']);
  gulp.watch(adminJs, ['adminJs']);
  gulp.watch(adminImages, ['adminImages']);
});

gulp.task('watchFrontend', function() {
  gulp.watch([frontendCss, frontendUrl + '/css/**/*.scss'], ['frontendCss']);
  gulp.watch(frontendJs, ['frontendJs']);
  gulp.watch(frontendImages, ['frontendImages']);
});