// Load plugins
var gulp = require('gulp');
var plugins = require('gulp-load-plugins')({ camelize: true, lazy: false });

gulp.task('styles', function() {
  return plugins.rubySass('assets/sass', {
    style: 'expanded',
    compass: true
  })
  .pipe(plugins.autoprefixer('last 2 versions', 'ie 9', 'ios 6', 'android 4'))
  .pipe(gulp.dest('assets/css'))
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(plugins.minifyCss({ keepSpecialComments: 1 }))
  .pipe(plugins.livereload())
  .pipe(gulp.dest('assets/css'));
  //.pipe(plugins.notify({ message: 'Styles task complete' }));
});

// Scripts
/*gulp.task('scripts', function() {
  return gulp.src(['assets/js/source/*.js'])
  .pipe(plugins.jshint('.jshintrc'))
  .pipe(plugins.jshint.reporter('default'))
  .pipe(plugins.concat('main.js'))
  .pipe(gulp.dest('assets/js/build'))
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(plugins.uglify())
  .pipe(plugins.livereload())
  .pipe(gulp.dest('assets/js'));
  //.pipe(plugins.notify({ message: 'Scripts task complete' }));
});*/

// Watch
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch('assets/sass/**/*.scss', ['styles']);

  // Watch .js files
  //gulp.watch(['assets/js/source/*.js'], ['scripts']);

  // Watch .php files
  // gulp.watch(['*.php', '**/*.php']).on('change', function(file) {
  //   plugins.livereload().changed(file.path);
  // });

});

// Default task
gulp.task('default', ['styles', /*'scripts',*/ 'watch']);
