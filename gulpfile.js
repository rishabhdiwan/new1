// const gulp = require('gulp');
// const sass = require('gulp-sass');
// const minify = require('gulp-clean-css');

// async function compilescss () {
//     gulp.src('./scss/*.scss')
//         .pipe(sass())
//         .pipe(minify())
//         .pipe(gulp.dest('./assets/css'))
// };

// gulp.task('watch',function(){
//     gulp.watch('./scss/*.scss', compilescss)
// });
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const minify = require('gulp-clean-css');
const concat = require('gulp-concat');

const { src, series, parallel, dest, watch } = require('gulp');

function style() {
  return src('./scss/**/*.scss')
  .pipe(sass())
  .pipe(minify())
  .pipe(concat('style.min.css'))
  .pipe(gulp.dest('assets/css'))
}

function watchTask() {
  watch(['./scss/**/*.scss'], { interval: 1000 }, parallel(style));
}
exports.style = style
exports.default = series(
  parallel(style),
  watchTask
);

