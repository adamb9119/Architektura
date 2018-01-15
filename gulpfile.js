var gulp = require('gulp');
var gutil = require("gulp-util");
var cssmin = require('gulp-cssmin');
var rename = require('gulp-rename');
var minify = require('gulp-minify');
var concat = require('gulp-concat');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var webpack = require("webpack");
var autoprefixer = require('gulp-autoprefixer');

var browserSync = require("browser-sync").create();
 
gulp.task('sass', function() {
    return gulp.src("./public/assets/scss/**/*.scss")
        .pipe(sass())
        .pipe(gulp.dest("./public/assets/css/"));
});

// Compile sass into CSS & auto-inject into browsers
gulp.task('browser-sass', function() {
    return gulp.src("./public/assets/dist/scss/**/*.scss")
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write()) 
        .pipe(gulp.dest("./dist/css"))
        .pipe(browserSync.stream());
});

gulp.task('serve', function() {
    browserSync.init({
        proxy: "projekt5.local"
    });
    
    gulp.watch("./public/assets/scss/**/*.scss", ['browser-sass']);
});