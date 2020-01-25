'use strict';

/*
 *   **** REQUIRES GULP 4.0 ***
 *
 * This file require node.js and node package manager. If you don't have those installed, please
 * see https://nodejs.org/en/download/ or install via homebrew.
 *
 * This file also requires Gulp 4.0. Gulp 4.0 is included locally within the node_modules folder in the
 * repo. But you will also need to install the Gulp 4.0+ CLI globally on your machine. If you don't have
 * Gulp installed yet, just type the following on the command line from any location/directory:
 *
 * npm install gulpjs/gulp-cli -g
 *
 * If you already have Gulp 3.x installed, type the following commands in sequence:
 *
 * npm uninstall gulp -g
 * npm install gulpjs/gulp-cli -g
 *
 * This file also uses certain node_modules. Once you have gulp installed globally and have a working
 * copy of the repo, just type the following from within the repo root folder, and node will
 * will install the needed dependencies from the package.json file.
 *
 * npm install
 *
 *
 * COMPILE THEME IN BUILD FOLDER, DEPLOY TO TESTING INSTANCE, AND GENERATE ZIP
 *
 * To build a working copy of theme files (files are created and compiled in a
 * build/ folder within the theme repo folder), type:
 *
 * gulp build -t [themename]
 *
 * For example to build a copy of Imagely Iconic, you would type:
 *
 * gulp build -t iconic
 *
 * Note: You cannot type the build command without -t and the theme name, since the command won't
 * know which theme to compile. You can see a list of theme name arguements below.
 *
 * To deploy the theme files automaticaly to a local testing instance, first setup an environmental
 * variable for DEPLOY_PATH. This is the path the wp-content folder of your local WordPress instance. You can
 * add this by adding the following to your .bash_profile. Be sure to replace path/to/test-instance with the
 * path to your local testing instance, but ensure path goes exactly to wp-content/ folder just as below:
 *
 * export DEPLOY_PATH=$HOME/path/to/test-instance/wp-content/
 *
 * After saving, you will need to reload your .bash_profile by typing:
 *
 * source .bash_profile
 *
 * You can confirm that your DEPLOY_PATH variable is set by typing:
 *
 * printenv DEPLOY_PATH
 *
 * Once your deploy path is set, you can deploy updated plugin files to that path with each build by
 * adding '-d' to the build command:
 *
 * gulp build -t [themename] -d
 *
 * Finally, you can generate a zip file when building by adding -z [version] to the build command. The
 * zip will be created in the /build folder, but a copy will also be created in /zips/themename/. Because the
 * contents of the build/ folder are ignored by mercurial, the zip folder acts as an ongoing archive of all
 * theme zips ever generated. If you type -z without a version number, the zip will be created without a version
 * number.
 *
 * gulp build -t [themename] -z 1.0.0
 *
 * Note that when a zip is copied to the zips folder, it will overwrite any existing zips with the same name.
 *
 * You can also use all arguments above together:
 *
 * gulp build -t [themename] -d -z 1.0.0
 *
 */
 
 // REQUIRE PLUGINS
 var gulp = require('gulp');
 var requireDir = require('require-dir');
 var sass = require('gulp-sass');
 var maps = require('gulp-sourcemaps');
 var concat = require('gulp-concat');
 var replace = require('gulp-replace');
 var del = require('del');
 var pixrem = require('gulp-pixrem');
 var zip = require('gulp-zip');
 var sftp = require('gulp-sftp');
 var argv = require('yargs').argv;
 var autoprefixer = require('gulp-autoprefixer');
 var csscomb = require('gulp-csscomb');
 const bs = require("browser-sync").create(),
       sourcemaps = require("gulp-sourcemaps");
       
       
 // Define theme name arguments
 if (argv.t == "aurora") {
 	var theme = 'aurora';
 }

// Define other folders, arguments, and vars
var themeFolder 	= 'src/';
var buildFolder 	= 'build/';
var doDeploy 		= argv.hasOwnProperty('d');
var deployFiles 	= 'build/**/*';
var deployPath 		= null;
if (process.env.hasOwnProperty('DEPLOY_PATH')) deployPath = process.env.DEPLOY_PATH;
var doZip 			= argv.hasOwnProperty('z');
var doUpload		= argv.hasOwnProperty('u');
var version			= doZip ? argv.z : '';


/****************************************************************
*
* GULP TASKS
*
***************************************************************/


// DELETE BUILD: Delete build folder
gulp.task('delbuild', function() {
	return del('build/**/*');
});

gulp.task('copytheme', function() {
	return gulp.src([
		themeFolder + '/**/*',
		themeFolder + '/{scss,sass/**}',
		themeFolder + '/{gulp,gulp/**}'])
	.pipe(gulp.dest(buildFolder))
});



// SASS: compile scss files
gulp.task("sass", function() {
  return gulp
    .src("./build/aurora/sass/**/*.scss")
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: "compact" })) //.on('error', gutil.log.bind(gutil, 'Sass Error')) // 'compressed' for one line css
    .pipe(
      autoprefixer({
        Browserslist: [
          "defaults",
          "not IE 11",
          "not IE_Mob 11",
          "maintained node versions"
        ],
        cascade: false
      })
    )
    .pipe(sourcemaps.write("./"))
    .pipe(gulp.dest("./build/aurora"))
});


// gulp default tasks
gulp.task("default", gulp.series("sass"));


// DEPLOY: Delete prior files and deploy new files to local test server
gulp.task('deldeploy', function() {
	if (deployPath)
		return del(deployPath + '/**/*',{force: true});
	else
		console.error("Please define the DEPLOY_PATH environment variable.");
});

gulp.task('deploy', function() {
	if (deployPath) {
		return gulp.src(buildFolder + '/**/*', {base: './build/' + theme })
			.pipe(gulp.dest(deployPath));
	}
	else console.error("Please define the DEPLOY_PATH environment variable.");
});

// ZIP: If requested, generate a zip file and copy to zips folder for archiving
gulp.task('zip', function() {
	var filename = version ? theme + '.' + version + '.zip' : theme + '.zip';
	return gulp.src(deployFiles, {base: './build' })
		.pipe(zip(filename))
		.pipe(gulp.dest('./build/zips'));
});


// BUILD: Build complete set of new theme files
var buildTasks 	= ['delbuild','copytheme','sass']
if (doDeploy) 	buildTasks = buildTasks.concat(['deldeploy', 'deploy']);
if (doZip)		buildTasks = buildTasks.concat(['zip']);
if (doUpload)	buildTasks = buildTasks.concat(['upload']);

gulp.task('build',
gulp.series(buildTasks));
