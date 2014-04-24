var gulp = require('gulp');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var prefix = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var imagemin = require('gulp-imagemin');
var concat = require('gulp-concat');

var adminUrl = './app/assets/admin';
var frontendUrl = './app/assets/frontend'

var adminCss = [adminUrl + '/css/*.scss', adminUrl + '/css/**/*.scss'];
var frontendCss = [frontendUrl + '/css/*.scss', frontendUrl + '/css/**/*.scss'];

var adminJs = [adminUrl + '/js/*.js'];
var frontendJs = [frontendUrl + '/js/*.js'];

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

/*gulp.task('images', function() {
  gulp.src(imagePath)
    .pipe(imagemin())
    .pipe(gulp.dest('./public/images/'));
});*/

gulp.task('watch', function() {
  gulp.watch(adminCss, ['adminCss']);
  gulp.watch(frontendCss, ['frontendCss']);
  gulp.watch(adminJs, ['adminJs']);
  gulp.watch(frontendJs, ['frontendJs']);
});

gulp.task('default', ['adminCss', 'frontendCss', 'adminJs', 'frontendJs', 'watch']);