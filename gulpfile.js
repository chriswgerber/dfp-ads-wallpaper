/*
 * Gulpfile
 */
var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    concat = require('gulp-concat'),
    jshint = require('gulp-jshint'),
    include = require('gulp-include'),
    stylish = require('jshint-stylish'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    js_filename = './assets/js/dfp-wallpaper-ad.js';
// Lint Task
gulp.task('lint', function() {
  return gulp.src(js_filename)
    .pipe(jshint('.jshintrc'))
    .pipe(jshint.reporter('jshint-stylish'));
});
// Uglify Registration Scripts
gulp.task('scripts', function() {
  return gulp.src(js_filename)
    .pipe(rename({
        dirname: './assets/js/',
        suffix: '.min',
        extname: '.js'
      }))
    .pipe(uglify())
    .pipe(gulp.dest('./'));
});
// Default gulp
gulp.task('default', ['lint', 'scripts'], function() {});
