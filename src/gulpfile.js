/**
 *
 * Brainrider Boilerplate Gulpfile
 *
 * @since 1.0.0
 *
 * @authors Les Bent, Nathan M. House
 *
 */

/**
 * Table of Contents
 *
 * ?.? Load Gulp Modules and Configuration File
 * ?.? Set Custom Plumber Function
 * ?.? Task: 'gulp'
 * ?.? Task: 'build'
 * ?.? Task: 'regex'
 * ?.? Task: 'files'
 * ?.? Task: 'files:update'
 * ?.? Task: 'watch'
 * ?.? Task: 'browserSync'
 * ?.? Task: 'clean'
 * ?.? Task: 'clean:dev'
 * ?.? Task: 'clean:cache'
 * ?.? Task: 'styles'
 * ?.? Task: 'custom:js'
 * ?.? Task: 'vendor:js'
 * ?.? Task: 'images'
 * ?.? Task: 'fonts'
 * ?.? Task: 'sprites'
 * ?.? Task: 'test'
 * ?.? Task: 'lint:php'
 * ?.? Task: 'lint:js'
 * ?.? Task: 'lint:scss'
 *
 */


/**
 * ?.? Load Gulp Modules and Configuration File
 *
 * ?.?
 */
// Configuration File
 var config			= require('./gulp-config'),

// Gulp
	gulp			= require('gulp'),

// Utility-related Plugins
	plumber			= require('gulp-plumber'),
	notify			= require('gulp-notify'),
	browserSync		= require('browser-sync'),
	del				= require('del'),
	runSequence		= require('run-sequence'),
	gulpIf			= require('gulp-if'),
	cached			= require('gulp-cached'),
	cache			= require('gulp-cache'),
	concat			= require('gulp-concat'),
	multiDest		= require('gulp-multi-dest'),
	rename			= require('gulp-rename'),
	multipipe		= require('multipipe'),
	replace			= require('gulp-replace'),

// CSS-related Plugins
	sass			= require('gulp-sass'),
	autoprefixer	= require('gulp-autoprefixer'),
	sourcemaps		= require('gulp-sourcemaps'),
	sassLint		= require('gulp-sass-lint'),
	cssnano			= require('gulp-cssnano'),

// JS-related Plugins
	jshint			= require('gulp-jshint'),
	jscs			= require('gulp-jscs'),
	uglify			= require('gulp-uglify'),

// PHP-related Plugins
	phplint			= require('gulp-phplint'),

// Image-related Plugins
	imagemin		= require('gulp-imagemin'),
	spritesmith		= require('gulp.spritesmith');


/**
 * ?.? Set Custom Plumber Function
 *
 * Returns custom notification message and ensures gulp tasks do not 
 * prematurely exit when an error is throw.
 */
function customPlumber(errTitle) {
	return plumber({
		errorHandler: notify.onError({
			title: errTitle || "Error running Gulp",
			message: "Error: <%= error.message %>"
		})
	});
}


/**
 * ?.? Task: 'gulp'
 *
 * Default gulp task. Runs various sub-tasks instrumental in project
 * build. Includes server spin up and ongoing watch trigger.
 *
 */
gulp.task('default', function(callback) {
	runSequence(
		'clean',
		'sprites',
		['lint:js', 'lint:scss'],
		['styles', 'custom:js', 'vendor:js'],
		['images', 'fonts', 'files'],
		['browserSync', 'watch'],
		callback
	);
});


/**
 * ?.? Task: 'build'
 *
 * Standalone build task used to create/move generated files.
 *
 */
gulp.task('build', function(callback) {
	runSequence(
		'sprites',
		['styles', 'custom:js', 'vendor:js'],
		['images', 'fonts', 'files'],
		callback
	);
});


/**
 * ?.? Task: 'regex'
 *
 * Replaces all instances of namespacing and default project/text domain names
 * w/ project-specific option (set in gulp config file). 
 *
 */
gulp.task('regex', function() {
	gulp.src([
		'template-parts/**/*.php',
		'page-templates/**/*.php',
		'./*.php'
	], {'base': './'})
	.pipe(replace('brainrider-boilerplate', config.project.textdomain))
	.pipe(replace('Brainrider-Boilerplate', config.project.name))
	.pipe(replace('br_bp_', config.project.namespace))
	.pipe(gulp.dest('./'));
});


/**
 * ?.? Task: 'files'
 *
 * Moves project files not associated w/ a subtask (e.g. PHP files, readme.txt etc.)
 * to root directory.
 *
 */
gulp.task('files', function() {
	gulp.src([
		'./*.php',
		'template-parts/**/*',
		'page-templates/**/*.php',
		'inc/**/*',
		'screenshot.png',
		'readme.txt'
	], {'base': './'})
	.pipe(replace('(src)', '(dist)'))
	.pipe(gulp.dest('../'));
});


/**
 * ?.? Task: 'files:update'
 *
 * Reloads files to root directory and refreshes browser. Triggered by watch task.
 *
 */
 gulp.task('files:update', function() {
	runSequence(
		'files',
		browserSync.reload
	);
});


/**
 * ?.? Task: 'watch'
 *
 * Watches various directories and reruns connected tasks on file alteration.
 *
 */
gulp.task('watch', function() {
 	gulp.watch('scss/**/*.scss', ['styles', 'lint:scss']);
	gulp.watch(['js/custom/*.js'], ['custom:js', 'lint:js']);
	gulp.watch(['js/vendor/*.js'], ['vendor:js', 'lint:js']);
	gulp.watch(['*.html', '*.php', 'template-parts/**/*', 'page-templates/**/*.php', 'inc/**/*'], ['files:update']);
	gulp.watch(['img/raw/**/*'], ['images']);
 	gulp.watch('js/**/*.js', browserSync.reload);
 	gulp.watch('img/**/*', browserSync.reload);
 	gulp.watch('scss/**/*.scss', browserSync.reload);
 });


 /**
 * ?.? Task: 'browserSync'
 *
 * Launches or reloads browser to specified project proxy (set in config file).
 *
 */
gulp.task('browserSync', function() {
 	browserSync({
 		proxy: config.browserSync.proxy
 	});
 });


/**
 * ?.? Task: 'clean'
 *
 * Runs connected cleaning subtasks (i.e. 'clean:dev' and 'clean:cache').
 *
 */
gulp.task('clean', function() {
	runSequence([
		'clean:dev',
		'clean:cache'
	]);
});


/**
 * ?.? Task: 'clean:dev'
 *
 * Cleans generated files.
 *
 */
 gulp.task('clean:dev', function() {
 	return del.sync([
 		'scss/_sprites.scss',
 		'../[^index]*.php',
 		'../template-parts',
 		'../page-templates',
 		'../inc',
 		'../style.min.css',
 		'../screenshot.png',
 		'../readme.txt',
 		'../assets'
	], {force: true});
 });



/**
 * ?.? Task: 'clean:cache'
 *
 *
 * Clears and removes gulp cache associated w/ project (i.e. ensuring any tasks
 * that check for cached files run anew).
 */
gulp.task('clean:cache', function (done) {
	return cache.clearAll(done);
});


/**
 * ?.? Task: 'styles'
 *
 * Compiles sass files into auto-prefied, concatonated, minified CSS w/ source map.
 *
 */
gulp.task('styles', function() {

  	//
	return gulp.src(config.styles.src)

		// Set custom error
		.pipe(customPlumber('Error running styles task'))

		// Initiate soucemaps
		.pipe(sourcemaps.init())
		.pipe(sass({
			includePaths: ['bower_components'],
			outputStyle: 'compact'
		}))

		// Add autoprefixing
		.pipe(autoprefixer())

		// Concatenate into single unminified
		.pipe(concat('style.css'))
		.pipe(sourcemaps.write())

		// Move to root
		.pipe(gulp.dest('../'))

		// Rename
		.pipe(rename({
			suffix: '.min'
		}))

		// Minify
		.pipe(cssnano())
		.pipe(sourcemaps.write())

		// Move minified to root
		.pipe(gulp.dest('../'));
}); 


/**
 * ?.? Task: 'custom:js'
 *
 * Outputs concatenated, minified JS for custom scripts to assets folder at root.
 * Note: source order specified within config file determines the order in which 
 * the JS is concatenated into a single file. Files that provide dependent functions
 * must take precedent.
 *
 */
gulp.task('custom:js', function() {

  	// Source (in particular order) specified within config file
	return gulp.src(config.customJs.src)

		// All custom JS concatenated into single file
		.pipe(concat('custom.js'))
		.pipe(gulp.dest('../assets/js'))

		// Renamed
		.pipe(rename({
			suffix: '.min'
		}))

		// Minified
		.pipe(uglify())
		.pipe(gulp.dest('../assets/js'));
});


/**
 * ?.? Task: 'vendor:js'
 *
 * Outputs concatenated, minified JS for vendor scripts to assets folder at root.
 *
 */
 gulp.task('vendor:js', function() {

  	// Source (in particular order) specified within config file
 	return gulp.src(config.vendorJs.src)

 		// All vendor JS concatenated into single file
 		.pipe(concat('vendor.js'))
 		.pipe(gulp.dest('../assets/js'))

 		// Renamed
 		.pipe(rename({
 			suffix: '.min'
 		}))

 		// Minified
 		.pipe(uglify())
 		.pipe(gulp.dest('../assets/js'));
 });


/**
 * ?.? Task: 'images'
 *
 * Outputs optimized, renamed images to assets folder at root.
 *
 */
gulp.task('images', function() {

  	// Source set to grab all images not used as part of spritesheet
	return gulp.src(['img/raw/**/*.+(png|jpg|jpeg|gif|svg)', '!img/raw/sprites/**/*'])

		// Image optimization cached to prevent unnecessary running of task
		// Cache can be reset by running 'clean:cache'
		.pipe(cache(imagemin([
			imagemin.gifsicle({interlaced: true}),
			imagemin.jpegtran({progressive: true}),
			imagemin.optipng(),
			imagemin.svgo({multipass: true})
		]), {

			// Cache name
			name: 'brainrider boilerplate'
		}))

		// Renamed
		.pipe(rename({
			suffix: '-opt'
		}))
		.pipe(gulp.dest('../assets/img'));
});


/**
 * ?.? Task: 'fonts'
 *
 * Moves font files to assets folder at root.
 *
 */
gulp.task('fonts', function() {
	return gulp.src('fonts/**/*')
		.pipe(gulp.dest('../assets/fonts'))
});


/**
* ?.? Task: 'sprites'
*
* Generates spritesheet and style rules for use within master sass file.
*
*/
gulp.task('sprites', function() {

	//
	return gulp.src('img/raw/sprites/**/*')
		.pipe(spritesmith({
				cssName: '_sprites.scss',
				imgName: 'sprite-sheet.png',
				imgPath: 'assets/img/sprite-sheet.png',
				retinaSrcFilter: 'img/raw/sprites/*@2x.png',
				retinaImgName: 'sprite-sheet@2x.png',
				retinaImgPath: 'assets/img/sprite-sheet@2x.png'
		}))
		.pipe(gulpIf(
			'*.scss',
			gulp.dest('scss'),
			gulp.dest('../assets/img')
		));
});


/**
 * ?.? Task: 'test'
 *
 * Runs linting tasks for both js and sass.
 *
 */
gulp.task('test', function() {
	runSequence(
		['lint:js', 'lint:scss']
	);
});


/**
* ?.? Task: 'lint:php'
*
* Lints PHP files (in-progress).
*
*/
gulp.task('lint:php', function() {
	return gulp.src('*.php')
		.pipe(phplint('', {
			debug: true,
			clear: true
		}))
		.pipe(phplint.reporter('fail'));
});


/**
 * ?.? Task: 'lint:js'
 *
 * Lints vendor and custom JS files.
 *
 */
 gulp.task('lint:js', function() {

 	// If lint:js task enabled...
 	if (config.lint.js) {
	 	return gulp.src(['js/custom/**/*.js', 'js/vendor/**/*.js'])

	 		// Custom error message to prevent gulp breaking on error
	 		.pipe(customPlumber('Error running lint:js task'))

	 		// Running jshint
	 		.pipe(jshint())
	 		.pipe(jshint.reporter('jshint-stylish'))
	 		.pipe(jshint.reporter('fail', {

	 			// Warnings and info messages ignored
	 			// Only errors trigger notification
	 			ignoreWarning: true,
	 			ignoreInfo: true
	 		}))

	 		// RUnning jscs
	 		.pipe(jscs())
	 		.pipe(jscs.reporter());

	// Else log message
	} else {
		console.log('lint:js task disabled - adjust config file to enable');
	}
 });


/**
 * ?.? Task: 'lint:scss'
 *
 * Lints sass files.
 *
 */
 gulp.task('lint:scss', function() {

 	// If lint:scss task enabled...
 	if (config.lint.scss) {
	 	return gulp.src(['scss/**/*.scss', '!scss/_sprites.scss'])

	 		// Custom error message to prevent gulp breaking on error
	 		.pipe(customPlumber('Error running lint:scss task'))

	 		// Running sassLint
	 		.pipe(sassLint())
	 		.pipe(sassLint.format())

	// Else log message
	} else {
		console.log('lint:scss task disabled - adjust config file to enable');
	}
 });
