'use strict';

let gulp = require('gulp'),
    browserSync = require('browser-sync').create(),
    sass =  require("gulp-sass")(require('sass'));

let siteDir = '../../';

gulp.task("scss", function () {
    return gulp.src(
            'styles/*.scss',
            '!styles/woocommerce/{woocommerce/*.scss}'
        )
        .pipe(sass.sync({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(gulp.dest('../css/'))
        .pipe(browserSync.reload({ stream: true }));
});

gulp.task("watch", function () {
    gulp.watch( ['styles/*.scss', 'styles/**/*.scss'], gulp.series('scss', 'woo'));
});

gulp.task('woo', function() {
    return gulp.src('styles/woocommerce/*.scss')
    .pipe(sass.sync({outputStyle: 'expanded'}).on('error', sass.logError))
    .pipe(gulp.dest('../../woocommerce/assets/css'))
    .pipe(browserSync.reload({ stream: true }));
});

gulp.task('browser-sync', function () {
    browserSync.init({
        proxy: {
            target: "http://dtc.my"
        }
    });

    gulp.watch(siteDir + "**/*.php").on('change', browserSync.reload);
    gulp.watch(siteDir + "**/*.scss").on('change', browserSync.reload);
    gulp.watch(siteDir + "**/*.js").on('change', browserSync.reload);
});

gulp.task('default', gulp.parallel('watch', 'browser-sync'));