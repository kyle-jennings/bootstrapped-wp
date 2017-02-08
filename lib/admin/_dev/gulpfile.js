var autoprefixer = require('autoprefixer');
var browserify = require('browserify');
var cssnano = require('gulp-cssnano');
var concat = require('gulp-concat');
var del = require('del');
var fs = require('fs');
var gulp = require('gulp');
var util = require('gulp-util');
var imagemin = require('gulp-imagemin');
var notify = require('gulp-notify');
var minify = require('gulp-minify');
var plumber = require('gulp-plumber');
var postcss = require('gulp-postcss');
var pngquant = require('imagemin-pngquant');
var rename = require('gulp-rename');
var sass = require('gulp-sass');

var sourcemaps = require('gulp-sourcemaps');
var transform = require('vinyl-transform');
var watch = require('gulp-watch');



function swallowError(error){
  this.emit('end');
}

var config = {
  production: !!util.env.production
};

// dir paths
var paths = {

  imgPath: './img',
  imgGlob: './img/**/*',
  jsPath: './js',
  jsGlob: './js/**/*.js',
  scssPath: './scss',
  scssGlob: './scss/**/*.scss',


  assetsPath: '../assets',
  fontsCompiled : '../assets/fonts',
  jsCompiled : '../assets/js',
  cssCompiled: '../assets/css',
  imgCompiled: '../assets/img',
  npmPath : './node_modules',
  bowerPath: './bower_components',
  vendorPath: './js/vendor'
};

/**
 * Minify and optimize style.css.
 */
gulp.task('css', ['sass'], function() {
 return gulp.src(paths.cssCompiled+'/site.css')
 .pipe(plumber({ errorHandler: handleErrors }))
 .pipe(config.production ?  cssnano({ safe: true }) : util.noop() )
 .pipe(rename('site.css'))
 .pipe(gulp.dest(paths.cssCompiled))
 .pipe(notify({message: 'CSS complete'}));
});

/**
 * Compile Sass and run stylesheet through PostCSS.
 */
gulp.task('sass', ['clean:css'], function() {

  return gulp.src(paths.scssPath+'/admin.scss')
  .pipe(plumber({ errorHandler: handleErrors }))
  .pipe(sourcemaps.init())
  .pipe(sass({
    includePaths: [
      paths.bowerPath + '/bootstrap-sass/assets/stylesheets',
      paths.bowerPath + '/components-font-awesome/scss',
      paths.scssGlob
    ],
    errLogToConsole: true,
    outputStyle: 'expanded'
  }))
  .pipe(postcss([
    autoprefixer({ browsers: ['last 2 version'] })
  ]))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest( paths.cssCompiled ));
});


gulp.task('build-jquery',['clean:js'], function(){

  return gulp.src(
    [
      paths.bowerPath + '/jquery/dist/jquery.min.js',
    ]
  )
  .pipe(concat('jquery.js'))
  .pipe(gulp.dest(paths.jsCompiled));

});


// browserfy is easier to update and manage thn manually concatinating files
// mostly because we dont have to restart gulp when adding new files
gulp.task('js', function () {

  var browserified = transform(function(filename) {
    var b = browserify(filename);
    return b.bundle();
  });

  return gulp.src([
    paths.jsPath+'/_admin.js'
  ])
  .pipe(plumber({ errorHandler: handleErrors }))
  .pipe(browserified)
  .pipe(config.production ? minify() : util.noop() )
  .pipe(gulp.dest(paths.jsCompiled))
  .pipe(notify({message: 'JS complete'}));
});



// image optimization
gulp.task('img',['clean:img'], function(){

  return gulp.src(paths.imgGlob)
    .pipe(imagemin({
      progressive: true,
    }))
    .pipe( gulp.dest(paths.imgCompiled) );

});


// move the font awesome fonts over to the assets folder
gulp.task('fonts',['clean:fonts'], function(){
  return gulp.src(paths.bowerPath + '/components-font-awesome/fonts/**.*')
    .pipe(gulp.dest(paths.fontsCompiled));
});



/**
 * Handle errors.
 *
 * plays a noise and display notification
 */
function handleErrors() {
  var args = Array.prototype.slice.call(arguments);
  notify.onError({
    title: 'Task Failed [<%= error.message %>',
    message: 'See console.',
    sound: 'Sosumi'
  }).apply(this, args);
  util.beep();
  this.emit('end');
}




/**
 * Builds the JS and SASS
 * @return {[type]} [description]
 */
gulp.task('build', function(){
  gulp.start('clean');
  gulp.start('fonts');
  gulp.start('js');
  gulp.start('img');
  gulp.start('css');
});


/**
 * Clean compiled files.
 */
 gulp.task('clean:fonts', function() {
   return del(
     [ paths.fontsCompiled ],
     {read:false, force: true});
 });


gulp.task('clean:css', function() {
  return del(
    [ paths.cssCompiled ],
    {read:false, force: true});
});

gulp.task('clean:js', function(){
  return del(
    [ paths.jsCompiled ],
    {read:false, force: true});
});

gulp.task('clean:img', function(){
  return del(
    [ paths.imgCompiled ],
    {read:false, force: true});
});

// clean all compiled assets
gulp.task('clean', function(){

  return del(
    [paths.assetsPath],
    {read:false, force: true}
  );
});


/**
 * Default Task, runs build and then watch
 * @return {[type]} [description]
 */
gulp.task('default', function(){
  gulp.start('build');
});


/**
 * Process tasks and reload browsers.
 */
gulp.task('watch', function() {
  gulp.start('build');
  gulp.watch(paths.jsGlob,['js']);
  gulp.watch(paths.imgGlob,['img']);
  gulp.watch(paths.scssGlob, ['css']);
});
