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




//another approach toptal
// const gulp = require('gulp');
// const sass = require('gulp-sass')(require('sass'));
// const concat = require('gulp-concat');
// const cleanCSS = require('gulp-clean-css'); 
// gulp.task('pack-js', function () {    
//     return gulp.src(['js/**/*.js'])
//         .pipe(cleanCSS())
//         .pipe(concat('bundle.js'))
//         .pipe(gulp.dest('build/js'))
// });
 
// gulp.task('pack-css', function () {    
//     return gulp.src(['scss/**/*.scss'])
//         .pipe(sass())
//         .pipe(concat('stylesheet.css'))
//         .pipe(gulp.dest('build/css'))
// });
// gulp.task('pack-css11', function () {    
//     return gulp.src(['scss/**/*.scss'])
//         .pipe(sass()) 
//         .pipe(cleanCSS())
//         .pipe(concat('stylesheet2.css'))
//         .pipe(gulp.dest('build/css'))
// });
// gulp.task('watch', function() {
//     gulp.watch('js/**/*.js', ['pack-js']);
//     gulp.watch('scss/**/*.scss', ['pack-css']);
//     gulp.watch('scss/**/*.scss', ['pack-css11']);
//    });
//    gulp.task('default', gulp.parallel('pack-js', 'pack-css', 'pack-css11')
//    );
