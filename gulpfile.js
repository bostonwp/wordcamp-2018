var gulp = require( 'gulp' );
var sass = require('gulp-sass');
var postcss = require( 'gulp-postcss' );
var autoprefixer = require( 'autoprefixer' );
var livereload = require('gulp-livereload');

gulp.task( 'css', function () {
	var processors = [
		autoprefixer( { browsers: ['last 2 versions'] } )
	];
	return gulp.src( './sass/style.scss' )
		.pipe( sass().on( 'error', sass.logError ) )
		.pipe( postcss( processors ) )
		.pipe( gulp.dest( '.' ) )
		.pipe( livereload() );
} );

gulp.task( 'watch', function() {
	livereload.listen();
	gulp.watch( 'sass/**/*.scss', [ 'css' ] );
} );

gulp.task( 'default', [ 'watch', 'css' ] );