gulp = require('gulp');
browserify = require('browserify');
sourcemaps = require('gulp-sourcemaps');
sass = require('gulp-sass');
postcss = require('gulp-postcss');
autoprefixer = require('autoprefixer');
cssnano = require('cssnano');
source = require('vinyl-source-stream');
buffer = require('vinyl-buffer');
uglify = require('gulp-uglify');
imageMin = require('gulp-imagemin');
jsonSass = require('json-sass');
rename = require('gulp-rename');
fs = require('fs');

gulp.task('styles', function () {
    return gulp.src('sass/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .on('error', sass.logError)
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./'))
});

gulp.task('theme', function() {
	return fs.createReadStream('theme.json')
		.pipe(jsonSass({
			prefix: '$theme: ',
		}))
		.pipe(source('theme.json'))
		.pipe(rename('_theme.scss'))
		.pipe(gulp.dest('./sass'));
})

gulp.task('js', function () {
	return browserify({
		extensions: ['.js'],
		entries: ['./js/scripts.js'],
		sourceType: 'module',
		debug: true
	})
		.transform('babelify', {
			sourceMaps: true,
			presets: ["@babel/preset-env"]
		})
		.bundle()
		.pipe(source('main.min.js'))
		.pipe(buffer())
		.pipe(uglify())
		.pipe(gulp.dest('js'))
});

gulp.task('images', function () {
	gulp.src('./images/**/*')
		.pipe(imageMin())
		.pipe(gulp.dest('./images'));
});

// configure which files to watch and what tasks to use on file changes
gulp.task('watch', function () {
	gulp.watch(['js/**/*.js', '!js/main.min.js'], gulp.series('js'));
	gulp.watch('sass/**/*.scss', gulp.series('styles'));
});

gulp.task('default', gulp.series(gulp.parallel('watch', 'images'), function () { }));
