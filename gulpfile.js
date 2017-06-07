var gulp = require('gulp'),
 sass = require('gulp-sass'),
 concat = require('gulp-concat'),
 uglify = require('gulp-uglify'),
 cssnano = require('gulp-cssnano');

// ADMIN

var adminCss = [
    // BEGIN GLOBAL MANDATORY STYLES
    './web/assets/admin/global/plugins/font-awesome/css/font-awesome.min.css',
    './web/assets/admin/global/plugins/simple-line-icons/simple-line-icons.min.css',
    './web/assets/admin/global/plugins/bootstrap/css/bootstrap.css',
    './web/assets/admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',

    // BEGIN PAGE LEVEL PLUGINS
    './web/assets/admin/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css',
    './web/assets/admin/global/plugins/morris/morris.css',
    './web/assets/admin/global/plugins/fullcalendar/fullcalendar.min.css',
    './web/assets/admin/global/plugins/jqvmap/jqvmap/jqvmap.css',
    './web/assets/admin/global/plugins/bootstrap-sweetalert/sweetalert.css',
    './web/assets/admin/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css',
    './web/assets/admin/global/plugins/bootstrap-summernote/summernote.css',

    // BEGIN THEME GLOBAL STYLES
    './web/assets/admin/global/css/components-rounded.css',
    './web/assets/admin/global/css/plugins.min.css',
    './web/assets/admin/global/plugins/bootstrap-toastr/toastr.min.css',

    // BEGIN THEME LAYOUT STYLES
    './web/assets/admin/layout/css/layout.min.css',
    './web/assets/admin/layout/css/themes/darkblue.min.css',
    './web/assets/admin/layout/css/custom.min.css',
    './web/assets/admin/custom.css',
];

var adminJs = [
    // BEGIN CORE PLUGINS
    './web/assets/admin/global/plugins/jquery.min.js',
    './web/assets/admin/global/plugins/bootstrap/js/bootstrap.js',
    './web/assets/admin/global/plugins/js.cookie.min.js',
    './web/assets/admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',

    // BEGIN PAGE LEVEL PLUGINS
    './web/assets/admin/global/plugins/moment.min.js',
    './web/assets/admin/global/plugins/morris/morris.min.js',
    './web/assets/admin/global/plugins/morris/raphael-min.js',
    './web/assets/admin/global/plugins/counterup/jquery.waypoints.min.js',
    './web/assets/admin/global/plugins/counterup/jquery.counterup.min.js',
    './web/assets/admin/global/plugins/bootstrap-markdown/lib/markdown.js',
    './web/assets/admin/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js',
    './web/assets/admin/global/plugins/jquery-repeater/jquery.repeater.js',

    // BEGIN THEME GLOBAL SCRIPTS
    './web/assets/admin/global/scripts/app.min.js',

    // BEGIN PAGE LEVEL SCRIPTS
    './web/assets/admin/pages/scripts/dashboard.min.js',
    './web/assets/admin/global/plugins/bootstrap-growl/jquery.bootstrap-growl.min.js',
    './web/assets/admin/global/plugins/bootstrap-sweetalert/sweetalert.min.js',
    './web/assets/admin/pages/scripts/components-editors.js',
    './web/assets/admin/global/plugins/bootstrap-summernote/summernote.min.js',
    './web/assets/admin/global/plugins/bootstrap-toastr/toastr.min.js',
    './web/assets/admin/pages/scripts/form-repeater.js',

    // BEGIN THEME LAYOUT SCRIPTS
    './web/assets/admin/layout/scripts/layout.min.js',
    './web/assets/admin/layout/scripts/demo.min.js',

    './web/assets/admin/main.js',
];

gulp.task('adminCss', function () {
    return gulp.src(adminCss)
        .pipe(concat("style.min.css"))
        //.pipe(cssnano())
        .pipe(gulp.dest('./web/assets/admin'));
});

gulp.task('adminJs', function () {
    return gulp.src(adminJs)
        .pipe(concat("script.min.js"))
        //.pipe(uglify())
        .pipe(gulp.dest('./web/assets/admin'));
});

gulp.task('adminCss:watch', function () {
    gulp.watch('./web/assets/admin/custom.css', ['adminCss']);
});

gulp.task('adminJs:watch', function () {
    gulp.watch('./web/assets/admin/main.js', ['adminJs']);
});

// SITE

var siteCss = [
    './web/assets/site/css/style.css'
];

gulp.task('sass', function () {
    return gulp.src('./web/assets/site/sass/style.scss')
               .pipe(sass.sync().on('error', sass.logError))
               .pipe(gulp.dest('./web/assets/site/css'));
});

gulp.task('sass:watch', function () {
    gulp.watch('./web/assets/site/sass/**/*.scss', ['siteCss']);
});

gulp.task('siteCss', ['sass'], function () {
  return gulp.src(siteCss)
             .pipe(concat("style.min.css"))
             //.pipe(cssnano())
             .pipe(gulp.dest('./web/assets/site/css'));
});

gulp.task('default', [
    'siteCss',
    'sass:watch',
    'adminCss',
    'adminJs',
    'adminCss:watch',
    'adminJs:watch',
]);
