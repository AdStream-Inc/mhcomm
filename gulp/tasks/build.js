var gulp = require('gulp');

gulp.task('frontend', ['frontendCss', 'frontendJs', 'frontendImages', 'watchFrontend']);
gulp.task('admin', ['adminCss', 'adminJs', 'adminImages', 'watchAdmin']);
gulp.task('default', ['adminCss', 'frontendCss', 'adminJs', 'frontendJs', 'adminImages', 'frontendImages', 'watchAdmin', 'watchFrontend']);