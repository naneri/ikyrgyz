var stylus = require('gulp-stylus');
var gulp = require('gulp');
var nib = require('nib');
var jade = require('gulp-jade');
var cssbeautify = require('gulp-cssbeautify');



gulp.task('stylus', function () {
  gulp.src('./source/stylus/*.styl') 
	 .pipe(stylus({
	  use: [nib()]}))
	 .pipe(cssbeautify({
	  	indent: '	',
	  autosemicolon: true
	}))
	.pipe(gulp.dest('./public/css'));
});


gulp.task('jade', function() {
  gulp.src(['./source/*.jade', 'source/blocks/*.jade'])
	.pipe(jade({
	  pretty: true    }))

	.pipe(gulp.dest('./template/'))
});







// gulp.task('script' , function() {
//   return gulp.src('./source/**/*.js')      
// 	  .pipe(uglify())
// 	  .pipe(concat('all.min.js'))  
// 	.pipe(gulp.dest('public/js'));
// });

// gulp.task('compress', function() {
//   return gulp.src('./public/**/*.css')
// 	.pipe(minify())
// 	.pipe(gulp.dest('dist'))
// });


gulp.task('watch', function() {
 
  gulp.watch('./source/**/*.styl', ['stylus']);
  gulp.watch('./source/**/*.jade', ['jade']);

});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['watch', 'stylus','jade']);
